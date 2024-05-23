<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 03:47
 */

namespace App\Http\Fachadas;


use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\UsuarioProjeto;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Util\LogMessage;
use App\Http\Viwers\ModeloViewer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use const http\Client\Curl\AUTH_ANY;

class FachadaModelo extends FachadaConcreta
{
    public static function make($tipo)
    {
        switch ($tipo) {
            case 'RepresentacaoDiagramatica':
                return new FachadaRepresentacaoDiagramatica();
            case 'RepresentacaoDeclarativa':
                return new FachadaRepresentacaoDeclarativa();
            default:
                return new FachadaModelo();
        }
    }


    public function all()
    {
        $repositorio = null;
        if (Auth::user()->usuario_esta_no_repositorio()) $repositorio = Auth::user()->repositorio;
        return view('controle_modelos.all', compact('repositorio'));
    }

    public function create($codprojeto = null, $codprojeto1 = 0)
    {
        try {
            $projeto = Projeto::findOrFail($codprojeto);
            if (!$projeto->repositorio->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
            $dado['codprojeto'] = $projeto->codprojeto;
            $dado['codrepositorio'] = $projeto->codrepositorio;
            $dados = Modelo::dados();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'create($codprojeto = null, $codprojeto1 = 0)';
            LogMessage::create_log($data);
        }

        return view('controle_modelos.create', compact('dado', 'projeto', 'dados'));

    }

    public function update(Request $request, $codigo)
    {
        if (!empty($request->tipoOperacao)) {
            ModeloRepository::atualizarDescricao($request, $codigo);
            flash('Operação feita com sucesso')->success();
            return redirect()->back();
        } else {
            $modelo = ModeloRepository::FindOrFail($codigo);
            if (ModeloRepository::atualizar($request, $codigo)) {
                flash('Operação feita com sucesso')->success();
                return redirect()->route('controle_modelos_index', [$modelo->codprojeto]);
            }
        }
    }

    public function atualizar(Request $request, $codigo)
    {

        $resultado = ModeloRepository::atualizar($request, $codigo);
        return \Response::json($resultado);

    }
    public function atualizarDescricao(Request $request, $codigo)
    {
        ModeloRepository::atualizarDescricao($request, $codigo);
        return redirect()->back();

    }
    public function edit($codigo = null)
    {

        $modelo = Modelo::findOrFail($codigo);
        if (!$modelo->repositorio->UsuarioTemPermissao(Auth::getUser())) {
            exit(403);
        }
        $dados = Modelo::dados();
        $dados[0]->valor = $modelo->nome;
        $dados[1]->valor = $modelo->descricao;
        return view('controle_modelos.edit', compact('modelo', 'dados'));
    }

    public function store(Request $request)
    {

        $result = ModeloRepository::incluir($request->all());
        flash('Operação feita com sucesso!')->success();
        if ($result->incluiu)
            return redirect()->route('controle_modelos_diagramaticos_index', [$result->codmodelo()]);
        else
            $modelo = $result->getModelo();
        $dados = Modelo::dados();
        $projeto = Projeto::FindOrFail($request->codprojeto);
        return view('controle_modelos.create', compact('dados', 'modelo', 'projeto'));
    }

    public function index($codprojeto = 0, $request2 = 0)
    {
        $usuarios = UserRepository::atualizarElista($codprojeto);
        $tipos = UsuarioProjeto::TIPOS;
        $titulos = Modelo::titulos();
        $tipo = 'modelo';
        $titulo = 'projeto';
        $projeto = Projeto::FindOrFail($codprojeto);
        return view('controle_modelos.index', compact('projeto', 'titulos', 'tipo', 'usuarios', 'tipos', 'titulo'));
    }

    public function destroy($codigo = null)
    {
        $resultado = ModeloRepository::excluir($codigo);
        return \Response::json($resultado);
    }
}
