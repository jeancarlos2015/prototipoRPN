<?php
/**
 * Created by PhpStorm.
 * User: secre
 * Date: 18/10/2018
 * Time: 15:48
 */

namespace App\Http\Fachadas;


use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Util\LogMessage;
use Illuminate\Support\Facades\Auth;

class FachadaRelatorioPDF extends FachadaConcreta
{
    public function index($codigoprojeto = 0, $codigo2 = 0)
    {
        try {
            $projeto = Projeto::findOrFail($codigoprojeto);
            if(!$projeto->UsuarioTemPermissao(Auth::getUser())){
                exit(403);
            }
            return view('relatorios.relatorio_projeto.relatorio', compact('projeto'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'relatório';
            $data['acao'] = 'gerar relatório';
            LogMessage::create_log($data);
            return redirect()->back();
        }

    }

    public function show($codigorepositorio = null)
    {
        try {
            $repositorio = Repositorio::findOrFail($codigorepositorio);
            if(!$repositorio->UsuarioTemPermissao(Auth::getUser())){
                exit(403);
            }
            return view('relatorios.relatorio_projeto.relatorio', compact('repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'relatório';
            $data['acao'] = 'gerar relatório';
            LogMessage::create_log($data);
            return redirect()->back();
        }

    }
}
