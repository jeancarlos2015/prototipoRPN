<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:36
 */

namespace App\Http\Fachadas;


use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Mail\EmailCadastroDeUsuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FachadaUsuario extends FachadaConcreta
{


    public function index($request = null, $request2 = null)
    {
        try {
            if(!Auth::getUser()->EAdministrador()){
                abort('403');
            }
            $usuarios = UserRepository::listar_usuarios();
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

    public function UsuariosOnline()
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

    private function update_user(User $user, array $data)
    {
        try {
            DB::beginTransaction();
            $value = $user->update(
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'tipo' => $data['tipo'],
                    'password' => \Hash::make($data['password']),
                ]
            );
            DB::commit();
            return $value;
        } catch (\Exception $ex) {
            DB::rollBack();
        }

    }


    private function create_user(array $data)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'tipo' => $data['tipo'],
                'password' => \Hash::make($data['password']),
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }


        return $value;
    }

    public function create($codmodelo = null, $codmodelo1 = 0)
    {
        try {
            $dados = User::dados();
            return view('controle_usuario.create', compact('dados'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'create';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    protected function validator_user_register(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    protected function create_user_register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tipo' => 'Padrao',
            'status' => true,
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function salvar(Request $request)
    {
        try {
            if (!$this->validator($request->all())->fails()) {
                if (Auth::attempt($this->create($request->all()), true)) {
                    flash('Operação feita com sucesso!')->success();
                    return redirect()->back();
                }
            }
            $erros = $this->validator($request->all())->fails();
            return view('auth.register')
                ->withErrors($erros)
                ->withInput();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Register';
            $data['acao'] = 'salvar(Request $request)';
            $this->create_log($data);
        }

    }

    public function storeAuxiliar(Request $request)
    {

        try {

            if (Auth::getUser()->EAdministrador()) {
                $result = collect(UserRepository::listar())->where('email', '=', $request->email);
                if ($result->count() === 0) {
                    $this->create_user($request->all());
                    return flash('Operação feita com sucesso!')->success();
                } else {
                    return flash('Já existe um usuário com esses dados!')->warning();
                }
            }

            return flash('Não foi possivel criar este usuario!')->error();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'store(Request $request)';
            return $this->create_log($data);
        }

    }

    public function storeAjax(Request $request)
    {
        $resultado = $this->storeAuxiliar($request);
        return \Response::json($resultado);
    }

    public function store(Request $request)
    {
        try {

            if (Auth::getUser()->EAdministrador()) {
                $result = collect(UserRepository::listar())->where('email', '=', $request->email);
                if ($result->count() === 0) {
                    $this->create_user($request->all());
                    flash('Operação feita com sucesso!')->success();
                } else {
                    flash('Já existe um usuário com esses dados!')->warning();
                }
            }
            return redirect()->route('controle_usuarios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'store(Request $request)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function updateAuxiliar(Request $request, $id)
    {


        try {

            if (!Auth::user()->EAdministrador() && Auth::getUser()->codusuario!==$id) {
                abort('403');
            }

            if ($request->password !== $request->password_confirm) {
                return flash('Senha não confere')->warning();
            }
            $erros = \Validator::make($request->all(), User::validacao());
            if ($erros->fails()) {
                return flash('Não foi possivel alterar a senha, tente novamente.')->error();
            }
            $request->request->add(['codusuariopai' => Auth::user()->codusuario]);
            if (UserRepository::atualizar($request, $id)) {
                return flash('Operação feita com sucesso!')->success();
            }
            return flash('Não foi possivel alterar a senha!')->warning();

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'update';
            return $this->create_log($data);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->EAdministrador()) {
            $resultado = $this->updateAuxiliar($request, $id);
        } else if (Auth::getUser()->codusuario===$id) {
            $resultado = $this->updateAuxiliar($request, $id);
        }else{
            abort('403');
        }

        return \Response::json($resultado);
    }


    public function edit($codigo = null)
    {

        try {
            if (Auth::user()->EAdministrador()) {
                $usuarios = UserRepository::listar();
                $usuario = User::findOrFail($codigo);
            } else if (Auth::getUser()->codusuario===$codigo) {
                $usuario = Auth::getUser();
                $usuarios = null;
            }else{
                abort('403');
            }

            $repositorios = RepositorioRepository::listar();
            $dados = User::dados();
            return view('controle_usuario.edit', compact('dados', 'usuario', 'usuarios', 'repositorios'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'edit($codigo = null)';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function destroy($id = null)
    {
        if (Auth::user()->EAdministrador()) {
            $resultado = UserRepository::excluir($id);
        } else if (Auth::getUser()->codusuario===$id) {
            $resultado = UserRepository::excluir($id);
        }else{
            abort('403');
        }
        return \Response::json($resultado);
    }


}
