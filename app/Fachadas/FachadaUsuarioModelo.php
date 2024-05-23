<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 22/09/2018
 * Time: 16:07
 */

namespace App\Http\Fachadas;


use App\Http\Models\UsuarioModelo;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Repositorys\UsuarioModeloRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaUsuarioModelo extends FachadaConcreta
{

    public function index($request = null, $request2 = null)
    {
        if (Auth::user()->papel() === 'ADMINISTRADOR') {
            $modelos = ModeloRepository::listar();
        } else if (!empty(Auth::user()->papel())) {
            $modelos = UserRepository::auth_user_repositorio_modelos();
        }
        $usuarios = UserRepository::listar_usuarios();
        $titulos = User::titulos();
        $tipo = 'usuario';
        return view('vinculo_usuario_repositorio.vinculo_usuario_repositorio', compact('modelos', 'usuarios', 'titulos', 'tipo'));
    }

    public function store(Request $request = null)
    {
        $codusuario = $request->codusuario;
        $codmodelo = $request->codmodelo;
        $tipo = $request->tipo;
        $resultado = UsuarioModeloRepository::vincuarUsuarioModeo($codusuario, $codmodelo, $tipo);
        return \Response::json($resultado);
    }

    public function destroy($codusuariomodelo = null)
    {
        $resultado = UsuarioModeloRepository::excluir($codusuariomodelo);
        return \Response::json($resultado);
    }
}
