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

class FachadaDocumentacaoTextualDiagrama extends FachadaConcreta
{
    public function show($codmodelodiagramatico = null)
    {
        $diagrama = RepresentacaoDiagramatica::find($codmodelodiagramatico);
        return view('descricao_textual.descricao_textual_diagrama', compact('diagrama'));
    }

}
