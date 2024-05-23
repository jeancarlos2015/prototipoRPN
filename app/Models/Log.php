<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Log
 *
 * @property int $codlog
 * @property string $nome
 * @property string $descricao
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCodlog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Log extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codlog';
    protected $table = 'logs';
    protected $fillable = [
        'nome',
        'descricao',
        'codusuario',
        'created_at',
        'acao',
        'pagina',
        'visto'
    ];


    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public function viu(){
        $this->visto = 1;
        $this->update();
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

        static::updated(function (){
            limpar_cache();
        });


    }

}
