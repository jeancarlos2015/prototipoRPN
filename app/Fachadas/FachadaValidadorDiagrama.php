<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 04:32
 */

namespace App\Http\Fachadas;


use App\Http\Models\Documentacao;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Viwers\DocumentacaoViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaValidadorDiagrama extends FachadaConcreta
{

    public function index($codusuario = 0, $codmodelodiagramatico = 0)
    {
        RepresentacaoDiagramatica::where('codmodelodiagramatico', $codmodelodiagramatico)
            ->update(['codusuariovalidador' => $codusuario]);
        return redirect()->back();
    }

    public function validarDiagrama($codmodelodiagramatico)
    {
        try {
            DB::beginTransaction();
            $diagrama = RepresentacaoDiagramatica::find($codmodelodiagramatico);

            if ($diagrama->validado) {
                RepresentacaoDiagramatica::where('codmodelodiagramatico', $codmodelodiagramatico)
                    ->update(['validado' => 'false', 'codusuariovalidador' => Auth::getUser()->codusuario]);
                DB::commit();
                return flash('Diagrama desvalidado com sucesso')->success();
            } else {
                RepresentacaoDiagramatica::where('codmodelodiagramatico', $codmodelodiagramatico)
                    ->update(['validado' => 'true', 'codusuariovalidador' => Auth::getUser()->codusuario]);
                DB::commit();
                return flash('Diagrama validado com sucesso')->success();
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
    public function validar($codmodelodiagramatico){
        $resultado = $this->validar($codmodelodiagramatico);
        return \Response::json($resultado);
    }
    public function show($codmodelodiagramatico = null)
    {
        $resultado = $this->validarDiagrama($codmodelodiagramatico);
        return \Response::json($resultado);

    }
}
