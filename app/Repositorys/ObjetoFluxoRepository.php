<?php

namespace App\Http\Repositorys;


use App\Http\Models\ObjetoFluxo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ObjetoFluxoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(ObjetoFluxo::class);
    }


    public static function listar()
    {
        return Cache::remember('listar_objetos'.Auth::getUser()->codusuario, 2000, function () {
            return collect(ObjetoFluxo::get());
        });
    }

    public static function listar_por_modelo_declarativo($codmodelodeclarativo)
    {
        return Cache::remember('listar_por_modelo_declarativo'.Auth::getUser()->codusuario, 2000, function () use ($codmodelodeclarativo) {

            return collect(ObjetoFluxo::where('codmodelodeclarativo', '=', $codmodelodeclarativo)
                ->get());
        });
    }

    public static function listar_modelo_por_projeto_organizacao($codrepositorio, $codprojeto, $codusuario)
    {
        return Cache::remember('listar_modelo_por_projeto_organizacao'.Auth::getUser()->codusuario, 2000, function () use ($codrepositorio, $codprojeto) {
            return collect(ObjetoFluxo::whereCodrepositorio($codrepositorio)
                ->where('codprojeto', '=', $codprojeto)
                ->Where('publico', '=', true)
                ->get());
        });
    }


    public static function atualizar(Request $request, $codobjetofluxo)
    {

        $objeto_fluxo = ObjetoFluxo::findOrFail($codobjetofluxo);
        if(!$objeto_fluxo->modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        $data = [
            'codrepositorio' => $objeto_fluxo->codrepositorio,
            'codusuario' => $objeto_fluxo->codusuario,
            'codprojeto' => $objeto_fluxo->codprojeto,
            'codmodelodeclarativo' => $objeto_fluxo->codmodelodeclarativo,
            'codmodelo' => $objeto_fluxo->codmodelo,
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'publico' => $request->publico
        ];
        $objeto_fluxo->update($data);
        self::limpar_cache();
        return $objeto_fluxo;
    }


    public static function incluir(Request $request)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = ObjetoFluxo::create($request->all());
            self::limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }

        return $value;
    }
    public static function incluir_objeto_fluxo($dado)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = ObjetoFluxo::create($dado);
            self::limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }

        return $value;
    }
    public static function incluir_se_existe($dado)
    {
        if (!self::existe($dado['nome'])) {

            try {
                DB::beginTransaction();
                $value =  ObjetoFluxo::create($dado);
                self::limpar_cache();
                DB::commit();
                return $value;
            } catch (\Exception $ex) {
                DB::rollBack();
            }

        }
        return null;
    }

    public static function excluir($codobjetofluxo)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $doc = ObjetoFluxo::findOrFail($codobjetofluxo);
            $value = $doc->delete();
            self::limpar_cache();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_objetos'.Auth::getUser()->codusuario);
        Cache::forget('listar_por_modelo_declarativo'.Auth::getUser()->codusuario);
        Cache::forget('listar_modelo_por_projeto_organizacao'.Auth::getUser()->codusuario);
        Cache::forget('listar_objetos_modelo'.Auth::getUser()->codusuario);
    }

    public static function existe($nome_do_objeto)
    {

        $objetos = self::listar();
        return $objetos->where('nome', $nome_do_objeto)->count() > 0;

    }

    public static function listar_objetos_fluxo($codmodelodeclarativo)
    {
        return Cache::remember('listar_objetos_modelo'.Auth::getUser()->codusuario, 2000, function () use ($codmodelodeclarativo) {
            return ObjetoFluxo::where('codmodelodeclarativo', '=', $codmodelodeclarativo)
                ->get();
        });
    }


}
