<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 15/09/2018
 * Time: 22:37
 */

namespace App\Http\Fachadas;


use App\Http\Util\LogMessage;
use Illuminate\Http\Request;

abstract class  FachadaAbstract
{

    protected function create_log($data)
    {
        return LogMessage::create_log($data);
    }

    protected function validar($data)
    {
        return LogMessage::validar($data);
    }


    protected function exists_errors($data)
    {
        return LogMessage::exists_errors($data);
    }

    protected function get_errors($data)
    {
        return LogMessage::get_errors($data);
    }

    abstract public function selecionar($dado);

    abstract public function desvincular($codigo);

    abstract public function vincular($request);

    abstract public function listar($request);

    abstract public function gravar(Request $request);

    abstract public function get(Request $request);

    abstract public function edicao_modelo_diagramatico($request);

    abstract public function painel($request = null);

    abstract public function traduzir($locale, $pagina);

    abstract public function index($codigo = 0, $codigo2 = 0);

    abstract public function download($codmodelodiagramatico, $tipo);

    abstract public function create($request = null, $codigo = 0);

    abstract public function store(Request $request);

    abstract public function update(Request $request, $codigo);

    abstract public function show($codigo = null);

    abstract public function edit($codigo = null);

    abstract public function destroy($codigo = 0);

    abstract public function all();

    abstract public function escolhe_modelo(Request $request);


    abstract public function delete(Request $request);

    abstract public function delete_repository($repositorio_atual);

    abstract public function edit_repository(Request $request = null);

    abstract public function criar_base(Request $request);

    abstract public function selecionar_repositorio($repositorio_atual, $default_branch);


    abstract public function visualizar_modelo_publico($codmodelo);

    abstract public function modelos_publicos();

    abstract public function upload(Request $request);

    abstract public function alterar(Request $request, $codigo);

    public static function make($tipo)
    {
        switch ($tipo) {
            case 'RepositorioController':
                return new FachadaRepositorio();
            case 'UserController':
                return new FachadaUsuario();
            case 'UsuarioSemRepositorioController':
                return new FachadaUsuarioSemRepositorio();
            case 'UsuarioRepositorioController':
                return new FachadaUsuarioRepositorio();
            case 'RegraController':
                return new FachadaRegra();
            case 'ProjetoController':
                return new FachadaProjeto();
            case 'PadraoRecomendacaoBinarioController':
                return new FachadaPadraoRecomendacaoBinario();
            case 'PadraoRecomendacaoConjuntoController':
                return new FachadaPadraoRecomendacaoConjunto();
            case 'ObjetoFluxoController':
                return new FachadaObjetoFluxo();
            case 'RepresentacaoDiagramaticaController':
                return new FachadaRepresentacaoDiagramatica();
            case 'RepresentacaoDeclarativaController':
                return new FachadaRepresentacaoDeclarativa();
            case 'ModeloController':
                return new FachadaModelo();
            case 'LogController':
                return new FachadaLog();
            case 'DocumentacaoController':
                return new FachadaDocumentacao();
            case 'PainelPrincipalController':
                return new FachadaPainelPrincipal();
            case 'RepresentacaoDiagramaticaPublicaController':
                return new FachadaRepresentacaoDiagramaticaPublica();
            case 'RepresentacaoModelagemController':
                return new FachadaRepresentacaoModelagem();
            case 'UsuarioProjetoController':
                return new FachadaUsuarioProjeto();
            case 'UsuarioModeloController':
                return new FachadaUsuarioModelo();
            case 'VinculoUsuarioRepositorioController':
                return new FachadaVinculoUsuarioRepositorio();
            case 'SolicitacaoController':
                return new FachadaSolicitacao();
            case 'RelatorioPDFController':
                return new FachadaRelatorioPDF();
            case 'RelatoriosGraficosController':
                return new FachadaRelatoriosGraficos();
            case 'TarefaController':
                return new FachadaTarefa();
            case 'DocumentoPublicoController':
                return new FachadaDocumentoPublico();
            case 'MensagemController':
                return new FachadaMensagem();
            case 'RepresentacaoDiagramaticaVersionavelController':
                return new FachadaDiagramaVersionavel();
            case 'ConfiguracaoAmbienteModelagemController':
                return new FachadaConfiguracaoAmbienteModelagem();
            case 'UsuariosOnlineController':
                return new FachadaUsuariosOnline();
            case 'ComentarioDiagramaController':
                return new FachadaComentarioDiagrama();
            case 'ModeloPublicoController':
                return new FachadaModeloPublico();
            case 'PortalUsuarioController':
                return new FachadaPortalUsuario();
            case 'UploadController':
                return new FachadaUpload();
            case 'ChatController':
                return new FachadaChat();
            case 'DocumentacaoTextualModeloController':
                return new FachadaDocumentacaoTextualModelo();
            case 'DocumentacaoTextualDiagramaController':
                return new FachadaDocumentacaoTextualDiagrama();
            case 'ValidadorDiagramaController':
                return new FachadaValidadorDiagrama();
            case 'ValidadorModeloController':
                return new FachadaValidadorModelo();
            case 'PortalDocumentoPublicoController':
                return new FachadaPortalDocumentoPublico();
            case 'PortalModeloPublicoController':
                return new FachadaRepresentacaoDiagramaticaPublica();
            case 'DownloadDiagramaController':
                return new FachadaDownloadDiagrama();
            case 'TraducaoPaginaController':
                return new FachadaTraducaoPagina();
            case 'RepresentacaoDiagramaticaAutomaticaController':
                return new FachadaRepresentacaoDiagramaticaAutomatico();
            case 'AvisoController':
                return new FachadaAviso();
            case 'OperacoesDiagramaController':
                return new FachadaOperacoesDiagrama();
            case 'OperacoesModeloController':
                return new FachadaOperacoesModelo();
            case 'OperacoesProjetoController':
                return new FachadaOperacoesProjeto();
            case 'OperacoesRepositorioController':
                return new FachadaOperacoesRepositorio();
            default:
                return null;
        }
    }
}
