<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:36
 */

namespace App\Http\Fachadas;


use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\UserRepository;
use App\User;
use Illuminate\Http\Request;

class FachadaUsuariosOnline extends FachadaConcreta
{


    public function index($request = null, $request2 = null)
    {

        try {

            $usuarios = UserRepository::listar_usuarios_online();
            $tipo = 'usuario';
            $titulos = User::titulos();
            $tipos = UsuarioRepositorio::TIPOS;
            return view('controle_usuario.index', compact('usuarios', 'tipo', 'titulos', 'tipos'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


}
