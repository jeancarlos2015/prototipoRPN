<?php


namespace App\Http\Fachadas;


use App\Http\Models\Documentacao;
use App\Http\Models\ConfiguracaoAmbienteModelagem;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\ConfiguracaoAmbienteRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaConfiguracaoAmbienteModelagem extends FachadaConcreta
{
    public function index($codigo1 = 0, $codigo2 = 0)
    {
        $diagrama = RepresentacaoDiagramatica::FindOrFail($codigo1);
        return view('configuracao_menu_ambiente_modelagem.index', compact('diagrama'));
    }

    public function create($codigo = null, $codigo2 = 0)
    {
        $diagrama = RepresentacaoDiagramatica::FindOrFail($codigo);
        return view('configuracao_menu_ambiente_modelagem.create', compact('diagrama'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $usuario = User::FindOrFail($request->codusuario);
            if ($usuario->ExisteConfiguracaoAmbienteModelagem()) {
                $configuracao = $usuario->ConfiguracaoAmbienteModelagem;
                $configuracao->update($request->all());
            } else {
                $configuracao = ConfiguracaoAmbienteModelagem::create($request->all());
            }
            DB::commit();
            flash('Operação feita com sucesso')->success();
            return view('configuracao_menu_ambiente_modelagem.edite', compact('configuracao'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'configuracao_menu_ambiente_modelagem';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }

        return redirect()->back();
    }

    public function update(Request $request, $codigo)
    {
        $configuracao = ConfiguracaoAmbienteRepository::update($request,$codigo);
        flash('Operação feita com sucesso!')->success();
        return view('configuracao_menu_ambiente_modelagem.edite', compact('configuracao'));
    }

    public function edit($codDiagrama = null)
    {

        $diagrama = RepresentacaoDiagramatica::FindOrFail($codDiagrama);
        if(!$diagrama->modelo->permissao()){
            abort(403);
        }
        $configuracao = null;
        if($diagrama->existeConfiguracaoAmbienteModelagem()){
            $configuracao = $diagrama->getConfiguracaoambientemodelagem();
        }else{
            ConfiguracaoAmbienteRepository::criarConfiguracaoLimitada($diagrama);
            $configuracao = Auth::getUser()->configuracaoambientemodelagem;
        }
        return view('configuracao_menu_ambiente_modelagem.edite', compact('configuracao','diagrama'));
    }
}
