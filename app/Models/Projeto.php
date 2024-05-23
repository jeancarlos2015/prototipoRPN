<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * App\Http\Models\Projeto
 *
 * @property int $codprojeto
 * @property string $nome
 * @property string $descricao
 * @property int $codrepositorio
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\ModeloDiagramatico $modelos
 * @property-read \App\Http\Models\Repositorio $repositorio
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCodorganizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCodprojeto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Projeto extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codprojeto';
    protected $table = 'projetos';
    protected $fillable = [
        'codrepositorio',
        'codusuario',
        'nome',
        'descricao',
        'publico'
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
            'Processos',
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

    public static function atributos_dos_campos()
    {
        return [
            'nome',
            'descricao'
        ];

    }

    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class, 'codprojeto', 'codprojeto');
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

    public function TemRepositorio()
    {
        return !empty($this->repositorio);
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
                $dados[$indice]->tipo = $types[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

    public function diagramas()
    {
        return $this->hasMany(RepresentacaoDiagramatica::class, 'codprojeto', 'codprojeto');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public function email()
    {
        return $this->usuario->email;
    }

    public function usuarios_projetos()
    {
        return $this->hasMany(UsuarioProjeto::class, 'codprojeto', 'codprojeto');
    }

    public function qt_modelos_publicos()
    {
        return Cache::remember('qt_modelos_publicos_projetos', 2000, function () {
            return $this->modelos()->where('publico', '=', 'true')->count();
        });
    }

    public function Documentacoes()
    {
        return $this->hasMany(Documentacao::class, 'codprojeto', 'codprojeto');
    }

    public function qt_modelos_privados()
    {
        return Cache::remember('qt_modelos_privados_projeto', 2000, function () {
            return $this->modelos()->where('publico', '=', 'false')->count();
        });
    }

    public function qt_usuarios()
    {
        return Cache::remember('qt_usuarios_projeto', 2000, function () {
            return $this->usuarios_projetos()->count();
        });
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function modelos_diagramaticos()
    {
        return $this->hasMany(RepresentacaoDiagramatica::class, 'codprojeto', 'codprojeto');
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class, 'codprojeto', 'codprojeto');
    }

    public function qt_modelos()
    {
        return $this->modelos->count();
    }

    public function modelos_declarativos()
    {
        return $this->hasMany(RepresentacaoDeclarativa::class, 'codprojeto', 'codprojeto');
    }

    public function modelos_do_projeto()
    {
        return Cache::remember('modelos_do_projeto', 2000, function () {
            $projeto = Auth::user()->projeto;
            $modelos = collect($projeto->modelos)
                ->where('publico', '=', 'true');
            $modelos_do_usuario = $projeto->modelos_do_usuario();
            return $modelos->concat($modelos_do_usuario);
        });
    }

    public function modelos_do_usuario()
    {
        return Cache::remember('modelos_do_usuario_projeto', 2000, function () {
            $entradas = Auth::user()->usuarios_modelos;
            $modelos = [];
            foreach ($entradas as $entrada) {
                array_push($modelos, $entrada->modelo);
            }
            if (!empty(Auth::user()->projeto && Auth::user()->e_usuario_normal())) {
                $projeto = Auth::user()->projeto;
                return collect($modelos)
                    ->where('codprojeto', '=', $projeto->codprojeto);
            }
            return $modelos;
        });
    }

    public function objetos_fluxos()
    {
        return $this->hasMany(ObjetoFluxo::class, 'codprojeto', 'codprojeto');
    }

    public function regras()
    {
        return $this->hasMany(Regra::class, 'codprojeto', 'codprojeto');
    }

    public function permissao()
    {
        if ($this->codusuario == Auth::getUser()->codusuario) return true;
        if ($this->publico) return true;
        return ($this->usuarios_projetos
                ->where('tipo', 'PROPRIETARIO')
                ->where('codusuario', Auth::getUser()->codusuario)->count() > 0);
    }

    public function eProprietario()
    {
        $permissao = $this->codusuario === Auth::getUser()->codusuario || Auth::getUser()->EProprietario();
        if ($permissao) {
            return true;
        }
        foreach ($this->usuarios_projetos as $entrada) {
            if ($entrada->codusuario == Auth::getUser()->codusuario && $entrada->tipo === 'PROPRIETARIO') {
                return true;
            }
        }
        return false;
    }

    public function UsuarioTemPermissao($user)
    {
        if (Auth::getUser()->EProprietario()) return true;
        if (!$this->repositorio->UsuarioTemPermissao($user))
            return false;

        if ($this->publico)
            return true;
        foreach ($this->usuarios_projetos as $entrada) {
            if ($entrada->codusuario == $user->codusuario) {
                return true;
            }
        }

        return false || $user->EAdministrador();
    }

    public function papel()
    {

        if (Auth::user()->papel() === 'ADMINISTRADOR') {

            return 'ADMINISTRADOR';
        }
        $usuario = Auth::user();
        $entrada = $this->usuarios_projetos->where('codusuario', $usuario->codusuario)->first();
        if (!empty($entrada))
            return $entrada->tipo;
        return 'NENHUM';
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($projeto) { // before delete() method call this
            try {
                DB::beginTransaction();
                $usuarios_projetos = UsuarioProjeto::where('codprojeto', '=', $projeto->codprojeto)->get();
                foreach ($usuarios_projetos as $usuarios_projeto) {
                    $usuarios_projeto->delete();
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }
            limpar_cache();
        });
        static::deleting(function ($projeto) { // before delete() method call this
            try {
                DB::beginTransaction();
                $configuracoes = ConfiguracaoAmbienteModelagem::where('codprojeto', '=', $projeto->codprojeto)->get();
                foreach ($configuracoes as $configuracao) {
                    $configuracao->delete();
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }
            limpar_cache();
        });

        static::deleting(function ($projeto) { // before delete() method call this
            try {
                DB::beginTransaction();
                $modelos = Modelo::where('codprojeto', '=', $projeto->codprojeto)->get();
                foreach ($modelos as $modelo) {
                    $modelo->delete();
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }
            limpar_cache();
        });
        static::created(function () {
            limpar_cache();

        });
    }


}

