<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:36
 */

namespace App\Http\Fachadas;


use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\ComentarioDiagramaRepository;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class FachadaComentarioDiagrama extends FachadaConcreta
{


    public function index($codmodelodiagramatico = null, $request2 = null)
    {
        $diagrama = RepresentacaoDiagramatica::findOrFail($codmodelodiagramatico);
        return view('controle_modelos_diagramaticos.comenting',compact('diagrama'));
    }

    public function destroy($codigo = 0)
    {
        $resultado = ComentarioDiagramaRepository::destroy($codigo);
        return \Response::json($resultado);
    }


}
