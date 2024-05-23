<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\http\Models\AcessoRecente;
use App\http\Models\Projeto;
class UsuarioProjeto extends Model
{
    const TIPOS = [
        'COLABORADOR',
        'PROPRIETARIO',
        'CLIENTE'
    ];

    protected $connection = 'pgsql';
    protected $primaryKey = 'codusuarioprojeto';
    protected $table = 'usuarios_projetos';
    protected $fillable = [
        'codusuario',
        'codprojeto',
        'tipo'
    ];

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
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

    public static function titulos_projetos()
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
        static::deleting(function () { // before delete() method call this
            limpar_cache();
        });

        static::created(function ($usuario_projeto) {
//            try {
//                DB::beginTransaction();
//                $recente = [
//
//                    'codmodelo' => null,
//                    'codmensagem' => null,
//                    'codusuario' => Auth::getUser()->codusuario,
//                    'coddocumentacao' => null,
//                    'codmodelodiagramatico' => null,
//                    'codprojeto' => $usuario_projeto->codprojeto,
//                    'codrepositorio' => null,
//                    'descricao' => 'Acesso ao Projeto ' . $usuario_projeto->projeto->nome
//                ];
//
//                AcessoRecente::create($recente);
//                DB::commit();
//            } catch (\Exception $ex) {
//                DB::rollBack();
//            }
            limpar_cache();

        });


    }

    function eValidador()
    {
        return $this->tipo ==='VALIDADOR';
    }
}
