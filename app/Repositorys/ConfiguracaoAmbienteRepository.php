<?php


namespace App\Http\Repositorys;


use App\Http\Models\ConfiguracaoAmbienteModelagem;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConfiguracaoAmbienteRepository
{
    public static function update(Request $request, $codigo)
    {
        $configuracao = null;
        try {
            DB::beginTransaction();
            $configuracao = ConfiguracaoAmbienteModelagem::FindOrFail($codigo);
            $configuracao->update($request->all());
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'configuracao_menu_ambiente_modelagem';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }
        return $configuracao;
    }

    public static function criarConfiguracao($diagrama)
    {
        try {
            DB::beginTransaction();
            $configuracao = [
                'codusuario' => $diagrama->codusuario,
                'codmodelo' => $diagrama->codmodelo,
                'codmodelodiagramatico' => $diagrama->codmodelodiagramatico,
                'codprojeto' => $diagrama->codprojeto,
                'codrepositorio' => $diagrama->codrepositorio,
                'exibirdescricaodiagrama' => 1,
                'exibiradicaousuariosdiagrama' => 1,
                'exibiralteracoes' => 1,
                'exibiriconepainel' => 1,
                'exibireditarmodelouploaddiagrama' => 1,
                'exibiracessoeditardiagrama' => 1,
                'exibiracessodocumentacaotextual' => 1,
                'exibiracessosrecentes' => 1,
                'exibiracessousuarios' => 1,
                'exibiracessoadicaovalidador' => 1,
                'exibiracessovalidardiagrama' => 1,
                'exibiracessoenviarmensagem' => 1,
                'exibiracessodonwloaddiagrama' => 1,
                'exibiracessoinformacoesdiagrama' => 1,
                'exibiracessorepositorios' => 1
            ];
            ConfiguracaoAmbienteModelagem::create($configuracao);
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'configuracao_menu_ambiente_modelagem';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }
    }
    public static function criarConfiguracaoLimitada($diagrama)
    {
        try {
            DB::beginTransaction();
            $configuracao = [
                'codusuario' => Auth::getUser()->codusuario,
                'codmodelo' => $diagrama->codmodelo,
                'codmodelodiagramatico' => $diagrama->codmodelodiagramatico,
                'codprojeto' => $diagrama->codprojeto,
                'codrepositorio' => $diagrama->codrepositorio,
                'exibirdescricaodiagrama' => 1,
                'exibiracessodocumentacaotextual' => 1,
                'exibiracessosrecentes'=> 1,
                'exibiracessodonwloaddiagrama' => 1,
                'exibiracessoinformacoesdiagrama' => 1,
                'exibiracessorepositorios' => 1
            ];
            ConfiguracaoAmbienteModelagem::create($configuracao);
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'configuracao_menu_ambiente_modelagem';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }
    }
}
