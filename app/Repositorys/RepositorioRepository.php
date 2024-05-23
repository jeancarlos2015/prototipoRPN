<?php

namespace App\Http\Repositorys;


use App\Http\Models\Repositorio;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RepositorioRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Repositorio::class);
    }

    public static function listar()
    {
        return Cache::remember('listar_repositorios'.Auth::getUser()->codusuario, 2000, function () {
                return collect(Repositorio::all());
        });
    }

    public static function listar_repositorios_publicos()
    {
        return Cache::remember('listar_repositorios_publicos'.Auth::getUser()->codusuario, 2000, function () {
            return collect(Repositorio::where('publico','=',true)
                ->get());
        });
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codrepositorio)
    {



        $value = null;
        try {
            DB::beginTransaction();
            $value = Repositorio::findOrFail($codrepositorio);
            if(!$value->UsuarioTemPermissao(Auth::getUser())){
                exit(403);
            }
            $value->update($request->all());
            limpar_cache_geral();
            DB::commit();
            return $value;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Atualização de repositório';
            $data['acao'] = 'Atualização do repositório';
            LogMessage::create_log($data);
        }

    }

    public static function limpar_cache()
    {
        Cache::forget('listar_repositorios'.Auth::getUser()->codusuario);
        Cache::forget('listar_repositorios_publicos'.Auth::getUser()->codusuario);
        Cache::forget('listar_codigos_repositorios'.Auth::getUser()->codusuario);
        Cache::forget('usuarios_repositorios'.Auth::getUser()->codusuario);
    }
    public static function criarRepositorioPadraoUsuario($user){
        $resultado = null;
        $dado = [
            'nome' => $user->name,
            'descricao' => 'seja bem vindo',
            'publico' => true,
            'codusuario_criador' => $user->codusuario
        ];
        if (!RepositorioRepository::repositorio_existeUsuario($user->name)) {
            $repositorio = RepositorioRepository::criarRepositorio($dado);
            $user->codrepositorio = $repositorio->codrepositorio;
            try{
                DB::beginTransaction();
                $user->update();
                DB::commit();
            }catch (\Exception $ex){
                DB::rollBack();
            }

            if($repositorio){
                $resultado =    flash('Repositorio criado com sucesso!!')->success();
            }

        }else{
            $resultado =    flash('Repositorio ja existe!!')->warning();
        }

        return \Response::json($resultado);
    }
    public static function criarRepositorioPadrao($nome){
        $resultado = null;
        $dado = [
            'nome' => $nome,
            'descricao' => 'seja bem vindo',
            'publico' => true,
            'codusuario_criador' => Auth::getUser()->codusuario
        ];
        if (!RepositorioRepository::repositorio_existe($nome)) {
            $repositorio = RepositorioRepository::criarRepositorio($dado);
            $user = Auth::getUser();
            $user->codrepositorio = $repositorio->codrepositorio;
            try{
                DB::beginTransaction();
                $user->update();
                DB::commit();
            }catch (\Exception $ex){
                DB::rollBack();
            }

            if($repositorio){
                $resultado =    flash('Repositorio criado com sucesso!!')->success();
            }

        }else{
            $resultado =    flash('Repositorio ja existe!!')->warning();
        }

        return \Response::json($resultado);
    }

    public static function criarRepositorio($dado)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = Repositorio::create($dado);
            limpar_cache_geral();
            DB::commit();
            return $value;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Criação de Repositóroi';
            $data['acao'] = 'Criação de Repositoŕio';
            LogMessage::create_log($data);
        }

        return $value;
    }
    public static function incluirUsuarioRepositorio(Request $request)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = Repositorio::create($request->all());
            limpar_cache_geral();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Criação de Repositóroi';
            $data['acao'] = 'Criação de Repositoŕio';
            LogMessage::create_log($data);
        }

        return $value;
    }
    public static function incluir(Request $request)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $request->request->add(['codusuario_criador' => Auth::user()->codusuario]);
            $value = Repositorio::create($request->all());
            limpar_cache_geral();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Criação de Repositóroi';
            $data['acao'] = 'Criação de Repositoŕio';
            LogMessage::create_log($data);
        }

        return $value;
    }


    public static function excluir($codrepositorio)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $doc = Repositorio::findOrFail($codrepositorio);
            if(!$doc->UsuarioTemPermissao(Auth::getUser())){
                exit(403);
            }
            $value = $doc->delete();
            limpar_cache_geral();
            DB::commit();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Exclusão de repositório';
            $data['acao'] = 'Exclusão de repositório';
            return LogMessage::create_log($data);
        }

    }

    public static function excluir_todos()
    {
        try {
            DB::beginTransaction();
            $repositorios = Repositorio::all();
            foreach ($repositorios as $repositorio) {
                $repositorio->delete();
            }
            limpar_cache_geral();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Excluir todos repositórios';
            $data['acao'] = 'Excluir todos os repositórios';
            LogMessage::create_log($data);
        }

    }

    public static function repositorio_existe($nome_do_repositorio)
    {
        $repositorios = self::listar();
        return $repositorios->where('nome', $nome_do_repositorio)->count() > 0;
    }
    public static function repositorio_existeUsuario($nome_do_repositorio)
    {
        $repositorios = Repositorio::all();
        return $repositorios->where('nome', $nome_do_repositorio)->count() > 0;
    }

    public static function listar_repositorios(){
        return Cache::remember('listar_codigos_repositorios'.Auth::getUser()->codusuario, 2000, function (){
            return collect(DB::table('repositorios')
                ->get());
        });
    }

    public static function usuarios_repositorios(){
        return Cache::remember('usuarios_repositorios'.Auth::getUser()->codusuario, 2000, function () {
            if(Auth::user()->usuario_esta_no_repositorio()){
                return Auth::user()->repositorio->usuarios_repositorios;
            }else if(Auth::getuser()->EAdministrador()){
                return UsuarioRepositorio::all();
            }
            return null;
        });
    }

    public static function transferir($repositorioOrigem, $repositorioDestino){
        try {
            DB::beginTransaction();
            foreach ($repositorioOrigem->projetos as $projeto){
                ProjetoRepository::transferir($projeto,$repositorioDestino);
            }
            limpar_cache_geral();
            DB::commit();
            return flash('Operação feita com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Excluir todos repositórios';
            $data['acao'] = 'Excluir todos os repositórios';
            return LogMessage::create_log($data);
        }

    }
}
