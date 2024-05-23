<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 00:36
 */

namespace App\Http\Fachadas;


use Illuminate\Http\Request;

class FachadaPortalUsuario extends FachadaConcreta
{


   public function store(Request $request)
   {
       $fachada = new \App\Http\Fachadas\FachadaUsuario();
       return $fachada->salvar($request);
   }


}
