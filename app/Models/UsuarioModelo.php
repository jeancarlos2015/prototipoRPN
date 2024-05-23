<?php

namespace App\Http\Models;

use App\Http\Models\Modelo;
use App\Http\Util\Dado;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UsuarioModelo extends Model
{
    const TIPOS = [
        'COLABORADOR',
        'PROPRIETARIO',
        'CLIENTE'
    ];
    protected $connection = 'pgsql';
    protected $primaryKey = 'codusuariomodelo';
    protected $table = 'usuarios_modelos';
    protected $fillable = [
        'codusuario',
        'codmodelo',
        'tipo'
    ];


    public function modelo()
    {
        return $this->hasOne(Modelo::class, 'codmodelo', 'codmodelo');
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

        static::created(function ($usuario_modelo) {
            try {
                \DB::beginTransaction();
//                $dadoProjeto = [
//                    'codusuario' => $usuario_modelo->codusuario,
//                    'codprojeto' => $usuario_modelo->modelo->codprojeto,
//                    'tipo' => 'CLIENTE'
//                ];
//                $dadoRepositorio = [
//                    'codusuario' => $usuario_modelo->codusuario,
//                    'codrepositorio' => $usuario_modelo->modelo->codrepositorio,
//                    'tipo' => 'CLIENTE'
//                ];
//                UsuarioProjeto::create($dadoProjeto);
//                UsuarioRepositorio::create($dadoRepositorio);
                if ($usuario_modelo->tipo === 'VALIDADOR') {
                    $modelo = Modelo::find($usuario_modelo->codmodelo);
                    foreach ($modelo->diagramas as $diagrama) {
                        $diagrama->codusuariovalidador = $usuario_modelo->codusuario;
                        $diagrama->update();
                    }
                }
                $dadoLog = [
                    'nome' => 'Validação de Modelo',
                    'descricao' => \Auth::getUser()->name
                        . ' adicionou ' . $usuario_modelo->usuario->name
                        . ' como Validador dos diagramas do modelo ' . $usuario_modelo->modelo->nome,
                    'codusuario' => $usuario_modelo->codusuario,
                    'acao' => 'Gerado na vinculação de um usuario como validador.',
                    'pagina' => '' . \URL::route('exibir_diagrama', [$diagrama->codmodelodiagramatico]),
                    'visto' => false
                ];
                Log::create($dadoLog);
                \DB::commit();
            } catch (\Exception $ex) {
                \DB::rollback();
                $data['mensagem'] = $ex->getMessage();
                $data['tipo'] = 'error';
                $data['pagina'] = 'Ambiente de modelagem';
                $data['acao'] = 'Vinculação de Usuarios';
                LogMessage::create_log($data);
            }

            limpar_cache();

        });


    }

    function eValidador()
    {
        return $this->tipo ==='VALIDADOR';
    }
}
