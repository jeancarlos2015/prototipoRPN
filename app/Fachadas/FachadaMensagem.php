<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 13/07/2019
 * Time: 14:24
 */

namespace App\Http\Fachadas;


use App\Http\Models\Mensagem;
use App\Http\Repositorys\MensagemRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FachadaMensagem extends FachadaConcreta
{

    public function index($codusuario = null, $request2 = null)
    {
        $tipo = 'mensagem';
        $mensagens = MensagemRepository::listarMensagens();
        $titulos = Mensagem::titulos();
        return view('controle_mensagens.index', compact('tipo', 'mensagens', 'titulos'));
    }

    public function show($codigo = null)
    {
        MensagemRepository::atualizarMensagem($codigo);
        return view('controle_mensagens.show', compact('mensagem'));
    }

    public function create($codusuario = null, $codprojeto1 = 0)
    {
        $usuarios = User::all();
        return view('controle_mensagens.create', compact('codusuario', 'usuarios'));

    }

    public function edit($codigo = null)
    {
        $mensagem = Mensagem::findOrFail($codigo);
        $usuarios = User::all();
        return view('controle_mensagens.edit', compact('mensagem', 'usuarios'));
    }

    public function update(Request $request, $codmensagem)
    {
        $resultado = MensagemRepository::atualizar($request, $codmensagem);
        return \Response::json($resultado);
    }

    private function validarMensagem(Request $request)
    {
        $erros = \Validator::make($request->all(), Mensagem::validacao());
        if ($erros->fails()) {
            return redirect()->route('controle_mensagens_create', [
                'codusuario' => Auth::user()->codusuario,
            ])
                ->withErrors($erros)
                ->withInput();
        }

    }

    public function store(Request $request)
    {
        //$this->validarMensagem($request);
        $resultado =  MensagemRepository::salvar($request);
        return \Response::json($resultado);
    }

}
