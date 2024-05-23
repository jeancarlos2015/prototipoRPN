<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/09/2018
 * Time: 21:42
 */

namespace App\Http\Fachadas;


use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaRepresentacaoDeclarativa extends FachadaModelo
{
    public function create($codmodelo = null, $codmodelo1 = 0)
    {
        $titulos = RepresentacaoDeclarativa::titulos();
        $dados = RepresentacaoDeclarativa::dados();
        $tipo = 'modelo_declarativo';
        $modelo = collect(UserRepository::auth_user_repositorio_modelos())
            ->where('codmodelo', '=', $codmodelo)->first();
        if(!$modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        return view('controle_modelos_declarativos.modelos_declarativos.create',
            compact('titulos', 'dados', 'tipo', 'modelo'));
    }

    public function index($codmodelo = 0, $request2 = 0)
    {
        $modelo = null;
        $modelos = null;
        $titulos = null;
        try {
            if (Auth::user()->papel() === 'ADMINISTRADOR') {
                $modelo = Modelo::findOrFail($codmodelo);
            } else if (!empty(Auth::user()->papel())) {
                $modelo = collect(UserRepository::auth_user_repositorio_modelos())
                    ->where('codmodelo', '=', $codmodelo)->first();
                if (empty($modelo)) {
                    return abort(404);
                }
            }

            $titulos = RepresentacaoDeclarativa::titulos();
            $modelos = collect($modelo->representacoes_declarativas);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDeclarativa';
            $data['acao'] = 'index($codmodelo = 0, $request2 = 0)';
            LogMessage::create_log($data);
        }
        $tipo = 'declarativo';
        return view('controle_modelos_declarativos.modelos_declarativos.index', compact('modelos', 'modelo', 'titulos', 'tipo'));

    }

    public function store(Request $request)
    {
        $modelo = collect(UserRepository::auth_user_repositorio_modelos())
            ->where('codmodelo', '=', $request->codmodelo)->first();
        $codprojeto = $modelo->codprojeto;
        $codrepositorio = $modelo->codrepositorio;
        $data['all'] = $request->all();
        $data['validacao'] = RepresentacaoDeclarativa::validacao();
        if (!$this->exists_errors($data)) {
            $request->request->add(['codusuario' => Auth::user()->codusuario]);
            $request->request->add(['codrepositorio' => $codrepositorio]);
            $request->request->add(['codprojeto' => $codprojeto]);
            if (!RepresentacaoDeclarativaRepository::existe($request->nome)) {
                $representacao_declarativa = RepresentacaoDeclarativaRepository::incluir($request);

                return redirect()->route('controle_objeto_fluxo_index',
                    [
                        'codmodelodeclarativo' => $representacao_declarativa->codmodelodeclarativo
                    ]);
            } else {
                $titulos = RepresentacaoDeclarativa::titulos();
                $dados = RepresentacaoDeclarativa::dados();
                $tipo = 'declarativa';
                $representacao_declarativa = RepresentacaoDeclarativaRepository::listar()->where('nome', $request->nome)->first();
                $repositorio = $modelo->repositorio;
                $projeto = $modelo->projeto;
                return view('controle_modelos_declarativos.modelos_declarativos.create',
                    compact('titulos', 'dados', 'tipo', 'repositorio', 'projeto', 'modelo', 'representacao_declarativa'));
            }


        }

        $erros = $this->get_errors($data);
        return redirect()->route('controle_modelos_declarativos_create', [
            'codrepositorio' => $codrepositorio,
            'codprojeto' => $codprojeto
        ])
            ->withErrors($erros)
            ->withInput();
    }

    public function update(Request $request, $codmodelodeclarativo)
    {
        try {

            $modelo = RepresentacaoDeclarativaRepository::atualizar($request, $codmodelodeclarativo);
            flash('Operação feita com sucesso')->success();
            return redirect()->route('edicao_modelo_declarativo', [
                'codmodelodeclarativo' => $modelo->codmodelodeclarativo
            ]);

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDeclarativa';
            $data['acao'] = 'update(Request $request, $codmodelodeclarativo)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function show($codmodelodeclarativo = null)
    {
        $rotas = $this->rotas();
        if (count($rotas) == 0) {
            flash('Favor solicitar ao administrador que vincule sua conta a uma repositório!!')->warning();
        }
        return redirect()->route('controle_objeto_fluxo_index', [$codmodelodeclarativo]);
    }

    public function edit($codigo = null)
    {
        try {

            $modelo = RepresentacaoDeclarativa::findOrFail($codigo);

            $dados = RepresentacaoDeclarativa::dados();
            $projeto = $modelo->projeto;
            $repositorio = $modelo->repositorio;

            $dados[0]->valor = $modelo->nome;
            $dados[1]->valor = $modelo->descricao;
            $dados[2]->valor = $modelo->tipo;

            return view('controle_modelos_declarativos.modelos_declarativos.edit', compact('dados', 'modelo', 'projeto', 'repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDeclarativa';
            $data['acao'] = 'edit($codigo = null)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function destroy($codigo = null)
    {

        $resultado = RepresentacaoDeclarativaRepository::excluir($codigo);
        return \Response::json($resultado);
    }


    private function rotas()
    {
        if (!empty(Auth::user()->papel())) {
            return [
                'controle_objeto_fluxo_index'
            ];
        }
        return [];

    }
}
