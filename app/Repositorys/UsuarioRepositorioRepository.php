<?php


namespace App\Http\Repositorys;


use App\Http\Models\UsuarioRepositorio;
use App\Http\Util\LogMessage;
use Illuminate\Support\Facades\Auth;

class UsuarioRepositorioRepository
{
    public static function excluir($codrepositorio = null)
    {
        try {
            $resultado = UsuarioRepositorio::all()
                ->where('codrepositorio','=',$codrepositorio)
                ->where('codusuario','=',Auth::user()->codusuario);
            $resultado = $resultado->first();

            if (isset($resultado)){
                $resultado->delete();
                return flash('Registro excluido com sucesso!');
            }
            return flash('Registro não foi excluido com sucesso!');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'PainelPrincipalViwer';
            $data['acao'] = 'desvincular_usuario_repositorio';
            return LogMessage::create_log($data);
        }
    }
}
