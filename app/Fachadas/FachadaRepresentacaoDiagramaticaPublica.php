<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/09/2018
 * Time: 22:17
 */

namespace App\Http\Fachadas;


use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class FachadaRepresentacaoDiagramaticaPublica extends FachadaConcreta
{
    public function index($codigo = null, $codigo2 = null)
    {
        $titulos = RepresentacaoDiagramatica::titulos();
        $modelos = RepresentacaoDiagramaticaRepository::listar_modelos_publicos();
        $tipo = 'publico';
        $contador = 0;
        return view('modelos_publicos.index', compact('modelos', 'titulos', 'tipo', 'contador'));
    }
    public function ModelosPublicos($locale){
        $titulos = RepresentacaoDiagramatica::titulos();
        $modelos = RepresentacaoDiagramaticaRepository::listar_modelos_publicos();
        $tipo = 'publico';
        $contador = 0;
        App::setLocale($locale);
        return view('modelos_publicos.index', compact('modelos', 'titulos', 'tipo', 'contador'));
    }

    public function show($codigo = null)
    {
        $diagrama = RepresentacaoDiagramatica::Find($codigo);
        if(!$diagrama->modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        return view('modelos_publicos.visualizar_modelo', compact('modelo'));
    }


}
