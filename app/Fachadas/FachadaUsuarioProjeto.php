<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 22/09/2018
 * Time: 12:58
 */

namespace App\Http\Fachadas;


use App\Http\Models\UsuarioProjeto;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Repositorys\UsuarioProjetoRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaUsuarioProjeto extends FachadaConcreta
{
    public function index($request = null, $request2 = null)
    {
        if (!empty(Auth::user()->papel())) {
            $projetos = Auth::user()->repositorio->projetos;
        } else if (Auth::user()->papel() === 'ADMINISTRADOR') {
            $projetos = ProjetoRepository::listar();
        }
        $usuarios = UserRepository::listar_usuarios();
        $titulos = User::titulos();
        $tipo = 'usuario';
        return view('vinculo_usuario_repositorio.vinculo_usuario_repositorio', compact('projetos', 'usuarios', 'titulos', 'tipo'));
    }

    public function store(Request $request = null)
    {
        $codusuario = $request->codusuario;
        $codprojeto = $request->codprojeto;
        $tipo = $request->tipo;
        try {
            if (!UserRepository::existe_usuario_projeto($codusuario, $codprojeto)) {
                UserRepository::vincular_usuario_projeto($codusuario, $codprojeto, $tipo);
               return flash('Operação feita com sucesso!')->success();
//                \Mail::to($usuario_repositorio->usuariio->email)->send(new EmailVinculacaoUsuario($repositorio));
            } else {
               return flash('Já existe um usuário com este nome neste projeto')->warning();
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Modal de atribuição de usuários ao projeto';
            $data['acao'] = 'vincular_usuario_projeto';
           return LogMessage::create_log($data);
        }
    }

    public function destroy($codusuarioprojeto = null)
    {
        $resultado = UsuarioProjetoRepository::excluir($codusuarioprojeto);
        return \Response::json($resultado);
    }
}
