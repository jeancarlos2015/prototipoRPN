<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/10/2018
 * Time: 23:30
 */

namespace App\Http\Viwers;


use App\Http\Models\Log;
use App\Http\Models\Mensagem;
use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\UsuarioModelo;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloViewer
{
    public $tipo = 'modelo';
    public $dados;
    public $titulos;
    public $rotas;
    public $quantidades;
    public $repositorio;
    public $usuarios;
    public $modelo;
    public $modelos;
    public $tipo_modelo = 'tipo';
    public $log;
    public $projeto;
    public $codprojeto;
    public $codrepositorio;
    public $representacao_diagramatica;
    public $mensagens;
    public $logs;
    public $vinculacoes;

    public function __construct($codmodelodiagramatico = -1, $tipo = null)
    {
        try {

            if ($codmodelodiagramatico !== -1) {

                $this->tipo = 'modelo';
                $this->titulos = self::titulos();
                $this->rotas = self::rotas();

                $this->quantidades = self::quantidades($codmodelodiagramatico);

                $this->tipos = UsuarioModelo::TIPOS;

                 $representacao = RepresentacaoDiagramatica::findOrFail($codmodelodiagramatico);
                $this->modelo = $representacao->modelo;
                $usuario = Auth::user();
                $usuario->codmodelo = $representacao->codmodelo;
                $usuario->update();
                UserRepository::limpar_cache();

                $repositorio = $this->modelo->repositorio;
                $entradas = $repositorio->usuarios_repositorios;
                $this->usuarios = [];
                foreach ($entradas as $entrada) {
                    array_push($this->usuarios, $entrada->usuario);
                }

                $this->dados = Modelo::dados();
                $this->titulos = Modelo::titulos();
                $this->log = LogRepository::log();
            } else if ($codmodelodiagramatico == 2) {

                $this->dados = Modelo::dados();
            } else {

                $this->execute();
            }

            $this->logs = LogRepository::listar();
            $this->mensagens = Mensagem::all()
                ->where('visto', '=', false)
                ->where('codusuariodestinatario', '=', Auth::user()->codusuario);

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'ModeloViewer';
            $data['acao'] = 'ModeloViwer no Construtor';
            LogMessage::create_log($data);
        }

    }

    public function execute()
    {

        try {
            if (Auth::user()->papel() === 'ADMINISTRADOR') {
                $this->modelos = ModeloRepository::listar();
                $this->usuarios = UserRepository::listar_usuarios();
            } else if (Auth::user()->usuario_esta_no_repositorio() && Auth::user()->papel() === 'PROPRIETARIO') {
                $this->modelos = collect(Auth::user()->repositorio->modelos);
                $this->usuarios = Auth::user()->usuarios_do_repositorio();
                $this->repositorio = Auth::user()->repositorio;
            } else if (Auth::user()->e_usuario_normal() && Auth::user()->usuario_esta_no_repositorio()) {

                $this->modelos = collect(Auth::user()->modelos());
                $this->usuarios = Auth::user()->usuarios_do_repositorio();
                $this->repositorio = Auth::user()->repositorio;
            }

            $this->dados = Modelo::dados();
            $this->titulos = Modelo::titulos();
            $this->log = LogRepository::log();

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'ModeloViewer';
            $data['acao'] = 'ModeloViewer no Execute';
            LogMessage::create_log($data);
        }
    }

    public function salvar(Request $request = null, $dado = [])
    {

        try {
            if (!LogMessage::exists_errors($dado)) {

                $modelo = Modelo::findOrFail($request->codmodelo);

                $this->codprojeto = $modelo->codprojeto;
                $this->codrepositorio = $modelo->codrepositorio;
                $this->representacao_diagramatica = RepresentacaoDiagramaticaRepository::incluir($request);
                if (!empty($this->representacao_diagramatica)) {
                    return $this->representacao_diagramatica;
                } else {
                    $this->dados = RepresentacaoDiagramatica::dados();
                    $this->repositorio = $modelo->repositorio;
                    $this->projeto = $modelo->projeto;
                    return null;
                }

            }

            $this->projeto = $this->modelo->projeto;
            $entradas = $this->projeto->usuarios_projetos;
            $this->usuarios = [];
            foreach ($entradas as $entrada) {
                array_push($this->usuarios, $entrada->usuario);
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'ModeloViewer';
            $data['acao'] = 'Salvar';
            LogMessage::create_log($data);
        }
    }

    private
    function rotas()
    {

        return [
            'controle_modelos_declarativos_lista',
            'controle_modelos_diagramaticos_index'
        ];

    }

    private
    function titulos()
    {

        return [

            'Representações Declarativas',
            'Representações Diagramáticas'
        ];


    }

    private
    function quantidades($codmodelo)
    {
        $representacao = RepresentacaoDiagramatica::findOrFail($codmodelo);
        $modelo = $representacao->modelo;
        $qt_representacoes_diagramaticas = $modelo->representacoes_diagramaticas->count();
        $qt_representacoes_declarativas = $modelo->representacoes_declarativas->count();

        return [
            $qt_representacoes_declarativas,
            $qt_representacoes_diagramaticas
        ];

    }
}
