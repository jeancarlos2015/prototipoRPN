<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/10/2018
 * Time: 23:12
 */

namespace App\Http\Viwers;


use App\Http\Models\Documentacao;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Util\LogMessage;

class DocumentacaoViewer
{
    public $documentacoes;
    public $titulos;
    public $tipo;
    public $campos;
    public $dados = [];
    public $documentacao;

    public function __construct($codigo = -1)
    {
        try {
            $this->documentacoes = DocumentacaoRepository::listar();
            $this->titulos = Documentacao::titulos();
            $this->campos = Documentacao::campos();
            $this->tipo = 'documentacao';
            if ($codigo !== -1) {
                $this->documentacao = Documentacao::findOrFail($codigo);
                $this->dados = Documentacao::dados();
                $this->dados[0]->valor = $this->documentacao->nome;
                $this->dados[1]->valor = $this->documentacao->descricao;
                $this->dados[2]->valor = $this->documentacao->link;
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'DocumentacaoViewer';
            $data['acao'] = '__construct';
            LogMessage::create_log($data);
        }
    }


}
