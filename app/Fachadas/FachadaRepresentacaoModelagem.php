<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/09/2018
 * Time: 22:29
 */

namespace App\Http\Fachadas;


use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use App\Http\Viwers\ModeloViewer;
use Illuminate\Http\Request;

class FachadaRepresentacaoModelagem extends FachadaConcreta
{

    public function edit($codmodelodiagramatico = null)
    {


        $modelo = RepresentacaoDiagramaticaRepository::visualizar_modelo($codmodelodiagramatico);
        return view('controle_modelos_diagramaticos.modeler', compact('modelo'));
    }

    public function store(Request $request)
    {

        $result = RepresentacaoDiagramaticaRepository::gravar($request);
        RepresentacaoDiagramaticaRepository::gravar_log($request);
        return \Response::json($result);
    }

    public function get(Request $request)
    {
        $codmodelo = $request->codmodelodiagramatico;
        $modelo = RepresentacaoDiagramatica::findOrFail($codmodelo);
        return \Response($modelo->xml_modelo, 200, ['content-type' => 'application/xml']);
    }
}
