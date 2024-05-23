<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 23/09/2018
 * Time: 04:13
 */

namespace App\Http\Fachadas;


use App\http\Models\Repositorio;
use App\Http\Models\UsuarioRepositorio;
use App\Http\Repositorys\VinculoUsuarioRepositorioRepository;
use App\Http\Util\LogMessage;
use App\User;
use Composer\DependencyResolver\Transaction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaVinculoUsuarioRepositorio extends FachadaConcreta
{
    public function create($codrepositorio = null, $codigo = 0)
    {
       $resultado =  VinculoUsuarioRepositorioRepository::acessarUsuarioRepositorio($codrepositorio);
       if ($codigo ==0){
           return redirect()->back();
       }
       return \Response::json($resultado);
    }

    public function index($codigo1 = 0, $codigo2 = 0)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail(Auth::user()->codusuario);
            $user->codrepositorio = null;
            if ($user->update()) {
                limpar_cache_geral();
                DB::commit();
                flash('Operação feita com sucesso!')->success();
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            LogMessage::create_log($data);
        }

        Artisan::call('cache:clear');
        return redirect()->route('painel');
    }



    public function destroy($codusuariorepositorio = null)
    {
        $resultado = VinculoUsuarioRepositorioRepository::excluir($codusuariorepositorio);
        return \Response::json($resultado);
    }
}
