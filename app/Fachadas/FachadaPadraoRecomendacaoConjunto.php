<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 02:46
 */

namespace App\Http\Fachadas;


use App\Http\Models\RepresentacaoDeclarativa;
use Illuminate\Support\Facades\Auth;

class FachadaPadraoRecomendacaoConjunto extends FachadaPadraoRecomendacao
{


    public function create($codmodelodeclarativo = null, $codmodelodeclarativo1 = 0)
    {
        $modelo = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        if(!$modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        $tipo_operacao = 'conjunto';
        return view('controle_modelos_declarativos.controle_regras.create', compact('modelo', 'tipo_operacao'));
    }


}
