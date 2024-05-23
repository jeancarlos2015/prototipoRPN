<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/09/2018
 * Time: 22:33
 */

namespace App\Http\Repositorys;


use App\Http\Models\ModelModelo;
use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\IFTTTHandler;

class ModeloRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(Modelo::class);
    }

    public static function modelo_existe($nome_do_modelo, $codprojeto)
    {
        $modelos = self::listar()->where(['codprojeto', $codprojeto], ['nome', $nome_do_modelo]);
        return $modelos->count() > 0;
    }

    public static function find($nome_do_modelo, $codprojeto)
    {
        $modelos = self::listar()->where(['codprojeto', $codprojeto], ['nome', $nome_do_modelo]);
        return $modelos->first();
    }

    public static function listar()
    {
        return Cache::remember('listar_modelos' . Auth::getUser()->codusuario, 2000, function () {
            return collect(Modelo::get());
        });
    }


    public static function listar_modelo_por_projeto_organizacao()
    {
        return Cache::remember('listar_modelo_por_projeto_organizacao' . Auth::getUser()->codusuario, 2000, function () {
            return collect(Modelo::get());
        });
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_modelos_declarativos' . Auth::getUser()->codusuario);
        Cache::forget('listar_modelos_publicos' . Auth::getUser()->codusuario);
        Cache::forget('listar_modelos' . Auth::getUser()->codusuario);
        Cache::forget('listar_modelo_por_projeto_organizacao' . Auth::getUser()->codusuario);
    }
    public static function atualizarAjax(Request $request, $codmodelo)
    {

        try {
            DB::beginTransaction();
            $value = Modelo::findOrFail($codmodelo)->update($request->all());
            limpar_cache();
            DB::commit();

            return flash('Operação feita com sucesso!')->success();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'update(Request $request, $codigo)';
            return LogMessage::create_log($data);
        }
    }
    public static function atualizar(Request $request, $codmodelo)
    {

        try {
            DB::beginTransaction();
            $value = Modelo::findOrFail($codmodelo)->update($request->all());
            limpar_cache();
            DB::commit();

            return $value;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }
        return false;
    }

    public static function atualizarDescricao(Request $request, $codmodelo)
    {
        $modelo = Modelo::findOrFail($codmodelo);
        try {
            DB::beginTransaction();

            if (!empty($request->descricao)) {
                $modelo->descricao = $request->descricao;
            }
            if (!$modelo->repositorio->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
            $modelo->update();
            limpar_cache();
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }

        return $modelo;
    }

    public static function incluir($dado = [])
    {
        $modelo = null;
        $result = new ModelModelo();
        $projeto = Projeto::findOrFail($dado['codprojeto']);
        if (!$projeto->repositorio->UsuarioTemPermissao(Auth::getUser())) {
            exit(403);
        }
        try {
            DB::beginTransaction();
            $dado['codusuario'] = Auth::user()->codusuario;
            $dado['codrepositorio'] = $projeto->codrepositorio;
            if (empty($dado['descricao']))
                $dado['descricao'] = "";
            if(!empty($dado['codmodelo'])){
                $modelo = Modelo::FindOrFail($dado['codmodelo']);
            }else if (!ModeloRepository::modelo_existe($dado['nome'], $dado['codprojeto'])) {
                $modelo = Modelo::create($dado);
                UserRepository::vincular_usuario_modelo(Auth::user()->codusuario, $modelo->codmodelo, 'PROPRIETARIO');
            } else {
                $modelo = ModeloRepository::find($dado['nome'], $dado['codprojeto']);
            }

            $result->setModelo($modelo);
            $result->setDados($dado);
            $result->setProjeto($modelo->projeto);
            $result->incluiu = true;
            limpar_cache_geral();
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'store(Request $request)';
            LogMessage::create_log($data);
        }

        return $result;
    }


    public static function excluir($codmodelo)
    {
        $value = null;
        $modelo = Modelo::FindOrFail($codmodelo);

        if (!$modelo->UsuarioTemPermissao(Auth::getUser())) {
            exit(403);
        }

        if (!$modelo->PodeExcluir(Auth::getUser())) {
            exit(403);
        }
        try {
            DB::beginTransaction();
            $value = Modelo::findOrFail($codmodelo)->delete();
            limpar_cache_geral();
            DB::commit();
            return flash('Registro excluido com sucesso!');;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'listagem de modelos do projeto';
            $data['acao'] = 'destroy';
            return LogMessage::create_log($data);
        }
    }

    public static function listar_modelos_publicos()
    {
        return Cache::remember('listar_modelos_publicos' . Auth::getUser()->codusuario, 2000, function () {
            $modelos = Modelo::where('publico', '=', 'true')->get();
            $representacoes_publicas = collect([]);
            foreach ($modelos as $modelo) {
                if (collect($modelo->representacoes_diagramaticas)->count() > 0) {
                    $representacoes_publicas = $representacoes_publicas
                        ->concat($modelo->representacoes_diagramaticas);
                }
            }
            return $representacoes_publicas;
        });
    }

    public static function existe($nome_do_modelo)
    {
        return self::listar()->where('nome', $nome_do_modelo)->count() > 0;
    }

    public static function listar_modelos()
    {
        return Cache::remember('listar_modelos' . Auth::getUser()->codusuario, 2000, function () {
            return Modelo::get();
        });
    }

    public static function transferir($modelo, $projeto){
        try {
            DB::beginTransaction();
            $modelo->codrepositorio = $projeto->codrepositorio;
            $modelo->codprojeto = $projeto->codprojeto;
            $modelo->update();
            foreach ($modelo->diagramas as $diagrama){
                RepresentacaoDiagramaticaRepository::transferir($diagrama,$modelo);
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
