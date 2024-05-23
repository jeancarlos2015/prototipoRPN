<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/10/2018
 * Time: 23:47
 */

namespace App\Http\Viwers;


use App\Http\Models\Mensagem;
use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\UsuarioModelo;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Support\Facades\Auth;

class DiagramaViwer
{
    public $modelo = null;
    public $modelos = null;
    public $titulos = null;
    public $usuarios = null;
    public $tipos = null;
    public $tipo='diagramatico';
    public $logs;
    public $mensagens;
    public function __construct($codmodelo = -1){

        try{
            if (Auth::user()->papel() === 'ADMINISTRADOR') {

                $this->modelo = Modelo::findOrFail($codmodelo);
                $this->modelos = $this->modelo->representacoes_diagramaticas;

            } else if (!empty(Auth::user()->papel())) {

                $this->modelo = collect(Auth::user()->repositorio->modelos)
                    ->where('codmodelo', '=', $codmodelo)->first();

              if (!empty($this->modelo)){
                  $this->modelos = $this->modelo->representacoes_diagramaticas;
              }

            }

            $this->titulos = RepresentacaoDiagramatica::titulos();
            $this->tipos = UsuarioModelo::TIPOS;
            $this->usuarios = UserRepository::listar_usuarios();
            $this->logs = LogRepository::listar();
            $this->mensagens = Mensagem::all()
                ->where('visto','=',false)
                ->where('codusuariodestinatario','=',Auth::user()->codusuario);
        }catch (\Exception $ex){
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'DiagramaViwer';
            $data['acao'] = '__construct($codmodelo = -1)';
            LogMessage::create_log($data);
        }

    }
}
