<?php


namespace App\Http\Fachadas;


use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Repositorys\ProjetoRepository;
use Illuminate\Http\Request;

class FachadaOperacoesRepositorio extends FachadaConcreta
{
    public function store(Request $request)
    {
        $projeto = Projeto::FindOrFail($request->codprojeto);
        $repositorio = Repositorio::FindOrFail($request->codrepositorio);
        $resultado = ProjetoRepository::transferir($projeto, $repositorio);
        return \Response::json($resultado);
    }
}
