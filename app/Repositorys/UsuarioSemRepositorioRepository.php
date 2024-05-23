<?php


namespace App\Http\Repositorys;


use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Support\Facades\DB;

class UsuarioSemRepositorioRepository
{
    public static function excluir($dado = null)
    {
        try {
            DB::beginTransaction();
            $desvincular = $dado['desvincular'];
            $codusuario = $dado['codusuario'];
            if ($desvincular === 'true') {
                $user = User::findOrFail($codusuario);
                $repositorio = $user->repositorio;
                $user->codrepositorio = null;
                $user->update();
                limpar_cache_geral();
                //\Mail::to($user->email)->send(new EmailVinculacaoUsuario($repositorio));
                return flash('Registro excluido com sucesso!');
            }

            DB::commit();
            return flash('Registro não foi excluido!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            return LogMessage::create_log($data);
        }

    }
}
