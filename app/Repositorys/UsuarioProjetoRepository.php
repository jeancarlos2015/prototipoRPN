<?php


namespace App\Http\Repositorys;


use App\Http\Models\UsuarioProjeto;
use App\Http\Util\LogMessage;

class UsuarioProjetoRepository
{
    public static function excluir($codusuarioprojeto = null)
    {
        $codprojeto = null;
        try {
            $usuario_projeto = UsuarioProjeto::findOrFail($codusuarioprojeto);
            $usuario_projeto->delete();
            limpar_cache();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Modal de listagem de usuários';
            $data['acao'] = 'desvincular_usuario_projeto';
            return LogMessage::create_log($data);
        }
    }
}
