<?php
/**
 * Created by PhpStorm.
 * User: secre
 * Date: 19/10/2018
 * Time: 13:15
 */

namespace App\Http\Repositorys;


use App\http\Models\ObjetoFluxo;
use App\http\Models\Regra;
use Illuminate\Support\Facades\DB;

class PadraoRecomendacaoRepository
{
    public static function salvar($dado)
    {
        try {
            DB::beginTransaction();
            if (!empty($dado['id_objetos_fluxos1']) && !empty($dado['id_objetos_fluxos2'])) {
                $id_objetos_fluxos1 = $dado['id_objetos_fluxos1'];
                $id_objetos_fluxos2 = $dado['id_objetos_fluxos2'];
                $codrepositorio = $dado['codrepositorio'];
                $codmodelodeclarativo = $dado['codmodelodeclarativo'];
                $codprojeto = $dado['codprojeto'];
                $codusaurio = $dado['codusuario'];
                $codmodelo = $dado['codmodelo'];
                $id_relacionamento = $dado['id_relacionamento'];
                $publico = $dado['publico'];
                $nome = $dado['nome'];
                $dado = [
                    'codrepositorio' => $codrepositorio,
                    'codusuario' => $codusaurio,
                    'codprojeto' => $codprojeto,
                    'codmodelodeclarativo' => $codmodelodeclarativo,
                    'codmodelo' => $codmodelo,
                    'codoutraregra' => 0,
                    'nome' => $nome,
                    'tipo' => Regra::PADROES[$id_relacionamento],
                    'publico' => $publico,
                    'descricao' => Regra::PADROES[$id_relacionamento],
                    'relacionamento' => $id_relacionamento
                ];
                $regra = RegraRepository::inclui_se_existe($dado);
                RegraRepository::limpar_cache();
                ObjetoFluxoRepository::incluir_se_existe($dado);
                for ($id_objeto = 0; $id_objeto < count($id_objetos_fluxos1); $id_objeto++) {
                    if (!empty($regra)) {
                        $objetofluxo1 = ObjetoFluxo::findOrFail($id_objetos_fluxos1[$id_objeto]);
                        $objetofluxo2 = ObjetoFluxo::findOrFail($id_objetos_fluxos2[$id_objeto]);
                        $objetofluxo1->codregra = $regra->codregra;
                        $objetofluxo2->codregra = $regra->codregra;
                        $objetofluxo1->update();
                        $objetofluxo2->update();
                    }
                }

            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }


    }


}
