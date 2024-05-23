<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 04:32
 */

namespace App\Http\Fachadas;


use App\Http\Models\Documentacao;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Viwers\DocumentacaoViewer;
use Illuminate\Http\Request;

class FachadaChat extends FachadaConcreta
{

    public function index($codigo1 = 0, $codigo2 = 0)
    {
        return view('chat.chat');
    }
}
