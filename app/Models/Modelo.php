<?php

namespace App\Http\Models;

use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\UsuarioModelo;
use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Projeto;
use App\Http\Models\Repositorio;
use App\Http\Models\Mensagem;
use App\Http\Models\ObjetoFluxo;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Models\Regra;
use App\Http\Models\Documentacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Modelo extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codmodelo';
    protected $table = 'modelos';
    protected $fillable = [
        'nome',
        'descricao',
        'codprojeto',
        'codrepositorio',
        'codusuario',
        'validado',
        'created_at',
        'updated_at',
        'publico',
    ];


    public static function titulos()
    {
        return [
            'Modelos',
            'Autor',
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

    public static function atributos()
    {
        return [
            'nome',
            'descricao',
            'codprojeto',
            'codrepositorio'
        ];

    }

    public function PodeExcluir($user)
    {
        $podeExcluir = false;
        if($this->eProprietario()) return true;
        if ($this->permissao() || $this->codusuario == $user->codusuario) return true;

        foreach ($this->usuarios_modelos as $entrada) {
            if ($entrada->codusuario == $user->codusuario) {
                return $podeExcluir;
            }
        }
        if ($this->projeto->UsuarioTemPermissao($user))
            return true;
        if ($this->repositorio->UsuarioTemPermissao($user))
            return true;
        return false || $user->EAdministrador();
    }

    public function UsuarioTemPermissao($user)
    {
        if(Auth::getUser()->EProprietario()) return true;
        if (!$this->repositorio->UsuarioTemPermissao($user))
            return false;
        if (!$this->projeto->UsuarioTemPermissao($user))
            return false;
        foreach ($this->usuarios_modelos as $entrada) {
            if ($entrada->codusuario == $user->codusuario) {
                return true;
            }
        }
        return $this->publico || $user->EAdministrador();
    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 3; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        $types = self::types();
        //quantidade de atributos
        for ($indice = 0; $indice < 2; $indice++) {
            //quantidade do restante dos campos
            if ($indice < 1) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->tipo = $types[$indice];
                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->atributo = $atributos[$indice];


        }
        return $dados;
    }

//Relacionamentos
    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public function documentacoes()
    {
        return $this->hasMany(Documentacao::class, 'codmodelo', 'codmodelo');
    }

    public function documentacao()
    {
        return $this->hasOne(Documentacao::class, 'codmodelo', 'codmodelo');
    }

    public function usuarios_do_modelo()
    {
        return Cache::remember('usuarios_do_modelo' . $this->codmodelo, 2000, function () {
            $entradas = $this->usuarios_modelos;
            $usuarios = [];
            foreach ($entradas as $entrada) {
                if (!in_array($entrada->usuario, $usuarios)) {
                    array_push($usuarios, $entrada->usuario);
                }

            }

            if (!in_array($this->usuario, $usuarios)) {
                array_push($usuarios, $this->usuario);
            }
            return collect($usuarios);
        });

    }


    public function usuarios_modelos()
    {
        return $this->hasMany(UsuarioModelo::class, 'codmodelo', 'codmodelo');
    }

    public function qt_usuarios()
    {
        return Cache::remember('qt_usuarios', 2000, function () {
            return $this->usuarios_modelos()->count();
        });
    }

    public function email()
    {
        return $this->usuario->email;
    }

    public function qt_representacoes()
    {
        return $this->representacoes_diagramaticas()
            ->count();
    }

    public function qt_objetos_fluxos()
    {
        return Cache::remember('qt_objetos_fluxos', 2000, function () {
            return $this->objetos_fluxos()->count();
        });
    }

    public function regras()
    {
        return $this->hasMany(Regra::class, 'codmodelo', 'codmodelo');
    }

    public function validado()
    {
        foreach ($this->representacoes_diagramaticas_cache() as $diagrama) {
            if (!$diagrama->validado)
                return false;
        }
        return true;
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class, 'codmodelo', 'codmodelo');
    }


    public function qt_regras()
    {
        return $this->regras()->count();
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function representacao_diagramatica()
    {
        return $this->hasOne(RepresentacaoDiagramatica::class, 'codmodelo', 'codmodelo');
    }

    public function representacoes_diagramaticas()
    {
        return $this->hasMany(RepresentacaoDiagramatica::class, 'codmodelo', 'codmodelo');
    }

    public function representacoes_diagramaticas_cache()
    {
        return Cache::remember('representacoes_diagramaticas_cache' . $this->codmodelo, 2000, function () {
            return $this->representacoes_diagramaticas;
        });

    }

    public function diagramas()
    {
        return $this->hasMany(RepresentacaoDiagramatica::class, 'codmodelo', 'codmodelo');
    }

    public function listar_diagramas()
    {
        return Cache::remember('listar_diagramas', 2000, function () {
            return $this->representacoes_diagramaticas();
        });
    }

    public function tipos()
    {
        return [
            "CLIENTE",
            "COLABORADOR",
            "PROPRIETARIO"
        ];
    }

    public function todos_usuarios()
    {
        return Cache::remember('todos_usuarios' . $this->codmodelo, 2000, function () {
            $usuarios = [];
            if (Auth::user()->papel() == 'ADMINISTRADOR') {
                return User::all();
            } else if (in_array(Auth::user()->papel(), ['PROPRIETARIO', 'COLABORADOR', 'CLIENTE'])) {
                $repositorio = $this->repositorio;
                $usuariosRepositorios = $repositorio->usuarios_repositorios;
                $usuarios = [];
                foreach ($usuariosRepositorios as $participacao) {
                    array_push($usuarios, $participacao->usuario);
                }
                return $usuarios;
            }
            return $usuarios;
        });

    }

    public function representacao_declarativa()
    {
        return $this->hasOne(RepresentacaoDeclarativa::class, 'codmodelo', 'codmodelo');
    }

    public function representacoes_declarativas()
    {

        return $this->hasMany(RepresentacaoDeclarativa::class, 'codmodelo', 'codmodelo');
    }

    public function objetos_fluxos()
    {
        return $this->hasMany(ObjetoFluxo::class, 'codmodelo', 'codmodelo');
    }

    public static function validacao()
    {
        return [
            'nome' => 'required'
        ];
    }

    public function foiDadoPermissao()
    {
        $usuario = Auth::user();
        $entradas = $this->usuarios_modelos;
        foreach ($entradas as $entrada) {
            if ($entrada->codusuario == $usuario->codusuario) {
                return true;
            }
        }
        return false;
    }

    public function permissao()
    {
        if ($this->codusuario == Auth::getUser()->codusuario) return true;
        if ($this->publico) return true;
        return collect($this->usuarios_modelos->where('codusuario', Auth::getUser()->codusuario))->count() > 0;
    }

    public function eColaborador()
    {
        $permissao = $this->usuarios_modelos->where('codusuario', Auth::getUser()->codusuario)->first();
        return !empty($permissao) ? $permissao->tipo === 'COLABORADOR' : false;
    }

    public function eProprietario()
    {
         if($this->projeto->eProprietario()){
             return true;
         }
         $permissao = $this->usuarios_modelos->where('codusuario', Auth::getUser()->codusuario)->first();
         if($permissao === null) {
             return false;
         }
         if($permissao->tipo==='PROPRIETARIO'){
             return true;
         }
         return false;

    }

    public function eCliente()
    {
        $permissao = $this->usuarios_modelos->where('codusuario', Auth::getUser()->codusuario)->first();
        return !empty($permissao) ? $permissao->tipo === 'CLIENTE' : false;
    }

    public function papel()
    {

        if ($this->codusuario == Auth::user()->codusuario) {
            return "PROPRIETARIO";
        }
        if (in_array(Auth::user()->papel(), ['ADMINISTRADOR', 'PROPRIETARIO', 'COLABORADOR', 'CLIENTE'])) {
            return Auth::user()->papel();
        }
        $usuario = Auth::user();
        $entrada = $this->usuarios_modelos->where('codusuario', $usuario->codusuario)->first();

        if (!empty($entrada))
            return $entrada->tipo;
        return null;
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($modelo) { // before delete() method call this
            try {
                DB::beginTransaction();
                DB::table('configuracaoambientemodelagem')
                    ->where('codmodelo', '=', $modelo->codmodelo)
                    ->delete();
                DB::table('usuarios_modelos')
                    ->where('codmodelo', '=', $modelo->codmodelo)
                    ->delete();

                DB::table('objetos_fluxos')
                    ->where('codmodelo', '=', $modelo->codmodelo)
                    ->delete();

                DB::table('regras')
                    ->where('codmodelo', '=', $modelo->codmodelo)
                    ->delete();

                DB::table('representacoes_diagramaticas_versionaveis')
                    ->where('codmodelo', '=', $modelo->codmodelo)
                    ->delete();

                DB::table('representacoes_diagramaticas')
                    ->where('codmodelo', '=', $modelo->codmodelo)
                    ->delete();

                DB::table('representacoes_declarativas')
                    ->where('codmodelo', '=', $modelo->codmodelo)
                    ->delete();


                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }
            limpar_cache();
        });

        static::created(function ($modelo) { // before delete() method call this

            try {
                DB::beginTransaction();
                $dado = [
                    'codusuario' => Auth::getUser()->codusuario,
                    'tipo' => 'PROPRIETARIO',
                    'codmodelo' => $modelo->codmodelo
                ];
                UsuarioModelo::create($dado);
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
            }
        });

    }


}
