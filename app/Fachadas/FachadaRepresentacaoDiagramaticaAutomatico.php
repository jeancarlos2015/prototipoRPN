<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/09/2018
 * Time: 21:16
 */

namespace App\Http\Fachadas;


use App\Http\Models\AcessoRecente;
use App\Http\Models\Mensagem;
use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\UsuarioModelo;
use App\Http\Repositorys\AcessoRecenteRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use App\Http\Util\LogMessage;
use App\Http\Viwers\DiagramaViwer;
use App\Http\Viwers\ModeloViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaRepresentacaoDiagramaticaAutomatico extends FachadaModelo
{


    public function store(Request $request)
    {
        $diagrama = RepresentacaoDiagramaticaRepository::criarDiagramaAutomatico($request);
        flash('Operação feita com sucesso!')->success();
        return redirect()->route('edicao_modelo_diagramatico', [$diagrama->codmodelodiagramatico]);
    }


}
