<?php


namespace App\Http\Fachadas;


use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Repositorys\ProjetoRepository;
use Illuminate\Http\Request;

class FachadaOperacoesProjeto extends FachadaConcreta
{
    public function store(Request $request)
    {
        $projeto = Projeto::FindOrFail($request->codprojeto);
        $repositorio = Repositorio::FindOrFail($request->codrepositorio);
        $resultado = null;
        if($projeto->codrepositorio == $request->codrepositorio){
            $resultado =  flash('Processo já faz parte do repositório!')->warning();
        }else if (!$projeto->permissao() || !$repositorio->permissao()) {
            $resultado =  flash('Operação não autorizada!')->warning();
        }else{
            $resultado =  ProjetoRepository::transferir($projeto, $repositorio);
        }
        return \Response::json($resultado);
    }
}
