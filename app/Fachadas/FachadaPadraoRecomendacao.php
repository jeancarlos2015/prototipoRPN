<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 02:46
 */

namespace App\Http\Fachadas;


use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\PadraoRecomendacaoRepository;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaPadraoRecomendacao extends FachadaConcreta
{

    public static function make($tipo)
    {
        switch ($tipo) {
            case 'PadraoRecomendacaoBinario':
                return new FachadaPadraoRecomendacaoBinario();
            case 'PadraoRecomendacaoConjunto':
                return new FachadaPadraoRecomendacaoConjunto();
            default:
                return new FachadaPadraoRecomendacao();
        }
    }

    public function store(Request $request)
    {
        $codmodelodeclarativo = $request->codmodelodeclarativo;
        LogMessage::valida_request($request);

        $modelo = RepresentacaoDeclarativa::FindOrFail($codmodelodeclarativo);
        if(!$modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        $dado['codmodelodeclarativo'] = $request->codmodelodeclarativo;
        $dado['codmodelo'] = $modelo->codmodelo;
        $dado['id_relacionamento'] = $request->relacionamento;
        $dado['codobjetofluxo'] = $modelo->codobjetofluxo;
        $dado['codusuario'] = Auth::user()->codusuario;
        $dado['codprojeto'] = $modelo->codprojeto;
        $dado['codrepositorio'] = $modelo->codrepositorio;
        $dado['codmodelo'] = $modelo->codmodelo;
        $dado['publico'] = $request->publico;
        $dado['id_objetos_fluxos1'] = $request->sbOne;
        $dado['id_objetos_fluxos2'] = $request->sbTwo;
        $dado['nome'] = $request->nome;
        if (count($request->sbOne) == count($request->sbTwo)) {
            PadraoRecomendacaoRepository::salvar($dado);
            flash('Operação feita com sucesso')->success();
        }

        return redirect()->route('controle_padrao_create_conjunto', [
            'codmodelodeclarativo' => $codmodelodeclarativo
        ]);
    }


}
