<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Documentacao extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'coddocumentacao';
    protected $table = 'documentacoes';
    protected $fillable = [
        'nome',
        'descricao',
        'link',
        'publico',
        'codmodelodiagramatico',
        'codmodelo',
        'codmodelodocumentacao',
        'codprojeto',
        'codrepositorio',
        'codusuario',
        'tipo',
        'visto'
    ];

    public static function validacao()
    {
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255',
            'link' => 'required|max:255'
        ];
    }

    public static function titulos()
    {
        return [
            'Usuário',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição',
            'Link da Documentação'
        ];
    }

    public static function atributos()
    {
        return [

            'nome',
            'descricao',
            'link'
        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 5; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 3; $indice++) {
            if ($indice < 2) {

                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->campo = $campos[$indice];
            $dados[$indice]->atributo = $atributos[$indice];

        }
        return $dados;
    }

    public function tipo()
    {
        switch ($this->tipo) {
            case 1:
                return 'video';
            case 2:
                return 'documento';
            case 3:
                return 'imagem';
            case 6:
                return 'texto_modelo';
            case 7:
                return 'texto_diagrama';
            default:
                return 'texto';
        }
    }

    public function GetTipo($tipo)
    {
        switch ($tipo) {
            case 1:
                return 'video';
            case 2:
                return 'documento';
            case 3:
                return 'imagem';
            case 6:
                return 'texto_modelo';
            case 7:
                return 'texto_diagrama';
            default:
                return 'texto';
        }
    }

    public function getIdVideoYoutube()
    {
        return explode('https://www.youtube.com/watch?v=', $this->link)[1];
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public function diagrama()
    {
        return $this->hasOne(RepresentacaoDiagramatica::class, 'codmodelodiagramatico', 'codmodelodiagramatico');
    }

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'coddocumentacao', 'codmodelodocumentacao');
    }

    public function modelo()
    {
        return $this->hasOne(Modelo::class, 'codmodelo', 'codmodelo');
    }

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
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
