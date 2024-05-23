<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 24/10/2018
 * Time: 02:09
 */

namespace App\Http\Fachadas;


use App\Http\Repositorys\RelatorioReposistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FachadaRelatoriosGraficos extends FachadaConcreta
{
    public function relatorio_grafico_linha()
    {
        $repositorios = Auth::user()->repositorios();
        $cores = [
            "#55ce63",
            "#dc143c",
            "#119efb",
            "#0000cd",
            "#ffff00",
            "#006400",
            "#a0522d",
            "#2f4f4f",
            "#ff1493",
            "#889efb",
            "#999efb",
            "#008efb",
            "#007efb",
            "#006efb",
            "#005efb",
            "#004efb",
            "#003efb",
            "#002efb",
            "#001efb",
            "#000efb",
            "#009efb",
            "#009ffb",
            "#009dfb",
        ];

        $meses = RelatorioReposistory::meses($repositorios);
        return view('relatorios.relatorios_graficos.relatorio', compact('repositorios', 'cores', 'meses'));
    }

    public function index($id_realtorio = 0, $codigorepositorio = 0)
    {
        switch ($id_realtorio) {
            case 0:
                return $this->relatorio_grafico_linha();
            default:
                return redirect()->back();
        }
    }
}