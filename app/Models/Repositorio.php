<?php

namespace App\http\Models;

use App\Http\Models\Projeto;
use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Models\ObjetoFluxo;
use App\Http\Models\Regra;
use App\Http\Models\Mensagem;
use App\Http\Models\Solicitacao;
use App\Http\Util\Dado;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Repositorio extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codrepositorio';
    protected $table = 'repositorios';
    protected $fillable = [
        'nome',
        'descricao',
        'publico',
        'codrepositorio_filho',
        'codrepositorio_pai',
        'codusuario_criador'
    ];

    public static function validacao()
    {
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255'
        ];
    }

    public static function titulos_da_tabela()
    {
        return [
            'Repositórios',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição'
        ];
    }

    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }

    public static function atributos_dos_campos()
    {
        return [

            'nome',
            'descricao'
        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_exibidos_no_titulo()
    {
        $dado = array();
        for ($indice = 0; $indice < 2; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem

    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos_dos_campos();
        $dados = self::dados_exibidos_no_titulo();
        $types = self::types();
        $titulos = self::titulos_da_tabela();
        for ($indice = 0; $indice < 2; $indice++) {
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
                $dados[$indice]->type = $types[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

    public function usuarios_repositorios()
    {
        return $this->hasMany(UsuarioRepositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function usuarios_repositorios_cache()
    {
        return Cache::remember('listar_usuarios_repositorios_cache', 2000, function () {
            if (!empty($this->usuarios_repositorios)) return $this->usuarios_repositorios;
            return collect([]);
        });
    }

    public function permissoes()
    {
        return $this->hasMany(UsuarioRepositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function permissao()
    {
        if ($this->codusuario_criador === Auth::getUser()->codusuario) return true;
        if ($this->publico) return true;
        if (Auth::getUser()->EAdministrador() || Auth::getUser()->EProprietario()) return true;
        return $this->usuarios_repositorios
                ->where('tipo', 'PROPRIETARIO')
                ->where('codusuario', Auth::getUser()->codusuario)->count() > 0;
    }

    public function UsuarioTemPermissao($user)
    {
        if (Auth::getUser()->EProprietario()) return true;
        if ($this->publico) {
            if ($user->usuario_esta_no_repositorio()) {
                return $this->codrepositorio == $user->codrepositorio || $user->EAdministrador();
            } else {
                return false || $user->EAdministrador();
            }
        }

        foreach ($this->usuarios_repositorios as $entrada) {
            if ($entrada->codusuario == $user->codusuario) {
                return true;
            }
        }
        return false || $user->EAdministrador();
    }

    public function objetos_fluxos_relacionamento()
    {
        return $this->hasMany(ObjetoFluxo::class, 'codrepositorio', 'codrepositorio');
    }

    public function listar_objetos_fluxos()
    {
        return Cache::remember('listar_objetos_fluxos', 2000, function () {
            $repositorio = Auth::user()->repositorio;
            if (Auth::user()->papel() === 'PROPRIETARIO') {
                return $repositorio->objetos_fluxos_relacionamento;
            } else {
                return collect($repositorio->objetos_fluxos_relacionamento)
                    ->where('publico', '=', 'true');
            }
        });
    }
    public function usuarios_repositorios_unique(){
        return $this->usuarios_repositorios->unique();
    }
    public function papel()
    {

        $codusuario = Auth::user()->codusuario;
        $usuarios_repositorios = $this->usuarios_repositorios();
        $result = $usuarios_repositorios->where('codusuario', '=', $codusuario);

        $entrada = $result->first();
        if (empty($entrada->tipo)) {
            return null;
        }
        return $entrada->tipo;
    }

    public function usuarios()
    {
        return $this->hasMany(UsuarioRepositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function usuariosCache()
    {
        return Cache::remember('usuariosCache' . $this->codrepositorio, 2000, function () {
            return $this->usuarios;
        });

    }

    public function usuarios_do_repositorio()
    {
        return Cache::remember('usuarios_do_repositorio' . $this->codrepositorio, 2000, function () {
            $usuarios = collect([]);
            foreach ($this->usuarios as $entrada) {
                if (Auth::getUser()->codusuario !== $entrada->codusuario)
                    $usuarios->add($entrada->usuario);
            }
            return $usuarios->unique();
        });

    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class, 'codrepositorio', 'codrepositorio');
    }

    public function foiSolicitado()
    {
        foreach ($this->solicitacoes as $solicitacao) {
            if ($solicitacao->codusuario_solicitante === Auth::getUser()->codusuario) {
                return true;
            }
        }
        return false;
    }

    public function proprietarioCriador()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario_criador');
    }

    public function existeProprietarioCriador()
    {
        return !empty($this->proprietarioCriador);
    }

    public function existeProprietario()
    {
        foreach ($this->usuarios_repositorios as $entrada) {
            if ($entrada->usuario->Eproprietario()) {
                return true;
            }
        }
        return false;
    }

    public function repositorios_filhos()
    {
        return $this->hasMany(Repositorio::class, 'codrepositorio', 'codrepositorio_filho');
    }

    public function Documentacoes()
    {
        return $this->hasMany(Documentacao::class, 'codrepositorio', 'codrepositorio');
    }

    public function repositorio_pai()
    {
        return $this->hasMany(Repositorio::class, 'codrepositorio', 'codrepositorio_pai');
    }

    public function qt_usuarios()
    {
        return Cache::remember('qt_usuarios', 2000, function () {
            return $this->usuarios()->count();
        });
    }

    public function qt_projetos_privados()
    {
        return Cache::remember('qt_projetos_privados', 2000, function () {
            return $this->projetos()->where('publico', '=', 'false')
                ->count();
        });
    }

    public function codproprietario()
    {
        $user = $this->proprietarios()->first();
        if (!empty($user)) {
            return $user->codusuario;
        }
        return 0;
    }

    public function qt_usuarios_online()
    {
        $entradas = $this->usuariosCache();
        $contador = 0;
        foreach ($entradas as $entrada) {
            if ($entrada->usuario->online()) {
                $contador++;
            }
        }
        return $contador;
    }

    public function qt_projetos_publicos()
    {
        return Cache::remember('qt_projetos_publicos', 2000, function () {
            return $this->projetos()->where('publico', '=', 'true')
                ->count();
        });
    }

    public function qt_projetos()
    {
        return $this->qt_projetos_privados() + $this->qt_projetos_publicos();
    }

    public function qt_modelos()
    {
        return Cache::remember('qt_modelos', 2000, function () {
            return $this->modelos()->count();
        });
    }

    public function qt_modelos_publicos()
    {
        return Cache::remember('qt_modelos_publicos', 2000, function () {
            return $this->modelos()
                ->where('publico', '=', 'true')
                ->count();
        });
    }

    public function qt_modelos_privados()
    {
        return Cache::remember('qt_modelos_privados', 2000, function () {
            return $this->modelos()
                ->where('publico', '=', 'false')
                ->count();
        });
    }

    public function qt_objetos_fluxos()
    {
        return Cache::remember('qt_objetos_fluxos', 2000, function () {
            return $this->objetos_fluxos()->count();
        });
    }

    public function qt_regras()
    {
        return Cache::remember('qt_regras', 2000, function () {
            return $this->regras()->count();
        });
    }

    public function diagramas()
    {
        return Cache::remember('diagramas_repositorio' . $this->codrepositorio, 2000, function () {
            $diagramas = collect([]);
            foreach ($this->representacoes_diagramaticas as $diagrama) {
                if ($diagrama->modelo->publico || $diagrama->modelo->permissao()) {
                    $diagramas->add($diagrama);
                }
            }
            return $diagramas;
        });


    }

    public function qt_representacoes_diagramaticas()
    {
        return $this->representacoes_diagramaticas()->count();
    }

    public function qt_representacoes_declarativas()
    {
        return Cache::remember('qt_representacoes_declarativas', 2000, function () {
            return $this->representacoes_declarativas()->count();
        });
    }

    public function projetos()
    {
        return $this->hasMany(Projeto::class, 'codrepositorio', 'codrepositorio');
    }

    public function objetos_fluxos()
    {
        return $this->hasMany(ObjetoFluxo::class, 'codrepositorio', 'codrepositorio');
    }

    public function proprietarios()
    {
        return Cache::remember('proprietarios' . $this->codrepositorio, 2000, function () {
            $usuarios = [];
            foreach ($this->usuarios as $entrada) {
                if (in_array($entrada->tipo, ["PROPRIETARIO", "ADMINISTRADOR"])) {
                    array_push($usuarios, $entrada->usuario);
                }
            }
            return collect($usuarios);
        });

    }


    public function modelos()
    {
        return $this->hasMany(Modelo::class, 'codrepositorio', 'codrepositorio');
    }

    public function regras()
    {
        return $this->hasMany(Regra::class, 'codrepositorio', 'codrepositorio');
    }


    public function representacoes_diagramaticas()
    {
        return $this->hasMany(RepresentacaoDiagramatica::class, 'codrepositorio', 'codrepositorio');
    }

    public function representacoes_declarativas()
    {
        return $this->hasMany(RepresentacaoDeclarativa::class, 'codrepositorio', 'codrepositorio');
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class, 'codrepositorio', 'codrepositorio');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($repositorio) { // before delete() method call this
            try {
                DB::beginTransaction();
                $usuarios_repositorios = UsuarioRepositorio::where('codrepositorio', '=', $repositorio->codrepositorio)->get();
                foreach ($usuarios_repositorios as $usuario_repositorio) {
                    $usuario_repositorio->delete();
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }
            limpar_cache();
        });
        static::deleting(function ($repositorio) { // before delete() method call this
            try {
                DB::beginTransaction();
                $projetos = Projeto::where('codrepositorio', '=', $repositorio->codrepositorio)->get();
                foreach ($projetos as $projeto) {
                    $projeto->delete();
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }
            limpar_cache();
        });
        static::created(function ($repositorio) {
            $dado = [
                'codusuario' => Auth::getUser()->codusuario,
                'codrepositorio' => $repositorio->codrepositorio,
                'tipo' => 'PROPRIETARIO'
            ];
            UsuarioRepositorio::create($dado);
            limpar_cache();
        });
    }

    public function qt_modelos_mes($data)
    {

        $mes = Carbon::parse($data)->format('m');

        $result = $this->modelos()
            ->whereMonth('created_at', '=', $mes)
            ->count();

        return $result;
    }
}
