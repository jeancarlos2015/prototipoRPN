<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:36
 */

namespace App\Http\Fachadas;


use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use PDF;

class FachadaDownloadDiagrama extends FachadaConcreta
{


    public function download($codmodelodiagramatico, $tipo)
    {
        return RepresentacaoDiagramaticaRepository::download($codmodelodiagramatico, $tipo);
    }

    public function downloadSVG($codmodelodiagramatico){
        $diagrama = RepresentacaoDiagramatica::findOrFail($codmodelodiagramatico);
        $resultado = isset($diagrama->svg_modelo) ? $diagrama->svg_modelo : $diagrama->svgPadrao();
        return \Response::json($resultado);;
    }
}
