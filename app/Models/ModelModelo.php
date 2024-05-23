<?php


namespace App\Http\Models;


class ModelModelo
{
    private $projeto;
    private $modelo;
    private $dados;
    public $incluiu = false;
    public $atualizou = false;
    public function setProjeto($projeto){$this->projeto = $projeto;}
    public function setModelo($modelo){$this->modelo = $modelo;}
    public function setDados($dados){$this->dados = $dados;}

    public function getDados(){ return $this->dados;}
    public function getProjeto(){ return $this->projeto;}
    public function getModelo(){return $this->modelo;}

    public function codmodelo(){
        return $this->modelo->codmodelo;
    }

    public function codprojeto(){
        return $this->projeto->codprojeto;
    }

}