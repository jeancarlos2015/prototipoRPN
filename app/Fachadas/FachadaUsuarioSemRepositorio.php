<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:53
 */

namespace App\Http\Fachadas;


use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Repositorys\UsuarioSemRepositorioRepository;
use App\Mail\EmailVinculacaoUsuario;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaUsuarioSemRepositorio extends FachadaConcreta
{

//desvincular_usuario_repositorio
    public function destroy($dado = null)
    {
        $resultado = UsuarioSemRepositorioRepository::excluir($dado);
        return \Response::json($resultado);
    }


    public function index($request = null, $request2 = null)
    {
        try {
            $usuarios = UserRepository::usuarios_sem_vinculo();
            $tipo = 'usuario';
            $titulos = User::titulos();
            return view('controle_usuario.index', compact('usuarios', 'tipo', 'titulos'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function edit($codigo = null)
    {
        $usuario = User::findOrFail($codigo);
        if (Auth::user()->papel() === 'ADMINISTRADOR') {
            $repositorios = RepositorioRepository::listar();
        } else if (!empty(Auth::user()->papel())) {
            $repositorios = collect(Auth::user()->repositorio);
        }
        $tipos = UsuarioRepositorio::TIPOS;
        return view('controle_usuario.vinculo', compact('usuario', 'repositorios', 'tipos'));
    }


}
