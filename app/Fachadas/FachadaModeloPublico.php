<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:36
 */

namespace App\Http\Fachadas;


use App\Http\Models\RepresentacaoDiagramatica;
use Illuminate\Http\Request;

class FachadaModeloPublico extends FachadaConcreta
{


    public function show($codmodelo = null)
    {
        $modelo = RepresentacaoDiagramatica::Find($codmodelo);
        if($modelo->modelo->publico == false){
            return abort(404);
        }
        return view('modelos_publicos.visualizar_modelo', compact('modelo'));
    }

}
