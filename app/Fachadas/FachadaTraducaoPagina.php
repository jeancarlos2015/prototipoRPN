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
use Illuminate\Support\Facades\App;

class FachadaTraducaoPagina extends FachadaConcreta
{

    public function traduzir($locale, $pagina)
    {

        if ($pagina == 'modelospublicos') {
            $fachada = new FachadaRepresentacaoDiagramaticaPublica();
            return $fachada->ModelosPublicos($locale);
        } else if ($pagina == 'documentospublicos') {
            $fachada = new FachadaDocumentoPublico();
            return $fachada->DocumentosPublicos($locale);
        } else {
            App::setLocale($locale);
        }

        return view($pagina);
    }


}
