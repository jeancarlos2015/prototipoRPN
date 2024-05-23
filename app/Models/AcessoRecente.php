<?php

namespace App\Http\Models;

use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\Modelo;
use App\Http\Models\Mensagem;
use App\Http\Models\Projeto;
use App\Http\Models\Repositorio;
use App\Http\Models\Documentacao;
use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;
class AcessoRecente extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codacessorecente';
    protected $table = 'acessosrecentes';
    protected $fillable = [
        'codusuario',
        'codmodelodiagramatico',
        'codmodelo',
        'codprojeto',
        'codrepositorio',
        'coddocumentacao',
        'codconfiguracaoambientemodelagem',
        'codmensagem',
        'descricao',
        'operacao'
    ];


    public function Usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public function Configuracao(){
        return $this->hasOne(ConfiguracaoAmbienteModelagem::class,'codconfiguracaoambientemodelagem','codconfiguracaoambientemodelagem');
    }


    public function Diagrama()
    {
        return $this->hasOne(RepresentacaoDiagramatica::class, 'codmodelodiagramatico', 'codmodelodiagramatico');
    }
    public function Projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }
    public function Repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }
    public function Mensagem()
    {
        return $this->hasOne(Mensagem::class, 'codmensagem', 'codmensagem');
    }
    public function EUmaEdicaoDiagrama(){
        return $this->operacao=='edicao_diagrama';
    }

    public function EUmaVisualizacaoDiagrama(){
        return $this->operacao=='visualizacao_diagrama';
    }

    public function EUmaVisualizacaoProcesso(){
        return $this->operacao=='visualizacao_projeto';
    }

    public function EUmaAlteracaoRepositorio(){
        return $this->operacao=='alteracao_repositorio';
    }
    public function EConfiguracao(){
        return !empty($this->Configuracao);
    }

    public function Documentacao()
    {
        return $this->hasOne(Documentacao::class, 'coddocumentacao', 'coddocumentacao');
    }
    public function Modelo()
    {
        return $this->hasOne(Modelo::class, 'codmodelo', 'codmodelo');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function () { // before delete() method call this
            limpar_cache();
        });

        static::created(function () {
            limpar_cache();

        });


    }
}
