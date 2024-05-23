<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 13:46
 */

namespace App\Http\Fachadas;


use Illuminate\Http\Request;

class FachadaConcreta extends FachadaAbstract
{

    public function selecionar($dado)
    {
        return null;
    }

    public function desvincular($codigo)
    {
        return null;
    }

    public function vincular($request)
    {
        return null;
    }

    public function listar($request)
    {
        return null;
    }

    public function gravar(Request $request)
    {
        return null;
    }

    public function edicao_modelo_diagramatico($request)
    {
        return null;
    }
    public function download($codmodelodiagramatico, $tipo){
        return null;
    }
    public function get(Request $request)
    {
        return null;
    }

    public function painel($request = null)
    {
        return null;
    }

    public function index($codigo1 = 0, $codigo2 = 0)
    {
        return null;
    }

    public function create($request = null, $codigo = 0)
    {
        return null;
    }

    public function store(Request $request)
    {
        return null;
    }

    public function update(Request $request, $codigo)
    {
        return null;
    }

    public function show($codigo = null)
    {
        return null;
    }

    public function edit($codigo = null)
    {
        return null;
    }

    public function destroy($codigo = 0)
    {
        return null;
    }

    public function all()
    {
        return null;
    }

    public function escolhe_modelo(Request $request)
    {
        return null;
    }


    public function delete(Request $request)
    {
        return null;
    }

    public function delete_repository($repositorio_atual)
    {
        return null;
    }

    public function edit_repository(Request $request = null)
    {
        echo 'Página em construção!!!';
        return null;
    }

    public function criar_base(Request $request)
    {
        return null;
    }

    public function selecionar_repositorio($repositorio_atual, $default_branch)
    {
        return null;
    }

    public function visualizar_modelo_publico($codmodelo)
    {
        return null;
    }

    public function modelos_publicos()
    {
        return null;
    }


    public function traduzir($locale, $pagina)
    {
        return null;
    }

    public function upload(Request $request)
    {
        return null;
    }

    public function alterar(Request $request, $codigo)
    {
        return null;
    }
}
