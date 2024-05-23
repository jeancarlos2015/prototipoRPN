<?php
/**
 * Created by PhpStorm.
 * User: secre
 * Date: 19/10/2018
 * Time: 13:27
 */

namespace App\Http\Viwers;


use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Util\Dado;
use App\Http\Util\LogMessage;

class GitViwer
{
    public $funcionalidades;
    public $rotas;
    public $dados;
    public $branch_atual = 'Em construção';

    public function __construct($codmodelo = -1)
    {
        try {
            $this->funcionalidades = [];
            $this->rotas = GitSistemaRepository::rotas();
            $this->dados = GitSistemaRepository::funcionalidades();
            for ($indice = 0; $indice < 5; $indice++) {
                $this->funcionalidades[$indice] = new Dado();
                $this->funcionalidades[$indice]->titulo = $this->dados [$indice];
                $this->funcionalidades[$indice]->rota = $this->dados [$indice];
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'GitViwer';
            $data['acao'] = '__construct($codmodelo = -1)';
            LogMessage::create_log($data);
        }
    }
}
