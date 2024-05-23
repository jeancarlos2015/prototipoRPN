<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\http\Models\Repositorio;
use App\http\Models\Solicitacao;
use App\http\Models\AcessoRecente;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioRepositorio extends Model
{
    const TIPOS = [
        'COLABORADOR',
        'PROPRIETARIO',
        'CLIENTE',
        'VALIDADOR'
    ];
    protected $connection = 'pgsql';
    protected $primaryKey = 'codusuariorepositorio';
    protected $table = 'usuario_repositorios';
    protected $fillable = [
        'codusuario',
        'codrepositorio',
        'tipo'
    ];

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public static function titulos_usuarios()
    {
        return [
            'Usuários',
            'Ações'
        ];
    }

    public static function titulos_repositorios()
    {
        return [
            'Repositórios',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'tipo'
        ];
    }

    public static function atributos()
    {
        return [
            'tipo'
        ];

    }

    public function eValidador()
    {
        return $this->tipo === 'VALIDADOR';
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

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos_usuarios();
        for ($indice = 0; $indice < 2; $indice++) {
            if ($indice < 1) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];
        }
        return $dados;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($usuariorepositorio) { // before delete() method call this
            try {
                DB::beginTransaction();
                $codusuario = $usuariorepositorio->codusuario;
                $usuario = User::find($codusuario);

                if ($usuario != null) {
                    $usuario->codrepositorio = null;
                    $usuario->update();
                }

                $solicitacoes = DB::table('solicitacoes')
                    ->where('codrepositorio', '=', $usuariorepositorio->codrepositorio)
                    ->get();
                $solicitacoes = $solicitacoes->where('codusuario_solicitante', '=', $usuariorepositorio->codusuario);
                foreach ($solicitacoes as $solicitacao) {
                    DB::table('solicitacoes')
                        ->where('codsolicitacao', '=', $solicitacao->codsolicitacao)
                        ->delete();
                }
                DB::commit();

            } catch (\Exception $ex) {
                DB::rollBack();
            }

            limpar_cache();

        });

        static::created(function ($usuario_repositorio) {
            if (Auth::check()) {
                try {
                    DB::beginTransaction();
                    $solicitacoes = DB::table('solicitacoes')
                        ->where('codrepositorio', '=', $usuario_repositorio->codrepositorio)
                        ->get();
                    $solicitacoes = $solicitacoes->where('codusuario_solicitante', '=', $usuario_repositorio->codusuario);
                    foreach ($solicitacoes as $solicitacao) {
                        DB::table('solicitacoes')
                            ->where('codsolicitacao', '=', $solicitacao->codsolicitacao)
                            ->delete();
                    }
                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollBack();
                }


//                try{
//                    DB::beginTransaction();
//                    $recente = [
//
//                        'codmodelo' => null,
//                        'codmensagem' => null,
//                        'codusuario' => Auth::getUser()->codusuario,
//                        'coddocumentacao' => null,
//                        'codmodelodiagramatico' => null,
//                        'codprojeto' => null,
//                        'codrepositorio' => $usuario_repositorio->codrepositorio,
//                        'descricao' => 'Acesso ao Repositório '. $usuario_repositorio->repositorio->nome
//                    ];
//
//                    AcessoRecente::create($recente);
//                    DB::commit();
//                }catch (\Exception $ex){
//                    DB::rollBack();
//                }
            }
            limpar_cache();

        });


    }



}
