<?php

namespace App\Http\Repositorys;


use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Models\UsuarioModelo;
use App\Http\Models\UsuarioProjeto;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(User::class);
    }

    public static function atualizarElista($codprojeto)
    {

        try {
            DB::beginTransaction();
            $projeto = Projeto::findOrFail($codprojeto);
            if (!$projeto->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
            Auth::user()->codprojeto = $codprojeto;
            Auth::user()->update();
            DB::commit();
            return self::listar_usuarios();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'index($codprojeto = 0, $request2 = 0)';
            LogMessage::create_log($data);
            return collect([]);
        }

    }

    public static function listar_usuarios()
    {
        return Cache::remember('listar_usuarios' . Auth::getUser()->codusuario, 2000, function () {
            return User::get();
        });
    }

    public static function listar_usuarios_online()
    {
        return Cache::remember('listar_usuarios_online' . Auth::user()->codusuario, 2000, function () {
            $usuarios = [];
            $usuarios_online = [];
            if (Auth::getUser()->usuario_esta_no_repositorio()) {
                $usuarios_online = Auth::getUser()->repositorio->usuarios_do_repositorio();
            } else if (Auth::getUser()->EAdministrador()) {
                $usuarios_online = User::get();
            }

            foreach ($usuarios_online as $usuario) {
                if ($usuario->online()) {
                    array_push($usuarios, $usuario);
                }
            }
            return collect($usuarios);
        });
    }

    public static function listar()
    {
        return self::listar_usuarios();
    }

    public static function auth_user_repositorio_modelos()
    {
        return Cache::remember('auth_user_repositorio_modelos' . Auth::getUser()->codusuario, 2000, function () {
            return Auth::user()->repositorio->modelos ?? collect([]);
        });
    }

    public static function atualizar(Request $request, $codmodelo)
    {
        $value = false;
        try {
            DB::beginTransaction();
            $user = User::findOrFail($codmodelo);
            $user->tipo = $request->tipo;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
            $user->name = $request->name;
            $user->codusuariopai = Auth::user()->codusuario;
            $user->codrepositorio = $request->tipo ==='PADRAO' ? null : $user->codrepositorio;
            self::limpar_cache();
            $value = $user->update();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'index($codprojeto = 0, $request2 = 0)';
            LogMessage::create_log($data);
            return false;
        }
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_usuarios' . Auth::getUser()->codusuario);
        Cache::forget('listar_usuarios_online' . Auth::getUser()->codusuario);
        Cache::forget('listar_modelos' . Auth::getUser()->codusuario);
        Cache::forget('listar_projetos' . Auth::getUser()->codusuario);
        Cache::forget('listar_usuarios_sem_vinculos' . Auth::getUser()->codusuario);
        Cache::forget('listar_entradas_usuarios_projetos' . Auth::getUser()->codusuario);
        Cache::forget('listar_entradas_usuarios_repositorios' . Auth::getUser()->codusuario);
        Cache::forget('auth_user_repositorio_modelos' . Auth::getUser()->codusuario);
        Cache::forget('listar_vinculacoes' . Auth::getUser()->codusuario);
        Cache::forget('repositorios' . Auth::getUser()->codusuario);
        Cache::forget('usuarios_do_repositorio' . Auth::getUser()->codusuario);
        Cache::forget('usuarios_do_repositorio_corrente' . Auth::getUser()->codusuario);
        Cache::forget('listar_todas_regras' . Auth::getUser()->codusuario);
        Cache::forget('listar_todos_repositorios' . Auth::getUser()->codusuario);
        Cache::forget('projetos' . Auth::getUser()->codusuario);
        Cache::forget('modelos' . Auth::getUser()->codusuario);
        Cache::forget('todos_modelos' . Auth::getUser()->codusuario);
        Cache::forget('listar_mensagens_usuarios' . Auth::getUser()->codusuario);
        Cache::forget('listar_usuarios_repositorios' . Auth::getUser()->codusuario);

    }

    public static function incluir(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->request->add(['codusuariopai' => Auth::user()->codusuario]);
            $value = User::create($request->all());
            self::limpar_cache();
            DB::commit();
            return $value;

        } catch (\Exception $ex) {
            DB::rollBack();
        }

    }


    public static function excluir($codusuario)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = User::findOrFail($codusuario)->delete();
            self::limpar_cache();
            DB::commit();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'destroy($id = null)';
            return LogMessage::create_log($data);
        }

    }

    public static function listar_entradas_usuarios_projetos()
    {
        return Cache::remember('listar_entradas_usuarios_projetos' . Auth::getUser()->codusuario, 2000, function () {
            return UsuarioProjeto::all();
        });
    }

    public static function listar_entradas_usuarios_repositorios()
    {
        return Cache::remember('listar_entradas_usuarios_repositorios' . Auth::getUser()->codusuario, 2000, function () {
            return UsuarioRepositorio::all();
        });
    }

    public static function existe_usuario_repositorio($codusuario, $codrepositorio)
    {
        $result = self::listar_entradas_usuarios_repositorios()
            ->where('codusuario', '=', $codusuario)
            ->where('codrepositorio', '=', $codrepositorio);
        return $result->count() > 0;
    }

    public static function existe_usuario_projeto($codusuario, $codprojeto)
    {
        $result = self::listar_entradas_usuarios_projetos()
            ->where('codusuario', '=', $codusuario)
            ->where('codprojeto', '=', $codprojeto);
        return $result->count() > 0;
    }

    public static function listar_entradas_usuarios_modelos()
    {
        return Cache::remember('listar_entradas_usuarios_modelos' . Auth::getUser()->codusuario, 2000, function () {
            return UsuarioModelo::all();
        });
    }

    public static function existe_usuario_modelo($codusuario, $codmodelo)
    {
        $result = self::listar_entradas_usuarios_modelos()
            ->where('codusuario', '=', $codusuario)
            ->where('codmodelo', '=', $codmodelo);
        return $result->count() > 0;
    }

    public static function vincular_usuario_repositorio($codusuario, $codrepositorio, $tipo)
    {
        $usuario_repositorio = null;

        try {
            DB::beginTransaction();
            $admin = \DB::table('users')
                ->whereRaw("upper(tipo) like 'ADMINISTRADOR'")
                ->get()->first();

            $dado = [
                'codusuario' => $codusuario,
                'codrepositorio' => $codrepositorio,
                'tipo' => $tipo,
                'usuariopai' => !empty($admin) ? $admin->codusuario : Auth::getUser()->codusuario
            ];
            $usuario_repositorio = UsuarioRepositorio::create($dado);
            limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'destroy($id = null)';
            return LogMessage::create_log($data);
        }

        return $usuario_repositorio;
    }

    public static function vincular_usuario_projeto($codusuario, $codprojeto, $tipo)
    {
        $usuario_projeto = null;
        try {
            DB::beginTransaction();
            $usuario = User::findOrFail($codusuario);
            $projeto = Projeto::findOrFail($codprojeto);
            $dado = [
                'codusuario' => $usuario->codusuario,
                'codprojeto' => $projeto->codprojeto,
                'tipo' => $tipo
            ];
            $usuario_projeto = UsuarioProjeto::create($dado);
            limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'destroy($id = null)';
            return LogMessage::create_log($data);
        }

        return $usuario_projeto;
    }

    private static function Existe($entrada)
    {
        return UsuarioModelo::all()
                ->where('codusuario', $entrada->codusuario)
                ->where('codmodelo', $entrada->codmodelo)
                ->where('tipo', $entrada->tipo)
                ->count() > 0;
    }

    private static function Find($entrada)
    {
        return UsuarioModelo::all()
            ->where('codusuario', $entrada->codusuario)
            ->where('codmodelo', $entrada->codmodelo)
            ->where('tipo', $entrada->tipo)
            ->first();
    }

    public static function atualizar_usuario_modelo($codusuario, $codmodelo, $tipo)
    {
        try {
            DB::beginTransaction();
            $usuario = User::findOrFail($codusuario);
            $modelo = Modelo::findOrFail($codmodelo);
            $usuario_modelo = new UsuarioModelo();

            $usuario_modelo->usuario = $usuario;
            $usuario_modelo->modelo = $modelo;
            $usuario_modelo->tipo = $tipo;
            $usuario_modelo = self::Find($usuario_modelo);
            $usuario_modelo->update();
            limpar_cache();
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'destroy($id = null)';
            return LogMessage::create_log($data);
        }
    }

    public static function vincular_usuario_modelo($codusuario, $codmodelo, $tipo)
    {
        $usuario_modelo = null;
        try {
            DB::beginTransaction();

            $usuario = User::findOrFail($codusuario);
            $modelo = Modelo::findOrFail($codmodelo);
            $usuario_modelo = new UsuarioModelo();

            $usuario_modelo->usuario = $usuario;
            $usuario_modelo->modelo = $modelo;
            $usuario_modelo->tipo = $tipo;
            if (!self::Existe($usuario_modelo)) {
                $dado['codusuario'] = $usuario->codusuario;
                $dado['codmodelo'] = $modelo->codmodelo;
                $dado['tipo'] = $tipo;

                $usuario_modelo = UsuarioModelo::create($dado);

            } else {
                $usuario_modelo = self::Find($usuario_modelo);
            }
            limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaUsuario';
            $data['acao'] = 'destroy($id = null)';
            return LogMessage::create_log($data);
        }
        return $usuario_modelo;
    }

    public static function listar_vinculacoes()
    {

        return Cache::remember('listar_vinculacoes' . Auth::getUser()->codusuario, 2000, function () {
            $usuarios = self::listar_usuarios();

            $vinculacoes = [];
            foreach ($usuarios as $usuario) {
                if (!empty($usuario->usuarios_repositorios)) {
                    $entradas = $usuario->usuarios_repositorios;
                    foreach ($entradas as $entrada) {
                        if (in_array($entrada->tipo, ['PROPRIETARIO', 'COLABORADOR', 'CLIENTE'])) {
                            array_push($vinculacoes, $entrada);
                            break;
                        }
                    }

                }
            }
            return $vinculacoes;
        });
    }

    public static function usuarios_sem_vinculo()
    {
        return Cache::remember('listar_usuarios_sem_vinculos' . Auth::getUser()->codusuario, 2000, function () {
            return User::whereRaw('codrepositorio is NULL')
                ->get();
        });
    }
}
