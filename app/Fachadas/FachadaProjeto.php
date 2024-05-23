<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 01:12
 */

namespace App\Http\Fachadas;


use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Models\UsuarioProjeto;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\AcessoRecenteRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaProjeto extends FachadaConcreta
{


    public function index($codrepositorio = null, $request = null)
    {
        $projetos = null;
        $log = null;
        $tipo = null;
        $titulos = null;
        $repositorio = null;
        $usuarios = null;
        $tipos = null;

        try {

            $titulos = Projeto::titulos_da_tabela();
            $tipo = 'projeto';
            $log = LogRepository::log();
            $tipos = UsuarioRepositorio::TIPOS;
            $usuarios = UserRepository::listar_usuarios();
            if (Auth::user()->EAdministrador()) {
                $repositorio = Repositorio::findOrFail($codrepositorio);
                $projetos = collect($repositorio->projetos);
            } else if (Auth::getUser()->usuario_esta_no_repositorio()) {
                $repositorio = Auth::user()->repositorio;
                $projetos = collect($repositorio->projetos);
            }

            return view('controle_projetos.index', compact('repositorio', 'titulos', 'tipo', 'log', 'tipos', 'usuarios', 'projetos'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'index($codrepositorio = null, $request = null)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function criarProjeto(Request $request){

        try {
            if(!Auth::getUser()->usuario_esta_no_repositorio()){
                $data['mensagem'] = "É necessário que esteja vinculado a um repositório.";
                $data['tipo'] = 'error';
                $data['pagina'] = 'Painel';
                $data['acao'] = 'Criação de projeto';
                $resultado =  $this->create_log($data);

                return \Response::json($resultado);
            }
            $resultado =  ProjetoRepository::criarProjeto($request->nome,$request->publico);

            return \Response::json($resultado);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'destroy($codprojeto = null)';
            return $this->create_log($data);
        }

    }
    public function create($codrepositorio = null, $codrepositorio1 = 0)
    {

        $repositorio = null;
        try {
            DB::beginTransaction();
            $dados = Projeto::dados();

            if (!$this->exists($codrepositorio)) {
                $repositorio = Repositorio::findOrFail($codrepositorio);
            } else {

                $repositorio = Repositorio::create(['nome' => 'novo', 'descricao' => 'novo']);
            }
            DB::commit();
            return view('controle_projetos.create', compact('dados', 'repositorio'));

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'create($codrepositorio = null, $codrepositorio1 = 0)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function store(Request $request)
    {

        try {

            $erros = \Validator::make($request->all(), Projeto::validacao());
            $codrepositorio = $request->codrepositorio;
            if ($erros->fails()) {
                return redirect()->back()
                    ->withErrors($erros)
                    ->withInput();
            }
            if (!ProjetoRepository::projeto_existe($request->all())) {
                $request->request->add(['codusuario' => Auth::user()->codusuario]);
                $projeto = ProjetoRepository::incluir($request);
                flash('Projeto criado com sucesso!!')->success();
                return redirect()->route('controle_modelos_index',
                    [
                        'codprojeto' => $projeto->codprojeto
                    ]
                );
            } else {
                $projeto = ProjetoRepository::listar()->where('nome', $request->nome)->first();
                $dados = Projeto::dados();
                $repositorio = Repositorio::findOrFail($codrepositorio);

                return view('controle_projetos.create', compact('dados', 'repositorio', 'projeto'));
            }

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'store(Request $request)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function update(Request $request, $codprojeto)
    {

        try {
            ProjetoRepository::atualizar($request, $codprojeto);
            flash('Operação feita com sucesso!')->success();
            return redirect()->route('controle_modelos_index',
                [
                    'codprojeto' => $codprojeto
                ]);

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'update(Request $request, $codprojeto)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function show($codprojeto = null)
    {
        try {
            $projeto = Projeto::findOrFail($codprojeto);
            if(!$projeto->UsuarioTemPermissao(Auth::getUser())){
                exit(403);
            }
            AcessoRecenteRepository::CriaAcessoRecenteProjeto($projeto,'visualizacao_projeto');
            return redirect()->route('controle_modelos_index', $codprojeto);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'show($codprojeto = null)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function edit($codigo = null)
    {
        try {
            $projeto = Projeto::findOrFail($codigo);
            $dados = Projeto::dados();
            $dados[0]->valor = $projeto->nome;
            $dados[1]->valor = $projeto->descricao;
            $usuarios = UserRepository::listar_usuarios();
            $tipos = UsuarioProjeto::TIPOS;
            return view('controle_projetos.edit', compact('dados', 'projeto', 'usuarios', 'tipos'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'edit($codigo = null)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function destroy($codprojeto = null)
    {
        try {
           $resultado =  ProjetoRepository::excluir($codprojeto);
            return \Response::json($resultado);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'destroy($codprojeto = null)';
            return $this->create_log($data);
        }
    }

    private function exists($codrepositorio)
    {
        $repositorio = (new Repositorio)->where('codrepositorio', '=', $codrepositorio)->first();
        return $repositorio === null;

    }

    public function all()
    {
        $projetos = null;

        try {

            $titulos = Projeto::titulos_da_tabela();
            $usuarios = UserRepository::listar_usuarios();
            $tipo = 'projeto';
            $tipos = UsuarioRepositorio::TIPOS;
            $log = LogRepository::log();
             if (Auth::getUser()->usuario_esta_no_repositorio()) {
                $repositorio = Auth::user()->repositorio;
                $projetos = $repositorio->projetos;
                return view('controle_projetos.index', compact('repositorio', 'titulos', 'tipo', 'log', 'tipos', 'usuarios', 'projetos'));
            }
            else if (Auth::user()->EAdministrador()) {
                $projetos = ProjetoRepository::listar();
                return view('controle_projetos.all', compact('titulos', 'tipo', 'log', 'projetos'));
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'all()';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }
}
