<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 23/09/2018
 * Time: 00:09
 */

namespace App\Http\Fachadas;


use App\Http\Models\Mensagem;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\RepresentacaoDiagramaticaVersionavel;
use App\Http\Repositorys\DiagramaVersionavelRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use App\Http\Util\LogMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaDiagramaVersionavel extends FachadaConcreta
{
    public function index($codmodelodiagramatico = 0, $codigo2 = 0)
    {

        $representacao_diagramatica = RepresentacaoDiagramatica::findOrFail($codmodelodiagramatico);
        if (!($representacao_diagramatica->eProprietario() || Auth::getUser()->EProprietario())) {
            exit(403);
        }
        return view('controle_modelos_diagramaticos_versionaveis.index', compact('representacao_diagramatica'));
    }

    public function show($codmodelodiagramaticoversionavel = null)
    {
        $modelo = RepresentacaoDiagramaticaVersionavel::findOrFail($codmodelodiagramaticoversionavel);

//        if (!($modelo->diagrama->eProprietario() || Auth::getUser()->EProprietario())) {
//            exit(403);
//        }
        return view('controle_modelos_diagramaticos_versionaveis.visualizar_modelo', compact('modelo'));
    }

    public function create($coddiagramaversionavel = null, $codigo = 0)
    {
        DiagramaVersionavelRepository::create($coddiagramaversionavel);

        return redirect()->back();
    }
}
