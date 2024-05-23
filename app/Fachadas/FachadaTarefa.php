<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 27/10/2018
 * Time: 04:23
 */

namespace App\Http\Fachadas;


use App\Http\Models\Modelo;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Models\RepresentacaoDiagramatica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FachadaTarefa extends FachadaConcreta
{
    public function index($codigo1 = 0, $codigo2 = 0)
    {
        $representacao_diagramatica = RepresentacaoDiagramatica::FindOrFAIL($codigo1);
        $modelo = $representacao_diagramatica->modelo;
        if(!$modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        return view('controle_checklist_modelo.checklist', compact('modelo'));
    }

    public function show($codigo = null)
    {
        $modelo = Modelo::FindOrFail($codigo);
        if(!$modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        if (!isset($modelo->representacao_declarativa)) {
            try {
                DB::beginTransaction();
                $representacao_declarativa = new RepresentacaoDeclarativa();
                $representacao_declarativa->codusuario = Auth::user()->codusuario;
                $representacao_declarativa->codrepositorio = $modelo->codrepositorio;
                $representacao_declarativa->codprojeto = $modelo->codprojeto;
                $representacao_declarativa->codmodelo = $modelo->codmodelo;
                $representacao_declarativa->nome = $modelo->nome;
                $representacao_declarativa->descricao = $modelo->descricao;
                $representacao_declarativa->tipo = 'declarativo';
                $representacao_declarativa->save();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
            }

            limpar_cache();
        } else {
            $representacao_declarativa = $modelo->representacao_declarativa;
        }
        return view('controle_modelo_declarativo1.create', compact('representacao_declarativa'));
    }

    public function store(Request $request)
    {

    }
}
