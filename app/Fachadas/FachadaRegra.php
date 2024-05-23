<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 01:03
 */

namespace App\Http\Fachadas;


use App\http\Models\Regra;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\RegraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaRegra extends FachadaConcreta
{


    public function index($codmodelodeclarativo = null, $request = null)
    {
        $tipo = 'regra';
        $titulos = Regra::titulos();
        $modelo = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        if(!$modelo->UsuarioTemPermissao(Auth::getUser())){
            exit(403);
        }
        return view('controle_regras.index', compact('tipo', 'titulos', 'modelo'));
    }


    public function update(Request $request, $codregra)
    {
        try {
            $regra = RegraRepository::atualizar($request, $codregra);
            flash('Operação feita com sucesso')->success();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'update(Request $request, $codregra)';
            $this->create_log($data);
        }
        return redirect()->route('controle_regras_index', [$regra->codmodelodeclarativo]);
    }

    public function show($codregra = null)
    {
        $regra = Regra::findOrFail($codregra);
        return view('controle_regras.show', compact('regra'));
    }

    public function edit($codregra = null)
    {
        $regra = Regra::findOrFail($codregra);
        $titulos = Regra::titulos();
        $dados = Regra::dados();
        $dados[0]->valor = $regra->nome;
        return view('controle_regras.edit', compact('regra', 'titulos', 'dados'));
    }

    public function destroy($codregra = null)
    {
        try {
            $regra = RegraRepository::excluir($codregra);
            flash('Operação feita com sucesso')->success();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'destroy($codregra = null)';
            $this->create_log($data);
        }
        return redirect()->route('controle_regras_index', [$regra->codmodelodeclarativo]);
    }

    public function all()
    {
        $repositorio = null;
        if (Auth::user()->papel() === 'ADMINISTRADOR') {
            $regras = RegraRepository::listar();
        } else if (Auth::user()->papel() !== 'ADMINISTRADOR') {
            $regras = Auth::user()->repositorio->regras;
        }
        if (Auth::user()->papel() !== 'ADMINISTRADOR') {
            $repositorio = Auth::user()->repositorio;
        }
        $tipo = 'regra';
        $titulos = Regra::titulos();

        return view('controle_regras.all', compact('regras', 'tipo', 'titulos', 'repositorio'));
    }


}
