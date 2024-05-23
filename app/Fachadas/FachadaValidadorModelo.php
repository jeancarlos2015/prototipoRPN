<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 04:32
 */

namespace App\Http\Fachadas;


use App\Http\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FachadaValidadorModelo extends FachadaConcreta
{


    public function show($codmodelo = null)
    {
        $modelo = Modelo::findOrFail($codmodelo);
        $result = count(collect($modelo->representacoes_diagramaticas)->where('validado', 'false')) > 0;
        if ($result) {
            Modelo::where('codmodelo', $modelo->codmodelo)
                ->update(['validado' => 'false']);
        } else {
            Modelo::where('codmodelo', $modelo->codmodelo)
                ->update(['validado' => 'true']);
        }
        return redirect()->back();
    }

    public function validarModelo($codmodelo){
        $modelo = Modelo::findOrFail($codmodelo);
        $result = count(collect($modelo->representacoes_diagramaticas)->where('validado', 'false')) > 0;

        try {
            DB::beginTransaction();

            if ($result) {
                Modelo::where('codmodelo', $modelo->codmodelo)
                    ->update(['validado' => 'false']);
                DB::commit();
                return flash('Usuario validador removido com sucesso')->success();
            } else {
                Modelo::where('codmodelo', $modelo->codmodelo)
                    ->update(['validado' => 'true']);
                DB::commit();
                return flash('Usuario validador atribuido com sucesso')->success();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            return $this->create_log($data);
        }
    }

}
