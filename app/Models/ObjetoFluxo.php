<?php

namespace App\http\Models;

use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Repositorio;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;

class ObjetoFluxo extends Model
{

    protected $connection = 'pgsql';
    protected $primaryKey = 'codobjetofluxo';
    protected $table = 'objetos_fluxos';
    protected $fillable = [

        'codrepositorio',
        'codusuario',
        'codprojeto',
        'codmodelodeclarativo',
        'codmodelo',
        'codregra',
        'nome',
        'descricao',
        'tipo',
        'publico'
    ];

    public static function tipos()
    {
        return [
            'TAREFA',
            'EVENTO DE ÍNICIO',
            'EVENTO DE FIM',
            'EVENTO INTERMEDIÁRIO'
        ];
    }

    public static function validacao()
    {
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255'
        ];
    }

    public static function titulos_da_tabela()
    {
        return [
            'Objetos De Fluxo',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição'
        ];
    }

    public static function atributos_dos_campos()
    {
        return [
            'nome',
            'descricao'
        ];

    }
    public function email(){
        return $this->usuario->email;
    }
    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }

    //Instancia todas as posições de memória que serão exibidas no título
    public static function dados_exibidos_no_titulo()
    {
        $dado = array();
        for ($indice = 0; $indice < 2; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem

    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos_dos_campos();
        $dados = self::dados_exibidos_no_titulo();
        $types = self::types();
        $titulos = self::titulos_da_tabela();
        for ($indice = 0; $indice < 2; $indice++) {
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
                $dados[$indice]->tipo = $types[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public function modelo()
    {
        return $this->hasOne(RepresentacaoDeclarativa::class, 'codmodelodeclarativo', 'codmodelodeclarativo');
    }

    public function regra()
    {
        return $this->hasOne(Regra::class, 'codregra', 'codregra');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($objeto) { // before delete() method call this
            if (!empty($objeto->regra)){
                $objeto->regra()->delete();
            }
            limpar_cache();
        });
        static::created(function () {
            limpar_cache();

        });

    }


}
