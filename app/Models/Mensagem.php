<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codmensagem';
    protected $table = 'mensagens';
    protected $fillable = [
        'codusuario',
        'codusuariodestinatario',
        'codrepositorio',
        'codprojeto',
        'codmodelo',
        'assunto',
        'texto',
        'visto',
        'tipo'
    ];

    public function destinatario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuariodestinatario');
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
        return $this->hasOne(Projeto::class, 'codmodelo', 'codmodelo');
    }

    public function responsavel()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }



    public static function campos()
    {
        return [
            'Assunto',
            'Texto'
        ];
    }

    public static function atributos_dos_campos()
    {
        return [
            'assunto',
            'texto',
            'codrepositorio',
        ];

    }

    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }

    public static function validacao()
    {
        return [
            'assunto' => 'required',
            'texto' => 'required'
        ];
    }

    public static function titulos()
    {
        return [
            'Mensagens',
            'Ações'
        ];
    }

}
