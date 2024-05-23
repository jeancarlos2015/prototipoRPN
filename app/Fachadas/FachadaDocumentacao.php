<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 04:32
 */

namespace App\Http\Fachadas;


use App\Http\Models\Documentacao;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Util\LogMessage;
use App\Http\Viwers\DocumentacaoViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FachadaDocumentacao extends FachadaConcreta
{

    public function index($request = null, $request2 = null)
    {

        try {
            $documentacao_view = new DocumentacaoViewer();
            return view('controle_documentacao.index', compact('documentacao_view'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'index($request = null, $request2 = null)';
            $this->create_log($data);
        }
    }

    public function gravar(Request $request)
    {
        $request->request->add(['publico' => false]);
        DocumentacaoRepository::incluir($request);
        return redirect()->back();
    }

    public function alterar(Request $request, $coddocumentacao)
    {
        DocumentacaoRepository::atualizar($request, $coddocumentacao);
        return redirect()->back();
    }

    public function create($request = null, $codigo = 0)
    {
        $dados = Documentacao::dados();
        return view('controle_documentacao.create', compact('dados'));
    }

    public function store(Request $request)
    {
        $data['all'] = $request->all();
        $data['validacao'] = Documentacao::validacao();
        $data['rota'] = 'controle_documentacoes.create';
        $this->validar($data);
        DocumentacaoRepository::incluir($request);
        flash('Operação feita com sucesso!')->success();
        return redirect()->route('controle_documentacoes.index');

    }

    public function update(Request $request, $coddocumentacao)
    {
        $repositorio = DocumentacaoRepository::atualizar($request, $coddocumentacao);
        flash('Operação feita com sucesso!')->success();
        if ($repositorio != null)
            return redirect()->route('controle_documentacoes.index');
        return redirect()->route('painel');
    }

    public function show($codigo = null)
    {
        return redirect()->route('controle_documentacoes.index');
    }



    public function edit($codigo = null)
    {
        try {
            $documentacao_view = new DocumentacaoViewer($codigo);
            return view('controle_documentacao.edit', compact('documentacao_view'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'edit($codigo = null)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function destroy($coddocumentacao = null)
    {
        $resultado = DocumentacaoRepository::excluir($coddocumentacao);
        return \Response::json($resultado);
    }

}
