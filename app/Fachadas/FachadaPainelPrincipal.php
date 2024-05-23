<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/09/2018
 * Time: 21:51
 */

namespace App\Http\Fachadas;


use App\Http\Repositorys\RepositorioRepository;

class FachadaPainelPrincipal extends FachadaConcreta
{

    public function index($request = null, $codigo2 = null)
    {
        RepositorioRepository::criarRepositorioPadrao(\Auth::getUser()->name);
        return view('painel.index');
    }

}
