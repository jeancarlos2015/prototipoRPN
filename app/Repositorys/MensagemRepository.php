<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 13/07/2019
 * Time: 21:45
 */

namespace App\Http\Repositorys;


use App\Http\Models\Mensagem;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MensagemRepository
{
    public function __construct()
    {
        $this->setModel(Mensagem::class);
    }

    public static function mensagem_existe($assunto)
    {
        $modelos = self::listar();
        return $modelos->where('assunto', $assunto)->count() > 0;
    }
    public static function salvar(Request $request){



        try {
            DB::beginTransaction();
            foreach ($request->codusuarios as $codusuario) {
                $request->request->add(['codusuariodestinatario' => $codusuario]);
                if (Auth::user()->usuario_esta_no_repositorio()) {
                    $request->request->add(['codrepositorio' => Auth::user()->repositorio->codrepositorio]);
                }
                if (Auth::user()->usuario_esta_no_projeto()) {
                    $request->request->add(['codprojeto' => Auth::user()->projeto->codprojeto]);
                }
                if (Auth::user()->usuario_esta_no_modelo()) {
                    $request->request->add(['codmodelo' => Auth::user()->modelo->codmodelo]);
                }
                $request->request->add(['visto' => 0]);
                MensagemRepository::incluir($request->all());
            }
            limpar_cache();
            DB::commit();
            return flash('Operação feita com sucesso');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaMensagem';
            $data['acao'] = 'update(Request $request, $codmensagem)';
            return LogMessage::create_log($data);
        }

    }

    public static function enviar($dado = []){

        try {
            DB::beginTransaction();
            foreach (Auth::getUser()->usuarios() as $usuario){

                if ($usuario->TemAviso())
                {
                    $mensagem = $usuario->Aviso();
                    $mensagem->texto = $dado['texto'];
                    $mensagem->visto = 0;
                    $mensagem->assunto = $dado['assunto'];
                    $mensagem->update();
                }else{
                    $dado['codusuariodestinatario'] = $usuario->codusuario;
                    $mensagem =   Mensagem::create($dado);
                }
            }
            DB::commit();
            flash('Operação feita com sucesso!');
        }catch (\Exception $ex){
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Aviso';
            $data['acao'] = 'Criação do aviso';
            LogMessage::create_log($data);
        }

    }

    public static function limpar_cache()
    {
        Cache::forget('listar_mensagens_usuario'.Auth::getUser()->codusuario);
        Cache::forget('listar_mensagens_modelo'.Auth::getUser()->codusuario);
        Cache::forget('listar_mensagens_projeto'.Auth::getUser()->codusuario);
        Cache::forget('listar_mensagens_repositorio'.Auth::getUser()->codusuario);
    }

    public static function atualizar(Request $request, $codmensagem)
    {
        $value = null;
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i:s');
            $request->request->add(['updated_at' => $date]);
            $request->request->add(['visto' => 1]);
            $value = Mensagem::findOrFail($codmensagem)->update($request->all());
            limpar_cache();
            DB::commit();
            return flash('Mensagem arquivada com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaMensagem';
            $data['acao'] = 'update(Request $request, $codmensagem)';
            return LogMessage::create_log($data);
        }
    }
    public static function listarMensagens(){
        $mensagens = [];
        if (Auth::getUser()->EadministradorENaoEstaNoRepositorio()) {
            $mensagens = Mensagem::all();
        } else if (Auth::user()->usuario_esta_no_repositorio()) {
            $mensagens = Mensagem::where('codusuariodestinatario', '=', Auth::user()->codusuario)
                ->orWhere('codusuario', '=', Auth::user()->codusuario)
                ->get();
        }
        return collect($mensagens);
    }
    public static function atualizarMensagem($codigo){
        try {
            DB::beginTransaction();
            $mensagem = Mensagem::FindOrFail($codigo);
            $mensagem->visto = true;
            $mensagem->update();
            limpar_cache();
            DB::commit();
            return flash('Mensagem arquivada com sucesso!');

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }

    }
    public static function incluir($dado = [])
    {
        $value = null;
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i:s');
            $data['created_at'] = $date;
            $dado['codusuario'] = Auth::user()->codusuario;
            $dado['created_at'] = $date;
            $value = Mensagem::create($dado);
            limpar_cache_geral();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'MensagemRepositor';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }

        return $value;
    }


    public static function excluir($codmensagem)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $value = Mensagem::findOrFail($codmensagem)->delete();
            limpar_cache();
            DB::commit();
            return $value;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'MensagemRepositor';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }
    }

    public static function listar_mensagens_usuario()
    {
        return Cache::remember('listar_mensagens_usuario'.Auth::getUser()->codusuario, 2000, function () {
            return Mensagem::where('codusuario',Auth::user()->codusuario)->get();
        });
    }

    public static function listar_mensagens_repositorio()
    {
        return Cache::remember('listar_mensagens_repositorio'.Auth::getUser()->codusuario, 2000, function () {
            if(Auth::user()->usuario_esta_no_repositorio()){
                return Mensagem::where('codrepositorio',Auth::user()->repositorio->codrepositorio)->get();
            }
            return collect([]);
        });
    }


    public static function listar_mensagens_projeto()
    {
        return Cache::remember('listar_mensagens_projeto'.Auth::getUser()->codusuario, 2000, function () {
            if(Auth::user()->usuario_esta_no_projeto()){
                return Mensagem::where('codprojeto',Auth::user()->projeto->codprojeto)->get();
            }
            return collect([]);
        });
    }

    public static function listar_mensagens_modelo()
    {
        return Cache::remember('listar_mensagens_modelo'.Auth::getUser()->codusuario, 2000, function () {
            if(Auth::user()->usuario_esta_no_modelo()){
                return Mensagem::where('codmodelo',Auth::user()->modelo->codmodelo)->get();
            }
            return collect([]);
        });
    }


}
