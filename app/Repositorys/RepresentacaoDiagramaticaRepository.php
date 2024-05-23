<?php

/**
 * Created by PhpStorm.
 * User: jean
 * Date: 18/09/2018
 * Time: 21:13
 */

namespace App\Http\Repositorys;


use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\RepresentacaoDiagramaticaVersionavel;
use App\Http\Util\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Nexmo\Call\Collection;
use phpDocumentor\Reflection\Types\Self_;
use function Couchbase\defaultDecoder;
use function GuzzleHttp\Promise\all;

class RepresentacaoDiagramaticaRepository
{
    public function __construct()
    {
        $this->setModel(RepresentacaoDiagramatica::class);
    }

    public static function criarDiagramaAutomatico(Request $request)
    {
        $diagrama = null;
        try {
            DB::beginTransaction();
            if (Auth::getUser()->usuario_esta_no_repositorio()) {
                if (!isset($request->codmodelo)) {

                    $request->request->add([
                        'codrepositorio' => Auth::getUser()->codrepositorio,
                        'codusuario' => Auth::getUser()->codusuario
                    ]);
                    $projeto = ProjetoRepository::incluir($request);
                    $dado = [
                        'nome' => $projeto->nome,
                        'descricao' => $request->texto,
                        'publico' => $projeto->publico,
                        'codusuario' => $projeto->codusuario,
                        'codrepositorio' => Auth::getUser()->codrepositorio,
                        'codprojeto' => $projeto->codprojeto,
                        'codmodelo' => !empty($request->codmodelo) ? $request->codmodelo : null
                    ];

                    $Modelmodelo = ModeloRepository::incluir($dado);

                    $modelo = $Modelmodelo->getModelo();
                } else {
                    $modelo = Modelo::FindOrFail($request->codmodelo);
                }

                $request->request->add(
                    [
                        'codmodelo' => $modelo->codmodelo,
                        'publico' => $modelo->publico,
                        'validado' => false,
                        'descricao' => $request->texto
                    ]
                );
                $diagrama = RepresentacaoDiagramaticaRepository::incluir($request);
            }

            DB::commit();
            return $diagrama;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }
    }

    public static function listar()
    {
        return Cache::remember('listar_modelos_diagramaticos1' . Auth::getUser()->codusuario, 2000, function () {
            if (Auth::user()->papel() === 'ADMINISTRADOR') {
                return collect(RepresentacaoDiagramatica::get());
            }
            $representacoes = collect(RepresentacaoDiagramatica::where('codusuario', '=', Auth::user()->codusuario)
                ->get());
            return $representacoes->concat(self::listar_modelos_publicos());
        });
    }

    public static function download($codmodelodiagramatico, $tipo)
    {
        if ($tipo == 'versionavel')
            $modelo = RepresentacaoDiagramaticaVersionavel::findOrFail($codmodelodiagramatico);
        else
            $modelo = RepresentacaoDiagramatica::findOrFail($codmodelodiagramatico);
        return \Response($modelo->xml_modelo, 200, ['content-type' => 'application/xml']);
    }
    public static function listar_modelos_publicosFiltro($filtro)
    {
        $selecionadas = [];
        $sorted = [];
        try {
            $representacoes = RepresentacaoDiagramatica::where('nome', 'like', '%' . $filtro . '%')
                ->orWhere('descricao', 'like', '%' . $filtro . '%')
                ->orWhere('xml_modelo', 'like', '%' . $filtro . '%')
                ->get();
            foreach ($representacoes as $representacao) {
                if ($representacao->modelo->publico && $representacao->existeSVG()) {
                    array_push($selecionadas, $representacao);
                }
            }
            $sorted = collect($selecionadas)->sortByDesc('updated_at');
        } catch (\Exception $ex) {
            return $selecionadas;
        }
        return $sorted;
    }

    public static function listar_modelos_publicos()
    {
        $selecionadas = [];
        $sorted = [];
        try {
            $representacoes = RepresentacaoDiagramatica::all();
            foreach ($representacoes as $representacao) {
                if ($representacao->modelo->publico && $representacao->existeSVG()) {
                    array_push($selecionadas, $representacao);
                }
            }
            $sorted = collect($selecionadas)->sortByDesc('updated_at');
        } catch (\Exception $ex) {
            return $selecionadas;
        }
        return $sorted;
    }

    public static function listar_modelo_por_projeto_organizacao($codrepositorio, $codprojeto, $codusuario)
    {
        return Cache::remember('listar_modelos_diagramaticos' . Auth::getUser()->codusuario, 2000, function () use ($codrepositorio, $codprojeto) {
            return collect(RepresentacaoDiagramatica::where('codrepositorio', '=', $codrepositorio)
                ->where('codprojeto', '=', $codprojeto)
                ->orderBy('created_at', 'DESC')
                ->get());
        });
    }

