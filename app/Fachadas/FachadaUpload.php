<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 04:32
 */

namespace App\Http\Fachadas;


use App\Http\Models\Arquivo;
use App\Http\Models\Documentacao;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Viwers\DocumentacaoViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FachadaUpload extends FachadaConcreta
{
    public function upload(Request $request)
    {
        $uploadedFile = $request->file('file');
        $filename = time() . $uploadedFile->getClientOriginalName();

        if (empty($uploadedFile)) {
            abort(400, 'Nenhum arquivo foi enviado.');
        }

        if (!Storage::disk('local')->put($filename, $uploadedFile))
            return false;
        if (!empty($request->codmodelodiagramatico)) {
            $dado['link'] = $filename;
            $dado['codmodelodiagramatico'] = $request->codmodelodiagramatico;
            $diagrama = RepresentacaoDiagramatica::FindOrFail($request->codmodelodiagramatico);
            $dado['codmodelo'] = $diagrama->codmodelo;
            $dado['codmodelodiagramatico'] = $diagrama->codmodelodiagramatico;
            $dado['codprojeto'] = $diagrama->codprojeto;
            $dado['codrepositorio'] = $diagrama->codrepositorio;
            $dado['tipo'] = explode('.', $filename)[1];

            if (!empty($diagrama->documentacao))
                $dado['coddocumentacao'] = $diagrama->documentacao->coddocumentacao;

            Arquivo::create($dado);
        }

        return $filename;
    }
}
