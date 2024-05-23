<?php


namespace App\Http\Fachadas;


use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\Http\Repositorys\ModeloRepository;
use Illuminate\Http\Request;

class FachadaOperacoesModelo extends FachadaConcreta
{
    public function store(Request $request)
    {
        $modelo = Modelo::FindOrFail($request->codmodelo);
        $projeto = Projeto::FindOrFail($request->codprojeto);
        $mensagem = null;
        if($modelo->codprojeto == $request->codprojeto){
            $mensagem = flash('Modelo já faz parte do processo!')->warning();
        }else if(!$projeto->permissao() || !$modelo->permissao()){
            $mensagem = flash('Operação não autorizada!')->warning();
        }else{
            $mensagem =  ModeloRepository::transferir($modelo, $projeto);
        }
        return \Response::json($mensagem);
    }
}
