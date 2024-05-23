<?php

namespace App\Http\Repositorys;


use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Util\LogMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProjetoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Projeto::class);
    }

    public static function listar()
    {

        return Cache::remember('listar_todos_projetos'.Auth::getUser()->codusuario, 2000, function () {
                return collect(Projeto::all());
        });
    }

    public static function listar_por_repositorio($codrepositorio)
    {
        return Cache::remember('listar_projetos'.Auth::getUser()->codusuario, 2000, function () use ($codrepositorio) {
            return collect(Projeto::where('codrepositorio', $codrepositorio)
                ->get());
        });
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codprojeto)
    {

        $value = null;
        try {
            DB::beginTransaction();

            $value = Projeto::findOrFail($codprojeto);
            if(!$value->UsuarioTemPermissao(Auth::getUser())){
                exit(403);
            }
            $value->update($request->all());
            self::limpar_cache();
            DB::commit();

        } catch (Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Documentação Textual';
            $data['acao'] = 'atualizar_documentacao';
            LogMessage::create_log($data);
        }
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_projetos'.Auth::getUser()->codusuario);
        Cache::forget('listar_todos_projetos'.Auth::getUser()->codusuario);
        Cache::forget('listar_todos_projetos1'.Auth::getUser()->codusuario);
    }
    private static function Existe($nomeprojeto, $codrepositorio){
        return Projeto::all()
            ->where('codrepositorio',$codrepositorio)
            ->where('nome',$nomeprojeto)
            ->count()>0;
    }
    private static function Buscar($nomeprojeto, $codrepositorio){
        return Projeto::all()
                ->where('codrepositorio',$codrepositorio)
                ->where('nome',$nomeprojeto)
                ->first();
    }
    public static function  criarProjeto($nome,$publico){
        $value = null;
        try {
            DB::beginTransaction();
          $value =   Projeto::create([
                'codrepositorio' => Auth::getUser()->repositorio->codrepositorio,
                'codusuario' => Auth::getUser()->codusuario,
                'nome' => $nome,
                'publico' => $publico
            ]);
            DB::commit();


            return $value;
        }catch (\Exception $ex ){
            $value = $ex->getMessage();
            DB::rollBack();
        }
        return $value;
    }
    public static function incluir(Request $request)
    {
        $value = null;
        try {
            DB::beginTransaction();
            if (!self::Existe($request->nome,$request->codrepositorio)){
                $request->request->add(['descricao' => $request->texto]);
                $value = Projeto::create($request->all());
                $repositorio = new UserRepository();
                $repositorio->vincular_usuario_projeto(Auth::user()->codusuario, $value->codprojeto, 'PROPRIETARIO');
            }else{
                $value = self::Buscar($request->nome,$request->codrepositorio);
            }

            limpar_cache();
            DB::commit();

        } catch (\Exception $ex) {

            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Documentação Textual';
            $data['acao'] = 'atualizar_documentacao';
            LogMessage::create_log($data);
        }

        return $value;
    }

    public static function excluir1($codprojeto)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $doc = Projeto::findOrFail($codprojeto);
            $value = $doc->delete();
            limpar_cache();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Documentação Textual';
            $data['acao'] = 'atualizar_documentacao';
            LogMessage::create_log($data);
        }
        return $value;
    }

    public static function excluir($codprojeto)
    {
        $value = null;
        try {
            DB::beginTransaction();

            $projeto = Projeto::findOrFail($codprojeto);
            $projeto->delete();
            limpar_cache();
            DB::commit();
            return flash('Registro excluido com sucesso!');
        } catch (Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Documentação Textual';
            $data['acao'] = 'atualizar_documentacao';
            return LogMessage::create_log($data);
        }
    }

    public static function projeto_existe($request)
    {
        $projetos = self::listar_por_repositorio($request['codrepositorio']);
        return $projetos->where('nome', $request['nome'])->count() > 0;
    }

    public static function listar_projetos()
    {
        return Cache::remember('listar_todos_projetos1'.Auth::getUser()->codusuario, 2000, function () {
            return Projeto::get();
        });
    }

    public static function transferir($projeto, $repositorio){
        try {
            DB::beginTransaction();
            $projeto->codrepositorio = $repositorio->codrepositorio;
            $projeto->update();
            foreach ($projeto->modelos as $modelo){
                ModeloRepository::transferir($modelo,$projeto);
            }
            limpar_cache_geral();
            DB::commit();
            return flash('Operação feita com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            return LogMessage::create_log($data);
        }
    }
}
