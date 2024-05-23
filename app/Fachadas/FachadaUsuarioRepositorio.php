<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:57
 */

namespace App\Http\Fachadas;


use App\http\Models\Repositorio;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Repositorys\UsuarioRepositorioRepository;
use App\Http\Repositorys\VinculoUsuarioRepositorioRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaUsuarioRepositorio extends FachadaConcreta
{


    public function index($request = null, $request2 = null)
    {
        if (!empty(Auth::user()->papel())) {
            $repositorios = collect(Auth::user()->repositorio);
        } else if (Auth::user()->papel() === 'ADMINISTRADOR') {
            $repositorios = RepositorioRepository::listar();
        }

        $usuarios = UserRepository::listar_usuarios();
        $titulos = User::titulos();
        $tipo = 'usuario';
        return view('vinculo_usuario_repositorio.vinculo_usuario_repositorio', compact('repositorios', 'usuarios', 'titulos', 'tipo'));
    }

    public function store(Request $request = null)
    {

        $codusuario = $request->codusuario;
        $codrepositorio = $request->codrepositorio;
        $tipo = $request->tipo;
        $resultado = VinculoUsuarioRepositorioRepository::vincularUsuarioRepositorio($codusuario, $codrepositorio, $tipo);
        return \Response::json($resultado);
    }

    public function destroy($codrepositorio = null)
    {
        $resultado = UsuarioRepositorioRepository::excluir($codrepositorio);
        return \Response::json($resultado);
    }


}
