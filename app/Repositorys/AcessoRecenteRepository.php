<?php


namespace App\Http\Repositorys;

use App\Http\Models\AcessoRecente;
use App\Http\Models\Modelo;
use App\Http\Models\Repositorio;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AcessoRecenteRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(AcessoRecente::class);
    }

    public static function ExisteDiagrama($modelo, $operacao)
    {
        return AcessoRecente::all()
                ->where('codmodelodiagramatico', '=', $modelo->codmodelodiagramatico)
                ->where('operacao', '=', $operacao)
                ->count() > 0;
    }
    public static function ExisteConfiguracao($configuracao, $operacao)
    {
        return AcessoRecente::all()
                ->where('codconfiguracaoambientemodelagem', '=', $configuracao->codconfiguracaoambientemodelagem)
                ->where('operacao', '=', $operacao)
                ->count() > 0;
    }
    public static function ExisteProjeto($projeto, $operacao){
        return AcessoRecente::all()
                ->where('codprojeto','=',$projeto->codprojeto)
                ->where('operacao','=',$operacao)
                ->count()>0;
    }

    public static function ExisteRepositorio($repositorio, $operacao){
        return AcessoRecente::all()
                ->where('codrepositorio','=',$repositorio->codrepositorio)
                ->where('operacao','=',$operacao)
                ->count()>0;
    }
    public static function CriaAcessoRecenteConfiguracaoAmbienteModelagem($configuracao, $operacao, $descricao)
    {

        try {

            $recente = [

                'codmodelo' => $configuracao->codmodelo,
                'codmensagem' => null,
                'coddocumentacao' => null,
                'codusuario' => Auth::getUser()->codusuario,
                'codmodelodiagramatico' => $configuracao->codmodelodiagramatico,
                'codprojeto' => $configuracao->codprojeto,
                'codrepositorio' => $configuracao->codrepositorio,
                'descricao' => $descricao,
                'operacao' => $operacao,
                'codconfiguracaoambientemodelagem' => $configuracao->codconfiguracaoambientemodelagem
            ];
            if (!self::ExisteConfiguracao($configuracao, $operacao)){
                DB::beginTransaction();
                AcessoRecente::create($recente);
                DB::commit();
            }


        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'CriaAcessoRecente';
            LogMessage::create_log($data);
        }

    }

    public static function CriaAcessoRecenteDiagrama($modelo, $operacao, $descricao)
    {

        try {

            $recente = [

                'codmodelo' => $modelo->codmodelo,
                'codmensagem' => null,
                'coddocumentacao' => null,
                'codusuario' => Auth::getUser()->codusuario,
                'codmodelodiagramatico' => $modelo->codmodelodiagramatico,
                'codprojeto' => $modelo->codprojeto,
                'codrepositorio' => $modelo->codrepositorio,
                'descricao' => $descricao,
                'operacao' => $operacao
            ];
            if (!self::ExisteDiagrama($modelo, $operacao)){
                DB::beginTransaction();
                AcessoRecente::create($recente);
                DB::commit();
            }


        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'CriaAcessoRecente';
            LogMessage::create_log($data);
        }

    }


    public static function CriaAcessoRecenteRepositorio($repositorio, $operacao)
    {
        try {
            DB::beginTransaction();
            $recente = [

                'codmodelo' => null,
                'codmensagem' => null,
                'codusuario' => Auth::getUser()->codusuario,
                'coddocumentacao' => null,
                'codmodelodiagramatico' => null,
                'codprojeto' => null,
                'codrepositorio' => $repositorio->codrepositorio,
                'descricao' => 'Acesso ao Repositório ' . $repositorio->nome,
                'operacao' => $operacao
            ];
        if (!self::ExisteRepositorio($repositorio,$operacao))
                AcessoRecente::create($recente);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }

    }

    public static function CriaAcessoRecenteProjeto($projeto, $operacao)
    {

        try {
            $recente = [

                'codmodelo' => null,
                'codmensagem' => null,
                'coddocumentacao' => null,
                'codusuario' => Auth::getUser()->codusuario,
                'codmodelodiagramatico' => null,
                'codprojeto' => $projeto->codprojeto,
                'codrepositorio' => $projeto->codrepositorio,
                'descricao' => $projeto->nome,
                'operacao' => $operacao
            ];
            if (!self::ExisteProjeto($projeto, $operacao))
                AcessoRecente::create($recente);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaRepresentacaoDiagramatica';
            $data['acao'] = 'CriaAcessoRecente';
            LogMessage::create_log($data);
        }

    }
}
