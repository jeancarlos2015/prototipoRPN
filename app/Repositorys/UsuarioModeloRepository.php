<?php


namespace App\Http\Repositorys;


use App\Http\Models\UsuarioModelo;
use App\Http\Util\LogMessage;

class UsuarioModeloRepository
{
    public static function excluir($codusuariomodelo)
    {
        $codmodelo = null;
        try {
            $usuario_modelo = UsuarioModelo::findOrFail($codusuariomodelo);
            $usuario_modelo->delete();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Modal de listagem de usuários';
            $data['acao'] = 'desvincular_usuario_modelo';
            return LogMessage::create_log($data);
        }
    }

    public static function vincuarUsuarioModeo($codusuario, $codmodelo, $tipo)
    {
        try {
            if (!UserRepository::existe_usuario_modelo($codusuario, $codmodelo)) {

                UserRepository::vincular_usuario_modelo($codusuario, $codmodelo, $tipo);
                return flash('Operação feita com sucesso!')->success();

            } else {
                $result = UserRepository::atualizar_usuario_modelo($codusuario, $codmodelo, $tipo);
                if ($result) {
                    return flash('Já existe um usuário com este nome neste modelo')->success();
                }
                return flash('Houve algum falha na operação')->warning();
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Modal de atribuição de usuários ao modelo';
            $data['acao'] = 'vincular_usuario_modelo';
            return LogMessage::create_log($data);
        }

    }
}
