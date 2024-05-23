<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 04:32
 */

namespace App\Http\Fachadas;


use App\Http\Models\Documentacao;
use App\Http\Models\Modelo;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Viwers\DocumentacaoViewer;
use Illuminate\Http\Request;

class FachadaDocumentacaoTextualModelo extends FachadaConcreta
{
   public function show($codmodelo = null)
   {
       $modelo = Modelo::find($codmodelo);
       return view('descricao_textual.descricao_textual', compact('modelo'));
   }

}
