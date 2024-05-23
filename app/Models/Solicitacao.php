<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Repositorio;

class Solicitacao extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codsolicitacao';
    protected $table = 'solicitacoes';
    protected $fillable = [
        'codusuario_solicitante',
        'codusuario_solicitado',
        'codrepositorio',
        'mensagem'
    ];

    public function solicitante()
    {
        try {

            return $this->hasOne(User::class, 'codusuario', 'codusuario_solicitante');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function solicitado()
    {
        try {
            return $this->hasOne(User::class, 'codusuario', 'codusuario_solicitado');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function repositorio()
    {
        try {
            return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

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
