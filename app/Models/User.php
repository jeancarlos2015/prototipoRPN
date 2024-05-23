<?php

namespace App;

use App\Http\Controllers\DownloadDiagramaController;
use App\Http\Models\AcessoRecente;
use App\Http\Models\ConfiguracaoAmbienteModelagem;
use App\Http\Models\Documentacao;
use App\Http\Models\Log;
use App\Http\Models\Mensagem;
use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\http\Models\Regra;
use App\http\Models\Repositorio;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\Session;
use App\Http\Models\Solicitacao;
use App\Http\Models\UsuarioModelo;
use App\Http\Models\UsuarioProjeto;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\AcessoRecenteRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\RegraRepository;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\SolicitacaoRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Util\Dado;
use Hamcrest\Core\Set;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use const http\Client\Curl\AUTH_ANY;

/**
 * App\User
 *
 * @property int $codusuario
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Http\Models\Repositorio $repositorios
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    protected $connection = 'pgsql';
    protected $primaryKey = 'codusuario';
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'codrepositorio',
        'codprojeto',
        'codmodelo',
        'status',
        'codusuariopai'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function validacao()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|max:50'
        ];
    }

    public function e_usuario_normal()
    {
        return !empty($this->repositorio) && in_array($this->papel(), [
                'PROPRIETARIO',
                'COLABORADOR',
                'CLIENTE'
            ]);
    }

    public function numero_mensagens_nao_lidas()
    {

        $mensagens = Mensagem::get();
        if ($mensagens->count() > 0) {
            return $mensagens->count();
        }
        return 0;
    }

    public function Usuarios()
    {
        if (Auth::getUser()->usuario_esta_no_repositorio()) {

            $codusuariosComRepositorio = DB::table('usuario_repositorios')
                ->select('codusuario')
                ->where('codrepositorio', '=', $this->codrepositorio)
                ->get()
                ->values()
                ->unique();

            $codusuarios = DB::table('users')
                ->select('codusuario')
                ->get()
                ->values();
            $resultados = collect([]);
            foreach ($codusuarios as $dado) {
                if (!$codusuariosComRepositorio->contains('codusuario', '=', $dado->codusuario)) {
                    $resultados->add($dado->codusuario);
                }
            }
            $usuarios = collect([]);
            foreach ($resultados as $codusuario) {
                $usuarios->add(User::find($codusuario));
            }
            return $usuarios;
        }

//        return Cache::remember('listar_todos_usuarios' . $this->codusuario, 2000, function () {
//
//            return collect([]);
//        });
    }

    public function configuracaoambientemodelagem()
    {
        return $this->hasOne(ConfiguracaoAmbienteModelagem::class, 'codusuario', 'codusuario');
    }

    public function session()
    {
        return $this->hasOne(Session::class, 'user_id', 'codusuario');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id', 'codusuario');
    }

    public function online()
    {
        return Cache::remember('sessoes' . $this->codusuario . $this->codusuario, 2000, function () {
            $session = $this->session;
            if (!empty($session)) {
                return true;
            }
            return false;
        });


    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class, 'codusuario_solicitado', 'codusuario');
    }

    public function solicitacoes_cache()
    {
        return Cache::remember('solicitacoes_cache' . $this->codusuario . $this->codusuario, 2000, function () {
            return $this->solicitacoes;
        });
    }

    public function EAdministrador()
    {
        return strtoupper($this->tipo) == 'ADMINISTRADOR';
    }

    public function EProprietario()
    {
        return $this->papel() == 'PROPRIETARIO' || $this->EAdministrador();
    }

    public function ExisteConfiguracao()
    {
        return !empty($this->configuracaoambientemodelagem);
    }

    public function EColaborador()
    {
        return $this->papel() == 'COLABORADOR' || $this->EProprietario();
    }

    public function ECliente()
    {
        return $this->papel() == 'CLIENTE' || $this->EColaborador();
    }


    public function todas_solicitacoes()
    {
        return Cache::remember('listar_todas_solicitacoes' . $this->codusuario, 2000, function () {
            return Solicitacao::all();
        });

    }

    public function Aviso()
    {

        return $this->MensagensRecebidas
            ->where('tipo', 5)
            ->where('visto', 0)
            ->first();

    }

    public function TemAviso()
    {
        return !empty($this->Aviso());
    }

    public function solicitacoes_repositorio()
    {

        if ($this->usuario_esta_no_repositorio()) {
            return collect($this->solicitacoes)->where('codrepositorio', '=', $this->repositorio->codrepositorio);
        } else {
            return null;
        }
    }

    public function qt_diagramas()
    {
        if ($this->usuario_esta_no_repositorio()) {
            return $this->repositorio->qt_representacoes_diagramaticas();
        } else if ($this->EAdministrador()) {
            return RepresentacaoDiagramatica::all()->count();
        }
        return -1;

    }

    public function ExisteConfiguracaoAmbienteModelagem()
    {
        return !empty($this->configuracaoambientemodelagem);
    }

    public function Administradores()
    {
        return User::where('tipo', '=', 'ADMINISTRADOR');
    }

    public function jaSolcitou($codrepositorio)
    {
        $solicitacoes = $this->solicitacoes_cache()
            ->where('codrepositorio', '=', $codrepositorio)
            ->where('codusuario_solicitante', '=', $this->codusuario);
        return (count($solicitacoes) > 0);
    }

    public function solicitacoes_feitas()
    {
        return $this->hasMany(Solicitacao::class, 'codusuario_solicitante', 'codusuario');
    }

    public function usuarios_repositorios()
    {
        return $this->hasMany(UsuarioRepositorio::class, 'codusuario', 'codusuario');

    }

    public function usuarios_dos_repositorios()
    {
        return Cache::remember('usuarios_repositorios' . $this->codusuario, 2000, function () {
            if ($this->usuario_esta_no_repositorio()) {
                return $this->repositorio->usuarios_repositorios;
            } else if ($this->papel() == 'ADMINISTRADOR') {
                return UsuarioRepositorio::all();
            }
            return null;
        });

    }

    public function Acessos()
    {
        return $this->hasMany(AcessoRecente::class, 'codusuario', 'codusuario');
    }

    public function ExistemAcessosRecentes()
    {
        return $this->AcessosRecentes()->count() > 0;
    }

    public function AcessosRecentes()
    {

        if ($this->usuario_esta_no_repositorio()) {
            return collect($this->Acessos)
                ->where('codusuario', '=', $this->codusuario)
                ->sortbydesc('codacessorecente')
                ->take(5);
        } else if ($this->EAdministrador()) {

            return collect($this->Acessos)
                ->sortbydesc('codacessorecente')
                ->take(5);
        }

        return collect([]);

    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function repositorios_criados()
    {
        return $this->hasMany(Repositorio::class, 'codusuario_criador', 'codusuario');
    }

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public function todos_projeto()
    {
        return $this->hasMany(Projeto::class, 'codrepositorio', 'codrepositorio');
    }

    public function rotas()
    {
        if ($this->EAdministrador()) {
            return [
                'modelo' => 'todos_modelos',
                'projeto' => 'todos_projetos',
                'repositorio' => 'controle_repositorios.index',
                'objetos' => 'todos_objetos_fluxos',
                'regras' => 'todas_regras',
                'solicitacao' => 'todas_solicitacoes',
                'usuariosonline' => 'UsuariosOnline',
                'usuarios' => 'controle_usuarios.index',
                'logs' => 'index_logs'
            ];
        } else if ($this->EProprietario()) {
            return [

                'modelo' => 'todos_modelos',
                'projeto' => 'todos_projetos',
                'objetos' => 'todos_objetos_fluxos',
                'regras' => 'todas_regras',
                'usuariosonline' => 'UsuariosOnline',
                'usuarios' => 'controle_usuarios.index',
                'logs' => 'index_logs'
            ];


        } else if ($this->ECliente()) {
            return [

                'modelo' => 'todos_modelos',
                'projeto' => 'todos_projetos',
                'objetos' => 'todos_objetos_fluxos',
                'regras' => 'todas_regras'

            ];
        }
        return [];
    }


    public function pai()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuariopai');
    }

    public function usuarios_do_repositorio_corrente()
    {
        return Cache::remember('usuarios_do_repositorio_corrente' . $this->codusuario, 2000, function () {
            $entradas = $this->repositorio->usuarios;
            $usuarios_repositorio = [];
            foreach ($entradas as $entrada) {
                if (in_array(strtoupper($entrada->tipo), ['COLABORADOR', 'CLIENTE', 'PROPRIETARIO'])) {
                    array_push($usuarios_repositorio, $entrada->usuario);
                }
            }
            return $usuarios_repositorio;
        });
    }

    public function total_usuarios()
    {
        if ($this->papel() === 'ADMINISTRADOR') {
            return User::all()->count();
        } else if ($this->papel() === 'PROPRIETARIO') {
            $users_admin = User::all()
                ->where('tipo', 'like', 'Administrador');
            $users = User::all()
                ->where('codrepositorio', '=', $this->repositorio->codrepositorio);
            $result = $users->diff($users_admin);
            return $result->count();

        }

    }

    public function existe_repositorio()
    {
        $entradas = $this->usuarios_repositorios;
        foreach ($entradas as $entrada) {
            if ($this->codusuario === $entrada->codusuario) {
                return true;
            }
        }
        return false;
    }

    public function usuario_esta_no_repositorio()
    {
        return !empty($this->repositorio);
    }

    public function Existemsolicitacoes()
    {
        return $this->solicitacoes_painel()->count() > 0;
    }

    public function Epadrao()
    {
        return strtoupper($this->tipo)  === 'PADRAO' && !$this->usuario_esta_no_repositorio();
    }

    public function solicitacoes_painel()
    {
        return Cache::remember('listar_solicitacoes_painel' . $this->codusuario, 2000, function () {
            if ($this->EAdministrador()) {
                return Solicitacao::all();
            } else if ($this->usuario_esta_no_repositorio()) {
                return Solicitacao::all()->where('codrepositorio', '=', $this->codrepositorio);
            }
            return collect([]);
        });
    }

    public function usuario_esta_no_projeto()
    {
        return !empty($this->projeto);
    }

    public function UsuarioRepositorio()
    {
        return Cache::remember('listar_usuario_repositorio_painel' . $this->codusuario, 2000, function () {
            return UsuarioRepositorio::all()
                ->where('codrepositorio', '=', $this->codrepositorio)
                ->where('codusuario', '=', $this->codusuario)
                ->first();
        });
    }

    public function usuario_esta_no_modelo()
    {
        return !empty($this->modelo);
    }

    public function usuarios_do_repositorio()
    {
        return Cache::remember('usuarios_do_repositorio' . $this->codusuario, 2000, function () {
            $entradas = $this->usuarios_repositorios;
            $usuarios = collect([]);
            foreach ($entradas as $entrada) {
                $usuarios->add($entrada->usuario);
            }
            return $usuarios->unique();
        });
    }

    public function usuarios_repositorios_distintos()
    {
        return $this->usuarios_repositorios->unique();
    }

    public function quantidades()
    {

        $qt_repositorios = RepositorioRepository::listar()->count();
        $qt_projetos = ProjetoRepository::listar()->count();
        $qt_modelos = ModeloRepository::listar()->count();
        $qt_objetos_fluxos = ObjetoFluxoRepository::listar()->count();
        $qt_regras = RegraRepository::listar()->count();
        $qt_solicitacoes = Solicitacao::all()->count();
        $qt_usuarios_online = UserRepository::listar_usuarios_online()->count();
        $qt_usuarios = $this->listar_usuarios()->count();
        $qt_logs = LogRepository::listar_todos()->count();

        if ($this->usuario_esta_no_repositorio()) {
            $repositorio = $this->repositorio;
            $qt_projetos1 = $repositorio->projetos->count();
            $qt_modelos1 = collect($repositorio->modelos)
                ->count();
            $qt_objetos_fluxos1 = collect($repositorio->objetos_fluxos)
                ->count();
            $qt_regras1 = collect($repositorio->regras)
                ->count();
            $qt_usuarios1 = collect($repositorio->usuarios)
                ->count();
            if ($this->EProprietario()) {
                return [
                    'projeto' => $qt_projetos1,
                    'modelo' => $qt_modelos1,
                    'objeto' => $qt_objetos_fluxos1,
                    'regra' => $qt_regras1,
                    'usuariosonline' => $qt_usuarios_online,
                    'usuarios' => $qt_usuarios1,
                    'logs' => $qt_logs
                ];
            }
            return [
                'projeto' => $qt_projetos1,
                'modelo' => $qt_modelos1,
                'objeto' => $qt_objetos_fluxos1,
                'regra' => $qt_regras1
            ];
        } else if ($this->EAdministrador()) {

            return [
                'modelo' => $qt_modelos,
                'projeto' => $qt_projetos,
                'repositorio' => $qt_repositorios,
                'objeto' => $qt_objetos_fluxos,
                'regra' => $qt_regras,
                'solicitacao' => $qt_solicitacoes,
                'usuariosonline' => $qt_usuarios_online,
                'usuarios' => $qt_usuarios,
                'logs' => $qt_logs
            ];
        }
        return [];
    }

    public function ConfiguracoesRepositorio()
    {
        return $this->hasMany(ConfiguracaoAmbienteModelagem::class, 'codrepositorio', 'codrepositorio');
    }

    public function Configuracoes()
    {
//            return Cache::remember('listar_configuracoes_menu'.$this->codusuario, 2000, function () {
        if (Auth::getUser()->email == 'jeancarlospenas25@gmail.com')
            return ConfiguracaoAmbienteModelagem::all()->where('codrepositorio');
        return $this->ConfiguracoesRepositorio;
//            });
    }

    public function ExibirAcessoValidarDiagrama()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoValidarDiagrama();
    }

    public function ExibirDescricaoDiagrama()
    {
        return $this->configuracaoambientemodelagem->ExibirDescricaoDiagrama();
    }

    public function ExibirAdicaoUsuariosDiagrama()
    {
        return $this->configuracaoambientemodelagem->ExibirAdicaoUsuariosDiagrama();
    }


    public function ExibirAlteracoes()
    {
        return $this->configuracaoambientemodelagem->ExibirAlteracoes();
    }


    public function ExibirIconePainel()
    {

        return $this->configuracaoambientemodelagem->ExibirIconePainel();
    }


    public function ExibirEditarModeloUploadDiagrama()
    {

        return $this->configuracaoambientemodelagem->ExibirEditarModeloUploadDiagrama();
    }


    public function ExibirAcessoEditarDiagrama()
    {
        return $this->configuracaoambientemodelagem->ExibirAcessoEditarDiagrama();
    }


    public function ExibirAcessoDocumentacaoTextual()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoDocumentacaoTextual();
    }


    public function ExibirAcessosRecentes()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessosRecentes();
    }


    public function ExibirAcessoAdicaoValidador()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoAdicaoValidador();
    }

    public function ExibirAcessoUsuarios()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoUsuarios();
    }

    public function ExibirAcessoEnviarMensagem()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoEnviarMensagem();
    }


    public function ExibirAcessoDonwloadDiagrama()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoDonwloadDiagrama();
    }


    public function ExibirAcessoInformacoesDiagrama()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoInformacoesDiagrama();
    }


    public function ExibirAcessoRepositorios()
    {

        return $this->configuracaoambientemodelagem->ExibirAcessoRepositorios();
    }


    public function repositorios_do_usuario()
    {
        return Cache::remember('listar_repositorios_usuarios' . $this->codusuario, 2000, function () {
            $entradas = $this->usuarios_repositorios;
            $codrepositorios = collect([]);
            $novos_repositorios = collect([]);
            foreach ($entradas as $entrada) {
                $codrepositorios->add($entrada->codrepositorio);
            }
            $codrepositorios = $codrepositorios->unique();
            foreach ($codrepositorios as $codrepositorio) {
                $novos_repositorios->add(Repositorio::find($codrepositorio));
            }
            return $novos_repositorios;
        });
    }

    public function repositoriosProprietarios()
    {
        $repositorios_do_usuario = collect($this->repositorios_do_usuario());
        $repositorios = $this->Epadrao() ? Repositorio::all() : $this->repositorios_do_usuario();
        $novos_repositorios = collect([]);
        foreach ($repositorios as $repositorio) {
            if ($repositorio->existeProprietario() && !$repositorios_do_usuario->contains('codrepositorio', $repositorio->codrepositorio)) {
                $novos_repositorios->add($repositorio);
            }
        }
        return $novos_repositorios;
    }

    public function repositorios()
    {
        return Cache::remember('listar_repositorios_painel' . $this->codusuario, 2000, function () {

            return $this->repositoriosProprietarios();
        });
    }

    public function avo()
    {
        if (!empty($this->pai->pai)) {
            return $this->pai->pai;
        }
        return null;
    }

    public function listar_usuarios()
    {
        return Cache::remember('listar_usuarios' . $this->codusuario, 2000, function () {
            return User::get();
        });
    }

    public function EstaLiberado()
    {
        return
            $this->EProprietario() ||
            $this->EAdministrador() ||
            $this->EColaborador() ||
            $this->ECliente();

    }

    public function Enormal()
    {
        return
            $this->EProprietario() ||
            $this->EAdministrador() ||
            $this->EColaborador() ||
            $this->ECliente();

    }

    public function TemPermissaoParaEditar()
    {
        return
            $this->EProprietario() ||
            $this->EAdministrador() ||
            $this->EColaborador();
    }

    public function TemPermissaoParaEscluir()
    {
        return
            $this->EProprietario() ||
            $this->EAdministrador();
    }

    public function permissao()
    {
        $result = false;
        if (!empty($this->codusuariopai)) {
            $result = $result || $this->codusuariopai == $this->codusuario;
        }
        if (!empty($this->pai)) {
            $result = $result || $this->pai->codusuario == $this->codusuario;
        }
        if (!empty($this->avo())) {
            $result = $result || $this->avo()->codusuario == $this->codusuario;
        }

        return $result;
    }

    public function PermissaoMensagem($mensagem)
    {
        return ($this->EAdministrador() || $this->codusuario == $mensagem->responsavel->codusuario || $this->codusuario == $mensagem->destinatario->codusuario);
    }

    public function EadministradorENaoEstaNoRepositorio()
    {
        return !$this->usuario_esta_no_repositorio() && $this->papel() === 'ADMINISTRADOR';
    }

    public function regras()
    {
        return Cache::remember('listar_todas_regras' . $this->codusuario, 2000, function () {
            return Regra::get();
        });
    }

    public function todos_repositorios()
    {
        return Cache::remember('listar_todos_repositorios' . $this->codusuario, 2000, function () {
            return Repositorio::all();
        });

    }

    public function papel()
    {
        return Cache::remember('papel_usuario' . $this->codusuario, 2000, function () {
            if (!empty($this->repositorio)) {
                $permissao = $this->repositorio->permissoes->where('codusuario', $this->codusuario)->first();
                if (!empty($permissao)) {
                    $papel = strtoupper($permissao->tipo);
                    if (in_array($papel, ['ADMINISTRADOR', 'PROPRIETARIO', 'COLABORADOR', 'CLIENTE'])) return $papel;
                }
                return 'NENHUM';
            } else if (strtoupper($this->tipo) == 'ADMINISTRADOR') {
                return 'ADMINISTRADOR';
            }
            return 'NENHUM';
        });

    }

    public function usuarios_projetos()
    {

        return $this->hasMany(UsuarioProjeto::class, 'codusuario', 'codusuario');

    }

    public function modelo()
    {
        return $this->hasOne(Modelo::class, 'codmodelo', 'codmodelo');
    }

    public function usuarios_modelos()
    {

        return $this->hasMany(UsuarioModelo::class, 'codusuario', 'codusuario');

    }

    public function projetos_do_usuario()
    {
        $projetos = collect([]);
        if ($this->EProprietario() && !$this->EAdministrador()) {
            return $this->repositorio->projetos;
        }

        if ($this->EAdministrador()) {
            return Projeto::all();
        }
        if ($this->Epadrao() && !$this->EProprietario()) {
            foreach ($this->usuarios_projetos as $entrada) {
                $projetos->add($entrada->projeto);
            }
            return $projetos;
        }
        return $projetos;
    }

    public function projetos()
    {
        return Cache::remember('projetos' . $this->codusuario, 2000, function () {
//            if ($this->EProprietario() || $this->EAdministrador()) {
//                return $this->repositorio->projetos;
//            }
            $projetos = $this->projetos_do_usuario();
//            $codprojetos = collect([]);
//            $projetos = collect([]);
//            foreach ($this->usuarios_projetos as $entrada) {
//                $codprojetos->add($entrada->codprojeto);
//            }
//            $codprojetos = $codprojetos->unique();
//            foreach ($codprojetos as $codprojeto) {
//                $projetos->add(Projeto::find($codprojeto));
//            }
//            $projetos = $projetos->where('codusuario', $this->codusuario);
            return $projetos;
        });
    }

    public function modelos()
    {
        return Cache::remember('modelos' . $this->codusuario, 2000, function () {
            if ($this->usuario_esta_no_repositorio()) {
                $codmodelos = collect([]);
                foreach ($this->usuarios_modelos as $entrada) {
                    $codmodelos->add($entrada->codmodelo);
                }
                $codmodelos = $codmodelos->unique();
                $modelos = collect([]);
                foreach ($codmodelos as $codmodelo) {
                    $modelo = Modelo::find($codmodelo);
                    if ($modelo->codusuario == $this->codusuario) {
                        $modelos->add($modelo);
                    }
                }
                return $modelos;
            }
            return $this->EAdministrador() ? ModeloRepository::listar_modelos() : collect([]);
        });
    }

    public function todos_modelos()
    {
        return Cache::remember('todos_modelos' . $this->codusuario, 2000, function () {
            return Modelo::all();
        });
    }

    public function usuario_github()
    {
        return Crypt::decrypt($this->github->usuario_github);
    }

    public function usuario_senha()
    {
        return Crypt::decrypt($this->github->senha_github);
    }

    public function MensagensEnviadas()
    {
        return $this->hasMany(Mensagem::class, 'codusuario', 'codusuario');
    }

    public function MensagensRecebidas()
    {
        return $this->hasMany(Mensagem::class, 'codusuariodestinatario', 'codusuario');
    }

    public function MensagensUsuario()
    {
        return Cache::remember('listar_mensagens_usuarios' . $this->codusuario, 2000, function () {
            return $this->MensagensRecebidas
                ->where('visto', '=', 0)
                ->sortbydesc('codmensagem')
                ->take(5);
        });
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'codusuario', 'codusuario');
    }

    public function logsErros()
    {
        return LogRepository::listar_todos()->where('nome', '=', 'error');
    }

    public function logsOutros()
    {
        return LogRepository::listar_todos()->where('nome', '!=', 'error');
    }

    public function LogsUsuarios()
    {
        return Cache::remember('listar_logs_painel' . $this->codusuario, 2000, function () {
                return $this->logs;
        });
    }

    public function mensagens()
    {
        return Cache::remember('listar_mensagens_usuarios' . $this->codusuario, 2000, function () {
            return Mensagem::get();
        });
    }


    public function QTNovasMensagens()
    {

        $mensagens = $this->MensagensEnviadas->concat($this->MensagensRecebidas);
        $quantidade = 0;
        foreach ($mensagens as $mensagen) {
            if ($mensagen->visto) {
                $quantidade++;
            }

        }
        return $quantidade;
    }

    public function NovasMensagens()
    {
        return Cache::remember('listar_novas_mensagens' . $this->codusuario, 2000, function () {
            $mensagens = $this->MensagensEnviadas->concat($this->MensagensRecebidas);
            $novasMensagens = [];
            foreach ($mensagens as $mensagem) {
                if ($mensagem->visto) {
                    array_push($novasMensagens, $mensagem);
                }
            }
            return $novasMensagens;
        });
    }

    public static function titulos()
    {
        return [
            'Usuário',
            'Ações'
        ];
    }

    function titulos_modelo()
    {

        return [

            'Modelos',
            'Ações'
        ];


    }


    public static function campos()
    {
        return [
            'nome',
            'email',
            'password',
            'tipo'
        ];
    }


    public static function atributos()
    {
        return [
            'nome',
            'email',
            'password',
            'tipo'
        ];

    }

    //Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 5; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

    public function UsuariosRepositorios()
    {

        return Cache::remember('listar_usuarios_repositorios' . $this->codusuario, 2000, function () {
            return UsuarioRepositorio::all();
        });
    }

    public function usuarios_repositorios_cache()
    {
        return Cache::remember('listar_usuarios_repositorios_cache' . $this->codusuario, 2000, function () {
            return $this->usuarios_repositorios;
        });
    }

    //Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 4; $indice++) {
            if ($indice < 2) {

                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->campo = $campos[$indice];
            $dados[$indice]->atributo = $atributos[$indice];

        }
        return $dados;
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {

            limpar_cache_geral();
        });


        static::deleting(function ($user) { // before delete() method call this
            try {
                DB::beginTransaction();
                foreach ($user->usuarios_repositorios as $entrada) {
                    $entrada->delete();
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }

            limpar_cache();
        });

        static::updated(function ($user) {

            AcessoRecenteRepository::CriaAcessoRecenteRepositorio($user->repositorio, 'alteracao_repositorio');
            limpar_cache();
        });

    }


}
