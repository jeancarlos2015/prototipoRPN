<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 27/09/2018
 * Time: 00:23
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    protected $connection = 'pgsql';


}