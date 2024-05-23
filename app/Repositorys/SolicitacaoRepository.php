<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 20/10/2018
 * Time: 14:19
 */

namespace App\Http\Repositorys;


use App\Http\Models\Log;
use App\Http\Models\Mensagem;
use App\http\Models\Repositorio;
use App\Http\Models\Solicitacao;
use App\Http\Util\LogMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SolicitacaoRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(Solicitacao::class);
    }

    public static function solicitarParticipacao($codrepositorio, $mensagem)
    {
        $repositorio = Repositorio::findOrFail($codrepositorio);
        $proprietarios = $repositorio->proprietarios();
        self::SolicitarAuxiliar($proprietarios, $repositorio, $mensagem);
        $administradores = Auth::getUser()->Administradores();
        self::SolicitarAuxiliar($administradores, $repositorio, $mensagem);
    }

    public static function listar()
    {
        return Cache::remember('listar_solicitacoes' . Auth::getUser()->codusuario, 2000, function () {
            return Solicitacao::all();
        });
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_solicitacoes' . Auth::getUser()->codusuario);
        Cache::forget('solicitacoes' . Auth::getUser()->codusuario);
    }

    public static function excluir($codigo)
    {
        try {
            DB::beginTransaction();
            $value = Solicitacao::findOrFail($codigo)->delete();
            limpar_cache_geral();
            DB::commit();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'cancelar_solicitacao_usuario';
            return LogMessage::create_log($data);
        }
    }

    public static function solicitacoes()
    {
        if (Auth::getuser()->EAdministrador()) {
            return Solicitacao::all();
        }
        return Auth::user()->solicitacoes;
    }

    public static function Existe($dado = [])
    {
        $solicitacoes = Solicitacao::all()
            ->where('codrepositorio', '=', $dado['codrepositorio'])
            ->where('codusuario_solicitado', '=', $dado['codusuario_solicitado'])
            ->where('codusuario_solicitante', '=', $dado['codusuario_solicitante']);
        return (count($solicitacoes) > 0);
    }

    public static function incluir($dado = [])
    {
        try {
            $result = null;
            DB::beginTransaction();
            if (!self::Existe($dado)) {
                $result = Solicitacao::create($dado);
            }
            DB::commit();
            limpar_cache_geral();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }
    }

    public static function Solicitar($codrepositorio, $mensagem)
    {
        $repositorio = Repositorio::findOrFail($codrepositorio);
        $proprietarios = $repositorio->proprietarios();
        SolicitacaoRepository::SolicitarAuxiliar($proprietarios, $repositorio, $mensagem);
        $administradores = Auth::getUser()->Administradores();
        $result = SolicitacaoRepository::SolicitarAuxiliar($administradores, $repositorio, $mensagem);
        return $result;
    }

    public static function SolicitarAuxiliar($usuarios, $repositorio, $mensagem)
    {

        foreach ($usuarios as $usuario) {
            $dado = [
                'codusuario_solicitado' => $usuario->codusuario,
                'codusuario_solicitante' => Auth::user()->codusuario,
                'codrepositorio' => $repositorio->codrepositorio,
                'mensagem' => $mensagem
            ];
            $resultado = self::incluir($dado);
            if ($resultado != null)
                Log::create([
                    'nome' => '',
                    'descricao' => 'O usuário ' . Auth::getUser()->name . ' deseja entrar no repositório ' . $repositorio->nome,
                    'codusuario' => $usuario->codusuario,
                    'acao' => 'Solicitação',
                    'pagina' => 'Painel Principal',
                    'visto' => false,
                ]);

        }
        return flash('Operação feita com sucesso!');
    }
}
