<?php


namespace App\Http\Repositorys;


use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Util\LogMessage;

class ComentarioDiagramaRepository
{
   public static function destroy($codigo){
        $diagrama = RepresentacaoDiagramatica::FindOrFail($codigo);
        $diagrama->xml_modelo_comentado = null;
        try {
            \DB::beginTransaction();
            $diagrama->update();
            \DB::commit();
            return flash('Registro excluido com sucesso!');
        }catch (\Exception $ex){
            \DB::rollback();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Comentario';
            $data['acao'] = 'destroy(Request $request, $codigo)';
            return LogMessage::create_log($data);
        }
    }
}