    public static function atualizarDescricao(Request $request, $codmodelodiagramatico)
    {
        $diagrama = RepresentacaoDiagramatica::findOrFail($codmodelodiagramatico);
        try {
            DB::beginTransaction();

            if (!empty($request->descricao)) {
                $diagrama->descricao = $request->descricao;
            }
            if (!$diagrama->repositorio->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
            $diagrama->update();
            limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'FachadaModelo';
            $data['acao'] = 'update(Request $request, $codigo)';
            LogMessage::create_log($data);
        }

        return $diagrama;
    }
    public static function atualizar(Request $request, $codmodelo)
    {
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i:s');
            $request->request->add(['updated_at' => $date]);
            $diagrama = RepresentacaoDiagramatica::findOrFail($codmodelo);

            if (!$diagrama->modelo->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
            if (!$diagrama->existeConfiguracaoAmbienteModelagem()) {
                ConfiguracaoAmbienteRepository::criarConfiguracaoLimitada($diagrama);
            }
            if (empty($request->file('file'))) {
                $xml_modelo = str_replace($diagrama->nome, $request->nome, $diagrama->xml_modelo);
            } else {
                $xml_modelo = str_replace($diagrama->nome, $request->nome, $request->file('file')->get());
            }
            $diagrama->xml_modelo = $xml_modelo;
            $diagrama->update($request->all());
            limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            LogMessage::create_log($data);
        }

        return $diagrama;
    }


    public function limpar_cache()
    {
        \Artisan::call("Config:clear");
        \Artisan::call("Cache:clear");
    }

    public static function buscar($nome)
    {
        return self::listar()->where('nome', '=', $nome)->first();
    }

    public static function incluir(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!RepresentacaoDiagramaticaRepository::existe($request->nome, $request->codmodelo)) {
                $modelo = Modelo::findOrFail($request->codmodelo);
                if (!$modelo->UsuarioTemPermissao(Auth::getUser())) {
                    exit(403);
                }
                if (empty($request->file('file'))) {
                    $xml = RepresentacaoDiagramatica::get_modelo_default($request->nome);
                } else {
                    $xml = $request->file('file')->get();
                }
                $request->request->add([
                    'xml_modelo' => $xml,
                    'codprojeto' => $modelo->codprojeto,
                    'codrepositorio' => $modelo->codrepositorio,
                    'codusuario' => Auth::user()->codusuario
                ]);
                date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d H:i:s');
                $request->request->add(['created_at' => $date]);
                $value = RepresentacaoDiagramatica::create($request->all());
                DB::commit();
                limpar_cache();
                return $value;
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            LogMessage::create_log($data);
        }

        return null;
    }


    public static function excluir($codmodelodiagramatico)
    {
        $value = null;
        try {
            DB::beginTransaction();
            $doc = RepresentacaoDiagramatica::findOrFail($codmodelodiagramatico);
            if (!$doc->modelo->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
            $value = $doc->delete();
            DB::commit();
            limpar_cache();
            return flash('Registro excluido com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }
    }


    public static function existe($nome_do_modelo, $codmodelo)
    {
        $modelos = self::listar()->where(['codmodelo', $codmodelo], ['nome', $nome_do_modelo]);
        return $modelos->count() > 0;
    }

    public static function get_codigos()
    {
        return Cache::remember('listar_codigos_modelos' . Auth::getUser()->codusuario, 2000, function () {
            return DB::table('modelos_diagramaticos')
                ->select('codmodelodiagramatico')
                ->get();
        });
    }

    public static function gravar_log(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s');
        $codmodelo = $request->codmodelodiagramatico;
        $xml = $request->strXml;
        $modelo = RepresentacaoDiagramatica::findOrFail($codmodelo);

        limpar_cache();
        return $request;
    }

    public static function gravar(Request $request)
    {
        try {
            DB::beginTransaction();
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i:s');
            $codmodelo = $request->codmodelodiagramatico;
            if (!empty($request->strXml)) {
                $xml = $request->strXml;
            }
            if (!empty($request->xml_modelo_comentado)) {
                $xml_modelo_comentado = $request->xml_modelo_comentado;
            }
            if (!empty($request->strSvg)) {
                $svg_modelo = $request->strSvg;
            }
            $modelo = RepresentacaoDiagramatica::findOrFail($codmodelo);
            if (!$modelo->UsuarioTemPermissao(Auth::getUser())) {
                exit(403);
            }
            $modelo->updated_at = $date;
            if (!empty($request->strXml)) {
                $modelo->xml_modelo = $xml . "\n";
            }
            if (!empty($request->xml_modelo_comentado)) {
                $modelo->xml_modelo_comentado = $xml_modelo_comentado . "\n";
            }
            if (!empty($request->strSvg)) {
                $modelo->svg_modelo = $svg_modelo . "\n";
            }
            $modelo->update();

            limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            LogMessage::create_log($data);
        }
        return $request;
    }

    public static function visualizar_modelo($codmodelo)
    {
        $diagrama = RepresentacaoDiagramatica::findOrFail($codmodelo);
        return $diagrama;
    }


    public static function transferir($diagrama, $modelo)
    {
        try {

            DB::beginTransaction();
            $diagrama->codrepositorio = $modelo->codrepositorio;
            $diagrama->codprojeto = $modelo->codprojeto;
            $diagrama->codmodelo = $modelo->codmodelo;
            $diagrama->transferido = true;
            $diagrama->update();
            limpar_cache_geral();
            DB::commit();
            return flash('Operação feita com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            return LogMessage::create_log($data);
        }
    }
}
