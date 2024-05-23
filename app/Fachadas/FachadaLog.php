<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 04:31
 */

namespace App\Http\Fachadas;


use App\Http\Models\Log;
use App\Http\Repositorys\LogRepository;
use App\Http\Viwers\LogViwer;

class FachadaLog extends FachadaConcreta
{


    public function index($request = null, $request2 = null)
    {
        $log_viwer = new LogViwer();
        return view('controle_logs.logs', compact('log_viwer'));
    }


    public function destroy($codigo = null)
    {
        $result = LogRepository::excluir($codigo);
        return \Response::json($result);
    }


}
