<?php

namespace App\Http\Repositorys;


use App\http\Models\Regra;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RegraRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Regra::class);
    }

    public static function listar()
    {
        return Cache::remember('listar_regras'.Auth::getUser()->codusuario, 2000, function () {
            if (Auth::user()->papel()=== 'ADMINISTRADOR') {
                return collect(Regra::get());
            } else {
                return collect(Regra::
                Where('codusuario', '=', Auth::user()->codusuario)
                    ->get());
            }
        });
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_regras'.Auth::getUser()->codusuario);
    }
    public static function inclui_se_existe($dados)
    {
        if (!self::existe($dados)) {
            self::limpar_cache();
            return Regra::create($dados);
        }
        return null;
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codregra)
    {
        $regra = null;
        try {
            DB::beginTransaction();
            $regra = Regra::findOrFail($codregra);
            $regra->nome = $request->nome;
            $regra->update();
            self::limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'destroy($codprojeto = null)';
            LogMessage::create_log($data);
        }

        return $regra;
    }
    public static function incluir(Request $request)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = Regra::create($request->all());
            self::limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'destroy($codprojeto = null)';
            LogMessage::create_log($data);
        }
        return $value;

    }


    public static function excluir($codRegra)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $doc = Regra::findOrFail($codRegra);
            $value = $doc->delete();
            self::limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'destroy($codprojeto = null)';
            LogMessage::create_log($data);
        }

        return $value;
    }

    public static function excluir_todos()
    {
        try {
            DB::beginTransaction();
            $Regras = Regra::all();
            foreach ($Regras as $Regra) {
                $Regra->delete();
            }
            self::limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaProjeto';
            $data['acao'] = 'destroy($codprojeto = null)';
            LogMessage::create_log($data);
        }

    }

    public static function existe($dados)
    {

        return  collect(Regra::where('nome','=',$dados['nome'])
                ->get())
                ->count() > 0;
    }
}
