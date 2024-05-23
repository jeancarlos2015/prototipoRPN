<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/09/2018
 * Time: 21:44
 */

namespace App\Http\Repositorys;


use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RepresentacaoDeclarativaRepository
{
    public function __construct()
    {
        $this->setModel(RepresentacaoDeclarativa::class);
    }


    public static function listar()
    {
        return Cache::remember('listar_modelos_declarativos1' . Auth::getUser()->codusuario, 2000, function () {
            return collect(RepresentacaoDeclarativa::
            where('codusuario', '=', Auth::user()->codusuario)
                ->get());
        });
    }


    public static function listar_modelo_por_projeto_organizacao()
    {
        return Cache::remember('listar_modelos_declarativos' . Auth::getUser()->codusuario, 2000, function () {
            return collect(RepresentacaoDeclarativa::get());
        });
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_modelos_declarativos' . Auth::getUser()->codusuario);
        Cache::forget('listar_modelos_declarativos1' . Auth::getUser()->codusuario);
        Cache::forget('listar_modelos_declarativos2' . Auth::getUser()->codusuario);
        Cache::forget('listar_modelos_publicos' . Auth::getUser()->codusuario);
    }

    public static function atualizar(Request $request, $codmodelo)
    {
        $value = RepresentacaoDeclarativa::findOrFail($codmodelo)->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function incluir(Request $request)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = RepresentacaoDeclarativa::create($request->all());
            limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }

        return $value;
    }


    public static function excluir($codmodelo)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = RepresentacaoDeclarativa::findOrFail($codmodelo)->delete();
            DB::commit();
            self::limpar_cache();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDeclarativa';
            $data['acao'] = 'destroy($codigo = null)';
            return LogMessage::create_log($data);
        }
    }


    public static function existe($nome_do_modelo)
    {
        return self::listar()->where('nome', $nome_do_modelo)->count() > 0;
    }

    public static function listar_modelos()
    {
        return Cache::remember('listar_modelos_declarativos2' . Auth::getUser()->codusuario, 2000, function () {
            return RepresentacaoDeclarativa::get();
        });
    }

}
