<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 30/11/2018
 * Time: 10:21
 */

namespace App\Http\Fachadas;


use App\Http\Models\Documentacao;
use Illuminate\Support\Facades\App;

class FachadaDocumentoPublico extends FachadaConcreta
{
    public function index($codigo1 = 0, $codigo2 = 0)
    {
        $documentos = Documentacao::where('publico', '=', true)
            ->get();
        return view('controle_documentos_publicos.index', compact('documentos'));
    }

    public function DocumentosPublicos($locale)
    {
        $documentos = Documentacao::where('publico', '=', true)
            ->get();
        App::setLocale($locale);
        return view('controle_documentos_publicos.index', compact('documentos'));
    }
}
