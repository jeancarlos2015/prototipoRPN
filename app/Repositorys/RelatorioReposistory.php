<?php
/**
 * Created by PhpStorm.
 * User: secre
 * Date: 25/10/2018
 * Time: 18:35
 */

namespace App\Http\Repositorys;


class RelatorioReposistory
{
    public static function meses($repositorios){
        $mes_inicial = collect($repositorios)->min('created_at');
        $mes_final = collect($repositorios)->max('created_at');
        $meses = [];
        array_push($meses, $mes_inicial);
        for($mes = $mes_inicial; $mes<$mes_final; $mes->addMonths(1)){
            array_push($meses, $mes);
        }
        return $meses;
    }
}