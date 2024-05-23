<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 13/07/2019
 * Time: 14:24
 */

namespace App\Http\Fachadas;


use App\Http\Models\Mensagem;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Repositorys\MensagemRepository;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class FachadaAviso extends FachadaConcreta
{


    public function show($codigo = null)
    {
        $mensagem = null;
        try {
            DB::beginTransaction();
            $mensagem = Mensagem::FindOrFail($codigo);
            $mensagem->visto = 1;
            $mensagem->update();
            DB::commit();
//            return \Response::json($mensagem);

        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Aviso';
            $data['acao'] = 'Atualização do aviso';
            LogMessage::create_log($data);
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        MensagemRepository::enviar($request->all());
        return redirect()->back();
    }

}
