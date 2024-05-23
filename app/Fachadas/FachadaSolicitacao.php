<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 14/10/2018
 * Time: 16:55
 */

namespace App\Http\Fachadas;


use App\Http\Models\Solicitacao;
use App\Http\Repositorys\SolicitacaoRepository;
use Illuminate\Http\Request;

class FachadaSolicitacao extends FachadaConcreta
{

    public function store(Request $request)
    {
        $resultado = SolicitacaoRepository::Solicitar($request->codrepositorio, $request->mensagem);
        if ($resultado === true) {
            $mensagem = flash('Operação feita com sucesso!');
            return \Response::json($mensagem);
        }
        return \Response::json($resultado);
    }

    public function destroy($codigo = 0)
    {
        $resultado = SolicitacaoRepository::excluir($codigo);
        return \Response::json($resultado);
    }

    public function all()
    {
        $solicitacoes = Solicitacao::all();
        return view('controle_solicitacoes.all', compact('solicitacoes'));
    }
}
