<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 03:30
 */

namespace App\Http\Fachadas;


use App\http\Models\ObjetoFluxo;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaObjetoFluxo extends FachadaConcreta
{


    public function index($codmodelodeclarativo = 0, $codigo2 = 0)
    {
        $modelo_declarativo = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        if(!$modelo_declarativo->modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        $tipo = 'objetofluxo';
        $titulos = ObjetoFluxo::titulos_da_tabela();
        return view('controle_modelos_declarativos.controle_objetos_fluxo.index', compact('tipo', 'titulos', 'modelo_declarativo'));

    }

    public function create($codmodelodeclarativo = null, $codmodelodeclarativo1 = 0)
    {
        $representacao_declarativa = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        if(!$representacao_declarativa->modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        return view('controle_modelo_declarativo1.create', compact('representacao_declarativa'));
    }

    public function store(Request $request)
    {
        $representacao_declarativa = RepresentacaoDeclarativa::findOrFail($request->codmodelodeclarativo);
        if(!$representacao_declarativa->modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        $tamanho = count($request->objetos);
        $objetos = $request->objetos;
        $tipos = $request->tipos;
        for ($indice = 0; $indice < $tamanho; $indice++) {
            $dado = [
                'codusuario' => Auth::user()->codusuario,
                'codmodelo' => $representacao_declarativa->codmodelo,
                'codmodelodeclarativo' => $representacao_declarativa->codmodelodeclarativo,
                'codprojeto' => $representacao_declarativa->codprojeto,
                'codrepositorio' => $representacao_declarativa->codrepositorio,
                'nome' => $objetos[$indice],
                'tipo' => $tipos[$indice],
                'descricao' => 'Nenhum',
                'publico' => true
            ];
            if (!ObjetoFluxoRepository::existe($objetos[$indice])) {
                ObjetoFluxoRepository::incluir_objeto_fluxo($dado);
            } else {
                $data['tipo'] = 'existe';
                LogMessage::create_log($data);
                break;
            }
        }
        flash('Operação feita com sucesso')->success();
        return redirect()->route('controle_objeto_fluxo_index', [$request->codmodelodeclarativo]);
    }

    public function update(Request $request, $codigo)
    {
        try {
            $data['all'] = $request->all();
            $data['validacao'] = ObjetoFluxo::validacao();
            if (!LogMessage::exists_errors($data)) {

                $objeto_fluxo = ObjetoFluxoRepository::atualizar($request, $codigo);
                flash('Operação feita com sucesso')->success();
                $dados = ObjetoFluxo::dados();
                $tipos = ObjetoFluxo::tipos();
                $dados[0]->valor = $objeto_fluxo->nome;
                $dados[1]->valor = $objeto_fluxo->descricao;
                return view('controle_modelos_declarativos.controle_objetos_fluxo.edit', compact('dados', 'tipos', 'objeto_fluxo'));
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaObjetoFluxo';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function edit($codigo = null)
    {
        try {


            $objeto_fluxo = ObjetoFluxo::findOrFail($codigo);
            $dados = ObjetoFluxo::dados();
            $tipos = ObjetoFluxo::tipos();
            $dados[0]->valor = $objeto_fluxo->nome;
            $dados[1]->valor = $objeto_fluxo->descricao;
            return view('controle_modelos_declarativos.controle_objetos_fluxo.edit', compact('dados', 'tipos', 'objeto_fluxo'));

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaObjetoFluxo';
            $data['acao'] = 'edit($codigo = null)';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }

    public function destroy($codobjetofluxo = 0)
    {
        try {
            ObjetoFluxoRepository::excluir($codobjetofluxo);
            return redirect()->route('todos_objetos_fluxos');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaObjetoFluxo';
            $data['acao'] = 'destroy($codobjetofluxo = 0)';
            LogMessage::create_log($data);
        }
        return redirect()->back();
    }


    public function all()
    {
        $objetos_fluxos = null;

        if (Auth::user()->papel() === 'ADMINISTRADOR') {
            $objetos_fluxos = ObjetoFluxoRepository::listar();
        } elseif (!empty(Auth::user()->papel())) {

            $objetos_fluxos = collect(Auth::user()->repositorio->objetos_fluxos);
        }
        $tipo = 'objetofluxo';
        $titulos = ObjetoFluxo::titulos_da_tabela();
        return view('controle_modelos_declarativos.controle_objetos_fluxo.all', compact('objetos_fluxos', 'tipo', 'titulos'));
    }

    public function show($codigo = null)
    {
        $objeto = ObjetoFluxo::findOrFail($codigo);
        return view('controle_modelos_declarativos.controle_objetos_fluxo.show', compact('objeto'));
    }

}
