<?php

namespace App\Http\Fachadas;

use App\http\Models\Repositorio;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaRepositorio extends FachadaConcreta
{


    public function index($dado = null, $request = null)
    {

        try {
            if (Auth::user()->usuario_esta_no_repositorio()) {
                $repositorios = collect(Auth::user()->repositorio);
            } else if (Auth::user()->papel() == 'ADMINISTRADOR') {
                $repositorios = Auth::getUser()->todos_repositorios();
            }
            $titulos = Repositorio::titulos_da_tabela();
            $campos = Repositorio::campos();
            $tipo = 'repositorio';
            $log = LogRepository::log();
            $tipos = UsuarioRepositorio::TIPOS;
            $users = UserRepository::listar_usuarios();
            return view('controle_repositorios.index', compact('repositorios', 'titulos', 'campos', 'tipo', 'log', 'tipos', 'users'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'index';
            LogMessage::create_log($data);
        }
    }


    public function create($codmodelodeclarativo = null, $codmodelodeclarativo1 = 0)
    {
        $dados = Repositorio::dados();
        return view('controle_repositorios.create', compact('dados'));
    }

    public function criarRepositorioPadrao($nome){
        return RepositorioRepository::criarRepositorioPadrao($nome);
    }
    public function atualizarRepositorioPadrao($nome){
        try {
            DB::beginTransaction();
            $repositorio = Auth::getUser()->repositorio;
            $repositorio->nome = $nome;
            $repositorio->update();
            DB::commit();
            $resultado = flash('Operação feita com sucesso!');
        }catch (\Exception $ex){
            DB::rollBack();
            $resultado = flash('Ops! Algo deu errado!');
        }
        return \Response::json($resultado);
    }
    public function store(Request $request = null)
    {
        try {

            $erros = \Validator::make($request->all(), Repositorio::validacao());
            if ($erros->fails()) {
                return redirect()->route('controle_repositorios.create')
                    ->withErrors($erros)
                    ->withInput();
            }
            if (!RepositorioRepository::repositorio_existe($request->nome)) {
                $repositorio = RepositorioRepository::incluir($request);

                if (isset($repositorio)) {
                    flash('Organização criada com sucesso!!');
                } else {
                    flash('Organização não foi criada!!');
                }
                return redirect()->route('controle_projetos_index',
                    [
                        'codrepositorio' => $repositorio->codrepositorio
                    ]
                );
            } else {

                $dados = Repositorio::dados();
                $repositorio = RepositorioRepository::listar()->where('nome', $request->nome)->first();
                return view('controle_repositorios.create', compact('dados', 'repositorio'));
            }

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'store';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }

    public function show($codigo = null)
    {
        return redirect()->route('controle_projetos_index',
            [
                'codrepositorio' => $codigo
            ]
        );
    }

    public function update(Request $request, $codrepositorio)
    {
        try {
            $repositorio = RepositorioRepository::atualizar($request, $codrepositorio);
            if (isset($repositorio)) {
                flash('Organização Atualizada com sucesso!!');
            } else {
                flash('Organização não foi Atualizada!!');
            }
            return redirect()->route('controle_repositorios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'update';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }

    public function edit($codigo = null)
    {
        try {
            $repositorio = Repositorio::findOrFail($codigo);
            $dados = Repositorio::dados();
            $dados[0]->valor = $repositorio->nome;
            $dados[1]->valor = $repositorio->descricao;
            $tipos = UsuarioRepositorio::TIPOS;
            $usuarios = UserRepository::listar_usuarios();
            return view('controle_repositorios.edit', compact('dados', 'repositorio', 'tipos', 'usuarios'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'edit';
            LogMessage::create_log($data);
        }
        return redirect()->route('painel');
    }

    public function destroy($codigo = null)
    {
        $resultado =  RepositorioRepository::excluir($codigo);
        return \Response::json($resultado);
    }


}
