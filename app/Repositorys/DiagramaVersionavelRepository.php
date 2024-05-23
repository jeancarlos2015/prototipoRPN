<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/10/2018
 * Time: 22:47
 */

namespace App\Http\Repositorys;


use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\RepresentacaoDiagramaticaVersionavel;
use App\Http\Util\LogMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiagramaVersionavelRepository
{
    public static function create($coddiagramaversionavel)
    {
        $codigo = null;
        try {
            DB::beginTransaction();
            $modelo_versionavel = RepresentacaoDiagramaticaVersionavel::findOrFail($coddiagramaversionavel);
            $diagrama = $modelo_versionavel->diagrama;
            if(!$diagrama->modelo->UsuarioTemPermissao(Auth::getUser())){
                exit(403);
            }
            if (!empty($diagrama)){
                $diagrama->xml_modelo = $modelo_versionavel->xml_modelo;
                $diagrama->svg_modelo = $modelo_versionavel->svg_modelo ? $modelo_versionavel->svg_modelo : $modelo_versionavel->svgPadrao();
                $diagrama->update();
            }else{
                $dado = [
                    'codmodelodiagramatico' => $modelo_versionavel->codmodelodiagramatico,
                    'nome' => $modelo_versionavel->nome,
                    'descricao' => $modelo_versionavel->descricao,
                    'xml_modelo' => $modelo_versionavel->xml_modelo,
                    'svg_modelo' => $modelo_versionavel->svg_modelo,
                    'codprojeto' => $modelo_versionavel->codprojeto,
                    'codrepositorio' => $modelo_versionavel->codrepositorio,
                    'codusuario' => $modelo_versionavel->codusuario,
                    'codmodelo' => $modelo_versionavel->codmodelo,
                    'created_at' => $modelo_versionavel->created_at,
                    'publico' => $modelo_versionavel->publico,
                    'tipo' => $modelo_versionavel->tipo
                ];
                RepresentacaoDiagramatica::create($dado);
            }
            limpar_cache();
            DB::commit();
            return flash('Operação feita com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }
    }
}
