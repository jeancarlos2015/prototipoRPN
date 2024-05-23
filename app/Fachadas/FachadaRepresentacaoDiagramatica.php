<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/09/2018
 * Time: 21:16
 */

namespace App\Http\Fachadas;


use App\Http\Models\AcessoRecente;
use App\Http\Models\Mensagem;
use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\UsuarioModelo;
use App\Http\Repositorys\AcessoRecenteRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use App\Http\Util\LogMessage;
use App\Http\Viwers\DiagramaViwer;
use App\Http\Viwers\ModeloViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaRepresentacaoDiagramatica extends FachadaModelo
{
    public function index($codmodelo = null, $request2 = null)
    {
        try {

            $modelo = Modelo::FindOrFail($codmodelo);
            if (!$modelo->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'index($codmodelo = null, $request2 = null)';
            LogMessage::create_log($data);
        }
        return view('controle_modelos_diagramaticos.index', compact('modelo'));
    }

    public function create($codmodelo = null, $codmodelo1 = 0)
    {
        try {
            $modelo = Modelo::findOrFail($codmodelo);
            if (!$modelo->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'create($codmodelo = null, $codmodelo1 = 0)';
            LogMessage::create_log($data);
        }
        return view('controle_modelos_diagramaticos.create', compact('modelo'));
    }

    public function Validar($codmodelodiagramatico)
    {
        $diagrama = RepresentacaoDiagramatica::find($codmodelodiagramatico);
        if ($diagrama->validado) {
            RepresentacaoDiagramatica::where('codmodelodiagramatico', $codmodelodiagramatico)
                ->update(['validado' => 'false', 'codusuariovalidador' => Auth::getUser()->codusuario]);
        } else {
            RepresentacaoDiagramatica::where('codmodelodiagramatico', $codmodelodiagramatico)
                ->update(['validado' => 'true', 'codusuariovalidador' => Auth::getUser()->codusuario]);
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {

        $representacao_diagramatica = null;
        $modelo_viwer = null;
        $modelo = Modelo::findOrFail($request->codmodelo);

        if (!$modelo->UsuarioTemPermissao(Auth::getUser())) {
            exit(403);
        }
        $mensagem = "Já existe um diagrama com teste nome";
        try {


            // dd($modelo,$request->all());
            if (!RepresentacaoDiagramaticaRepository::existe($request->nome, $modelo->codmodelo)) {
                $codprojeto = $modelo->codprojeto;
                $codrepositorio = $modelo->codrepositorio;
                $data['all'] = $request->all();
                $data['validacao'] = RepresentacaoDiagramatica::validacao();
                $modelo_viwer = new ModeloViewer(2);
                if (!LogMessage::exists_errors($data)) {
                    if (!isset($request->all()["descricao"]))
                        $request->request->add(['descricao' => '***']);
                    $representacao_diagramatica = RepresentacaoDiagramaticaRepository::incluir($request);
                    return redirect()->route('edicao_modelo_diagramatico', [$representacao_diagramatica->codmodelodiagramatico]);
                }
                if (LogMessage::exists_errors($data)) {
                    $erros = LogMessage::get_errors($data);
                    return redirect()->route('controle_modelos_diagramaticos_create', [
                        'codrepositorio' => $codrepositorio,
                        'codprojeto' => $codprojeto
                    ])
                        ->withErrors($erros)
                        ->withInput();
                }
            }

            return view('controle_modelos_diagramaticos.modeler', compact('modelo_viwer'));

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'store(Request $request)';
            LogMessage::create_log($data);
            return redirect()->back();
        }


    }
    public function atualizarDescricao(Request $request, $codigo)
    {
        RepresentacaoDiagramaticaRepository::atualizarDescricao($request, $codigo);
        return redirect()->back();
    }

    public function update(Request $request, $codigo)
    {

        try {
            if (!empty($request->tipoOperacao)) {
                RepresentacaoDiagramaticaRepository::atualizarDescricao($request, $codigo);
                return redirect()->back();
            } else
                $modelo = RepresentacaoDiagramaticaRepository::atualizar($request, $codigo);
            return redirect()->route('edicao_modelo_diagramatico', [
                'codmodelodiagramatico' => $modelo->codmodelodiagramatico
            ]);


        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }

    public function show($codmodelo = null)
    {
        try {

            $modelo = RepresentacaoDiagramaticaRepository::visualizar_modelo($codmodelo);
            $logs = LogRepository::listar();
            $mensagens = Mensagem::orderBy('codmensagem', 'desc')
                ->where('visto', '=', false)
                ->where('codusuariodestinatario', '=', Auth::user()->codusuario)
                ->take(5)
                ->get();
            AcessoRecenteRepository::CriaAcessoRecenteDiagrama($modelo, 'visualizacao_diagrama', 'Acesso ao diagrama ' . $modelo->nome);
            return view('controle_modelos_diagramaticos.visualizar_modelo', compact('modelo', 'mensagens', 'logs'));


        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'show($codmodelo = null)';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }

    public function edit($codmodelo = null)
    {
        try {

            $representacao_diagramatica = RepresentacaoDiagramatica::findOrFail($codmodelo);

            $dados = RepresentacaoDiagramatica::dados();

            $dados[0]->valor = $representacao_diagramatica->nome;
            $dados[1]->valor = $representacao_diagramatica->descricao;
            $dados[2]->valor = $representacao_diagramatica->tipo;
            $modelo = $representacao_diagramatica->modelo;
            $projeto = $modelo->projeto;
            $entradas = $projeto->usuarios_projetos;
            $usuarios = [];
            foreach ($entradas as $entrada) {
                array_push($usuarios, $entrada->usuario);
            }
            $tipos = UsuarioModelo::TIPOS;
            return view('controle_modelos_diagramaticos.edit', compact('dados', 'representacao_diagramatica', 'usuarios', 'tipos'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'edit($codmodelo = null)';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }

    public function destroy($codmodelodiagramatico = null)
    {
        $resultado = RepresentacaoDiagramaticaRepository::excluir($codmodelodiagramatico);
        return \Response::json($resultado);
    }


}
