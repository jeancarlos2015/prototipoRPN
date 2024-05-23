<?php

namespace App\Http\Repositorys;


use App\Http\Models\Log;
use App\Http\Util\LogMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LogRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Log::class);
    }

    public static function criar($mensagem, $nome = null, $pagina = null, $acao = null)
    {
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i:s');
            $log = Log::create([
                'nome' => $nome === null ? 'Nao Especificado' : $nome,
                'descricao' => $mensagem,
                'codusuario' => Auth::user()->codusuario,
                'pagina' => $pagina === null ? 'Nao Especificado' : $pagina,
                'acao' => $acao === null ? 'Nao Especificado' : $acao,
                'created_at' => $date
            ]);
            self::limpar_cache();
            DB::commit();
            return $log->codlog;
        } catch (\Exception $ex) {
            DB::rollBack();
        }
        return null;
    }

    public static function criarLogsystem($mensagem, $nome, $pagina, $acao, $codusuario)
    {
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i:s');
            $log = Log::create([
                'nome' => $nome,
                'descricao' => $mensagem,
                'pagina' => $pagina,
                'acao' => $acao,
                'created_at' => $date
            ]);
            self::limpar_cache();
            DB::commit();
            return $log->codlog;
        } catch (\Exception $ex) {
            DB::rollBack();
        }
        return null;
    }

    public static function excluir($codigo)
    {
        try {
            DB::beginTransaction();
            $log = Log::findOrFail($codigo);
            $log->delete();
            self::limpar_cache();
            DB::commit();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaLog';
            $data['acao'] = 'destroy($codigo = null)';
            return LogMessage::create_log($data);
        }


    }

    public static function limpar_cache()
    {
        Cache::forget('listar_logs' . Auth::getUser()->codusuario);
        Cache::forget('listar_logs_nao_visto' . Auth::getUser()->codusuario);
        Cache::forget('listar_todos_logs' . Auth::getUser()->codusuario);
    }

    public static function listar()
    {
        return Cache::remember('listar_logs' . Auth::getUser()->codusuario, 2000, function () {
            if (Auth::user()->papel() == 'ADMINISTRADOR') {
                return collect(Log::all()->where('visto', '=', 'false'));
            } else {
                return collect(Log::all()
                    ->where('visto', '=', 'false')
                    ->where('codusuario', Auth::user()->codusuario));
            }
        });


    }

    public static function listar_todos()
    {

        return Cache::remember('listar_todos_logs' . Auth::getUser()->codusuario, 2000, function () {
            if (in_array(Auth::user()->papel(), ['ADMINISTRADOR', 'PROPRIETARIO'])) {
                return collect(Log::all()->sortByDesc('codlog')->take(100));
            } else {
                return collect(Log::all()
                    ->where('codusuario', Auth::user()->codusuario)
                    ->sortByDesc('codlog')
                    ->take(100)
                );
            }
        });
    }

    public static function listar_logs_nao_visto()
    {
        return Cache::remember('listar_logs_nao_visto' . Auth::getUser()->codusuario, 2000, function () {
            if (Auth::user()->papel() == 'ADMINISTRADOR') {
                return collect(Log::all()->where('visto', '=', false));
            } else {
                return collect(Log::all()
                    ->where('visto', '=', false)
                    ->where('codusuario', Auth::user()->codusuario));
            }
        });
    }

    public static function listar_tres_ultimos_logs($qt_logs)
    {
        $logs_buffer = self::listar()->sortByDesc('codlog');
        $logs = [];
        for ($indice = 0; $indice < $qt_logs; $indice++) {
            array_push($logs, $logs_buffer[$indice]);
        }
        return $logs;
    }

    public static function log()
    {
        return self::listar()->sortByDesc('codlog')->first();
    }
}
