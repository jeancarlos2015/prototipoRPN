<?php


namespace App\Http\Repositorys;


use App\http\Models\Repositorio;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VinculoUsuarioRepositorioRepository
{
    public static function excluir($codusuariorepositorio = null)
    {

        try {
            DB::beginTransaction();
            $resultado = UsuarioRepositorio::destroy($codusuariorepositorio);
            limpar_cache_geral();
            DB::commit();
            if ($resultado){
                return flash('Registro excluido com sucesso!');
            }
            return flash('Registro excluido com sucesso!');

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'desvincular_usuario_repositorio';
           return LogMessage::create_log($data);
        }



    }

    public static function acessarUsuarioRepositorio($codrepositorio){
        try {
            DB::beginTransaction();
            $user = User::findOrFail(Auth::user()->codusuario);
            $user->codrepositorio = $codrepositorio;
            $resultado= $user->update();
            DB::commit();
            limpar_cache_geral();
            if($resultado){
                return flash('Operação feita com sucesso!')->success();
            }
            return flash('Operação não concluida!')->warning();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            return LogMessage::create_log($data);
        }
    }

    public static function vincularUsuarioRepositorio($codusuario,$codrepositorio,$tipo){

        try {
            if (!UserRepository::existe_usuario_repositorio($codusuario, $codrepositorio)) {
                UserRepository::vincular_usuario_repositorio($codusuario, $codrepositorio, $tipo);
                return flash('Operação feita com sucesso!')->success();
//                \Mail::to($usuario_repositorio->usuariio->email)->send(new EmailVinculacaoUsuario($repositorio));
            } else {
                return flash('Já existe um usuário com este nome neste repositório')->warning();
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'vincular_usuario_repositorio';
            return LogMessage::create_log($data);
        }
    }
}
