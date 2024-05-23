<?php


namespace App\Http\Fachadas;


use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use Illuminate\Http\Request;

class FachadaOperacoesDiagrama extends FachadaConcreta
{
    public function store(Request $request)
    {
        $mensagem = null;
        $diagrama = RepresentacaoDiagramatica::FindOrFail($request->codmodelodiagramatico);
        $modelo = Modelo::FindOrFail($request->codmodelo);
        if($diagrama->codmodelo == $request->codmodelo){
            $mensagem =  flash('Diagrama já faz parte do modelo!')->warning();
        }else if(!$diagrama->modelo->permissao() || !$modelo->permissao()){
            $mensagem =  flash('Operação não autorizada!')->warning();
        }else{
            $mensagem =  RepresentacaoDiagramaticaRepository::transferir($diagrama,$modelo);
        }
        return \Response::json($mensagem);
    }
}
