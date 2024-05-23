<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 04/11/2018
 * Time: 02:05
 */

namespace App\Http\Models;


use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Session extends Model
{
    protected $table = 'sessions';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'codusuario','user_id');
    }

    public function scopeActivity($query, $limit = 10)
    {
        $lastActivity = strtotime(Carbon::now()->subMinutes($limit));
        return $query->where('last_activity', '>=', $lastActivity);
    }

    public function scopeGuests(Builder $query)
    {
        return $query->whereNull('user_id');
    }

    public function scopeRegistered(Builder $query)
    {
        return $query->whereNotNull('user_id')->with('user.codusuario');
    }

    public function scopeUpdateCurrent(Builder $query)
    {
        $user = Sentinel::check();

        return $query->where('id', Session::getId())->update([
            'user_id' => $user ? $user->codusuario : null
        ]);
    }

}