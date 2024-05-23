<?php

use Illuminate\Support\Facades\Route;

use App\Http\Models\Documentacao;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Repositorys\RepresentacaoDiagramaticaRepository;
use Illuminate\Http\Request;

/////////////////////Teste de página////////////////////////
Route::get('api/publico/modelos/{filtro}', function ($filtro) {
    $modelos = RepresentacaoDiagramaticaRepository::listar_modelos_publicosFiltro($filtro);
    return \Response::json(array_values($modelos->toArray()));
})->name('api_modelos_publicos')
->middleware('cors');

Route::get('publico/paginas/tema2', function () {
    return view('paginas.tema2');
})->name('tema1');

Route::get('publico/paginas/tema', function () {
    return view('paginas.tema');
})->name('tema1');
Route::get('publico/paginas/tema3', function () {
    return view('paginas.tema3');
})->name('tema1');
/////////////////////////////////////////////////////////////
Route::get('/', function () {
    return view('inicio');
})->name('/');

Route::get('/home', function () {
    return view('inicio');
})->name('/home');

Route::get('/logout', function () {
    return view('inicio');
})->name('logout');

Route::view('admin/painel', 'inicio');

Route::get('email/index1', function () {
    return view('mails.email_cadastro_de_usuario');
});
Route::get('email/index2', function () {
    return view('mails.email_desvinculacao_de_usuario');
});
Route::get('email/index3', function () {
    return view('mails.email_vinculacao_de_usuario');
});


Route::get('welcome/{locale}/{pagina}', function ($locale, $pagina) {
    return \App\Http\Fachadas\FachadaAbstract::make('TraducaoPaginaController')->traduzir($locale, $pagina);
})->name('traduzir');

Route::get('publico/modelos', function () {
    return \App\Http\Fachadas\FachadaAbstract::make('RepresentacaoDiagramaticaPublicaController')->index();
})->name('modelos_publicos');

Route::get('publico/documentos', function () {
    return \App\Http\Fachadas\FachadaAbstract::make('DocumentoPublicoController')->index();
})->name('documentos_publicos');

Route::get('publico/modelos/{codmodelo}', function ($codmodelo) {
    return \App\Http\Fachadas\FachadaAbstract::make('ModeloPublicoController')->show($codmodelo);
})->name('visualizar_modelo_publico');
//    ->middleware('can:can-model-public');

Route::get('publico/modelos/baixar/{codmodelodiagramatico}/{tipo}', function ($codmodelodiagramatico, $tipo) {
    return \App\Http\Fachadas\FachadaAbstract::make('DownloadDiagramaController')->download($codmodelodiagramatico, $tipo);
})->name('baixar');

Route::get('publico/modelos/baixar/{codmodelodiagramatico}', function ($codmodelodiagramatico) {
    return \App\Http\Fachadas\FachadaAbstract::make('DownloadDiagramaController')->downloadSVG($codmodelodiagramatico);
})->name('baixarSVG');

Route::get('checklist/{codmodelo}', function ($codmodelo) {
    return \App\Http\Fachadas\FachadaAbstract::make('TarefaController')->index($codmodelo);
})->name('checklist');

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(
    function () {
        Route::post('Comentar/Diagrama/edicao_modelo_diagramatico_comentario/gravar', 'RepresentacaoModelagemController@store')
            ->name('salvar_comentario')
            ->middleware('can:acesso');

        Route::post('transferir/diagrama', 'OperacoesDiagramaController@store')
            ->name('transferirDiagrama')
            ->middleware('can:acesso');

        Route::post('edicao_modelo_diagramatico/transferir/diagrama ', 'OperacoesDiagramaController@store')
            ->name('transferirDiagramaModelagem')
            ->middleware('can:acesso');

        Route::post('controle_modelos_diagramaticos/tranferir/diagrama', 'OperacoesDiagramaController@store')
            ->name('transferirDiagrama_ambiente_modelagem')
            ->middleware('can:acesso');

        Route::post('transferir/modelo', 'OperacoesModeloController@store')
            ->name('transferirModelo')
            ->middleware('can:acesso');

        Route::post('transferir/projeto', 'OperacoesProjetoController@store')
            ->name('transferirProjeto')
            ->middleware('can:acesso');

        Route::post('transferir/repositorio', 'OperacoesRepositorioController@store')
            ->name('transferirRepositorio')
            ->middleware('can:admin');


        Route::resource('controle_tarefas', 'TarefaController')
            ->middleware('can:acesso');

//        Rotas para controle de mensagens
        Route::get('controle_mensagens_show/{codmensagem}', 'MensagemController@show')
            ->name('controle_mensagens_show')
            ->middleware('can:acesso');

        Route::get('controle_mensagens_index/{codusuario}', 'MensagemController@index')
            ->name('controle_mensagens_index')
            ->middleware('can:acesso-usuario,codusuario');

        Route::get('controle_mensagens_create/{codusuario}', 'MensagemController@create')
            ->name('controle_mensagens_create')
            ->middleware('can:acesso-usuario,codusuario');

        Route::post('controle_mensagens_store', 'MensagemController@store')
            ->name('controle_mensagens_store')
            ->middleware('can:acesso');

        Route::post('controle_modelos_diagramaticos/controle_mensagens_store', 'MensagemController@store')
            ->name('controle_mensagens_store_diagramaticos')
            ->middleware('can:acesso');


        Route::post('edicao_modelo_diagramatico/controle_mensagens_store', 'MensagemController@store')
            ->name('controle_mensagens_store_modelagem')
            ->middleware('can:acesso');
        Route::put('controle_mensagens_update/{codmensagem}', 'MensagemController@update')
            ->name('controle_mensagens_update')
            ->middleware('can:acesso-mensagem,codmensagem');

        Route::get('controle_mensagens_edit/{codmensagem}', 'MensagemController@edit')
            ->name('controle_mensagens_edit')
            ->middleware('can:acesso');

        Route::delete('controle_mensagens_destroy', 'MensagemController@destroy')
            ->name('controle_mensagens_destroy')
            ->middleware('can:acesso-no-repositorio');

//        fim do controle de mensagens

        Route::get('controle_tarefas_index/{codmodelo}', 'TarefaController@index')
            ->name('controle_tarefas_index')
            ->middleware('can:acesso-modelo,codmodelo');

        Route::get('Comentar/Diagrama/{codmodelodiagramatico}', 'ComentarioDiagramaController@index')
            ->name('comentarDiagrama')->middleware('can:acesso-no-repositorio');

        Route::get('Excluir/Comentario/Diagrama/{codmodelodiagramatico}', 'ComentarioDiagramaController@destroy')
            ->name('excluirComentarioDiagrama')->middleware('can:acesso-no-repositorio');

        Route::get('Usuarios/Online', 'UsuariosOnlineController@index')
            ->name('UsuariosOnline')->middleware('can:admin-proprietario');

        Route::get('todas_regras', 'RegraController@all')->name('todas_regras')
            ->middleware('can:acesso-no-repositorio');

        Route::resource('controle_padroes_recomendacao', 'PadraoRecomendacaoBinarioController')
            ->middleware('can:acesso');

        Route::resource('controle_avisos', 'AvisoController')
            ->middleware('can:acesso');

        Route::get('controle_padrao_create_binario/modelo_delcarativo/{codmodelodeclarativo}', 'PadraoRecomendacaoBinarioController@create')
            ->name('controle_padrao_create_binario')
            ->middleware('can:acesso');

        Route::get('controle_padrao_create_conjunto/modelo_delcarativo/{codmodelodeclarativo}', 'PadraoRecomendacaoConjuntoController@create')
            ->name('controle_padrao_create_conjunto')
            ->middleware('can:acesso');


        Route::post('controle_padrao_salvar', 'PadraoRecomendacaoBinarioController@store')
            ->name('controle_padrao_salvar')
            ->middleware('can:acesso');

        Route::post('edicao_modelo_diagramatico/gravar', 'RepresentacaoModelagemController@store')
            ->name('gravar')
            ->middleware('can:acesso');


        Route::post('controle_modelos_diagramaticos/gravar', 'RepresentacaoModelagemController@store')
            ->middleware('can:acesso');

        Route::get('edicao_modelo_diagramatico/{codmodelodiagramatico}', 'RepresentacaoModelagemController@edit')
            ->name('edicao_modelo_diagramatico')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::get('configuracao/modelagem/{codmodelodiagramatico}', 'ConfiguracaoAmbienteModelagemController@index')
            ->name('configuracao_ambiente_modelagem_index')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::resource('controle_configuracao_modelagem', 'ConfiguracaoAmbienteModelagemController')
            ->middleware('can:acesso');

        Route::get('configuracao/modelagem/create/{codmodelodiagramatico}', 'ConfiguracaoAmbienteModelagemController@create')
            ->name('configuracao_ambiente_modelagem_create')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');


        Route::resource('controle_projetos', 'ProjetoController')
            ->middleware('can:acesso');

        Route::get('controle_objeto_fluxo_index/modelo_declarativo/{codmodelodeclarativo}', 'ObjetoFluxoController@create')
            ->name('controle_objeto_fluxo_index')
            ->middleware('can:acesso');

        Route::resource('controle_objetos_fluxos', 'ObjetoFluxoController')
            ->middleware('can:acesso');

        Route::get('todos_objetos_fluxos', 'ObjetoFluxoController@all')
            ->name('todos_objetos_fluxos')
            ->middleware('can:acesso');

        Route::resource('controle_repositorios', 'RepositorioController')
            ->middleware('can:acesso');
        Route::resource('controle_diagramas_automatico', 'RepresentacaoDiagramaticaAutomaticaController')
            ->middleware('can:acesso');

        Route::get('controle_modelos/index/{codprojeto}', 'ModeloController@index')
            ->name('controle_modelos_index')
            ->middleware('can:acesso-processo,codprojeto');


        Route::get('controle_modelos/create/{codprojeto}', 'ModeloController@create')
            ->name('controle_modelos_create')
            ->middleware('can:acesso-processo,codprojeto');

        Route::get('controle_modelos_diagramaticos/{codmodelodiagramatico}/edit', 'RepresentacaoDiagramaticaController@edit')
            ->name('editar_diagrama')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::post('controle_modelos_diagramaticos/store', 'RepresentacaoDiagramaticaController@store')
            ->name('salvar_diagrama')
            ->middleware('can:acesso');

        Route::put('controle_modelos_diagramaticos/{codmodelodiagramatico}/update', 'RepresentacaoDiagramaticaController@update')
            ->name('atualizar_diagrama')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');


        Route::delete('controle_modelos_diagramaticos/{codmodelodiagramatico}/destroy', 'RepresentacaoDiagramaticaController@destroy')
            ->name('deletar_diagrama')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');


        Route::get('controle_modelos_diagramaticos/{codmodelodiagramatico}', 'RepresentacaoDiagramaticaController@show')
            ->name('exibir_diagrama')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::get('controle_modelos_diagramaticos/{codmodelo}/create', 'RepresentacaoDiagramaticaController@create')
            ->name('criar_diagrama')
            ->middleware('can:acesso-modelo,codmodelo');

        Route::get('controle_modelos_declarativos_create/repositorio/{codrepositorio}/projeto/{codprojeto}', 'RepresentacaoDeclarativaController@create')
            ->name('controle_modelos_declarativos')
            ->middleware('can:acesso-repositorio,codrepositorio');

        Route::get('controle_objetos_fluxos_create/modelo/{codmodelodeclarativo}', 'ObjetoFluxoController@create')
            ->name('controle_objetos_fluxos_create')
            ->middleware('can:acesso');

        Route::resource('controle_modelos_declarativos', 'RepresentacaoDeclarativaController')
            ->middleware('can:acesso');

        Route::get('edicao_modelo_declarativo/{codmodelo}', 'RepresentacaoDeclarativaController@edit')
            ->name('edicao_modelo_declarativo')
            ->middleware('can:acesso');


        Route::resource('controle_usuarios', 'UserController')
            ->middleware('can:admin');

        Route::get('controle_usuarios_edit/{codusuario}', 'UserController@edit')
            ->name('controle_usuarios_edit')
            ->middleware('can:admin');

        Route::put('controle_usuarios_edit_ajax/{codusuario}', 'UserController@update')
            ->name('controle_usuarios_edit_ajax')
            ->middleware('can:admin');

        Route::post('controle_usuarios_create_ajax', function (Request $request){
            return \App\Http\Fachadas\FachadaAbstract::make('UserController')->storeAjax($request);
        })
            ->name('controle_usuarios_create_ajax')
            ->middleware('can:admin');
//-----------------------------------------Vínculos de Usuários No Repositório -------------------------

        Route::get('usuarios_sem_vinculos', 'UsuarioSemRepositorioController@index')
            ->name('usuarios_sem_vinculos')
            ->middleware('can:admin');

        Route::post('vincular_usuario_repositorio', 'UsuarioRepositorioController@store')
            ->name('vincular_usuario_repositorio')
            ->middleware('can:acesso');

        Route::post('vincular_usuario_repositorio_publico', 'UsuarioRepositorioController@store')
            ->name('vincular_usuario_repositorio_publico');


        Route::get('desvincular_usuario_repositorio/codigo/{codigo_usuario_repositorio}', 'UsuarioRepositorioController@destroy')
            ->name('desvincular_usuario_repositorio');

        Route::delete('edicao_modelo_diagramatico/desvincular_usuario_repositorio_vinculado/codigo/{codigo_usuario_repositorio}', 'VinculoUsuarioRepositorioController@destroy')
            ->name('desvincular_usuario_repositorio_vinculado_edicao');

        Route::delete('desvincular_usuario_repositorio_vinculado/codigo/{codigo_usuario_repositorio}', 'VinculoUsuarioRepositorioController@destroy')
            ->name('desvincular_usuario_repositorio_vinculado');


        Route::delete('controle_modelos_diagramaticos/desvincular_usuario_repositorio_vinculado/codigo/{codigo_usuario_repositorio}', 'VinculoUsuarioRepositorioController@destroy')
            ->name('desvincular_usuario_repositorio_vinculado_modelagem');

        Route::post('controle_solicitacao_usuario', 'SolicitacaoController@store')
            ->name('solicitacao_usuario');

        Route::get('todas_solicitacoes', 'SolicitacaoController@all')
            ->name('todas_solicitacoes')
            ->middleware('can:admin');

        Route::delete('controle_solicitacao_usuario/codigosolicitacao/{codsolicitacao}', 'SolicitacaoController@destroy')
            ->name('cancelar_solicitacao_usuario');

        Route::get('vinculo_usuario_repositorio', 'UsuarioRepositorioController@index')
            ->name('vinculo_usuario_repositorio')
            ->middleware('can:acesso');

//        -----------------------------------------Vínculos de Usuários No Projeto -------------------------


        Route::post('vincular_usuario_projeto', 'UsuarioProjetoController@store')
            ->name('vincular_usuario_projeto')
            ->middleware('can:acesso');

        Route::delete('desvincular_usuario_projeto/codigo/{codigo_usuario_projeto}', 'UsuarioProjetoController@destroy')
            ->name('desvincular_usuario_projeto')
            ->middleware('can:acesso');


//        -----------------------------------------Vínculos de Usuários No Modelo -------------------------
        Route::post('vincular_usuario_modelo', 'UsuarioModeloController@store')
            ->name('vincular_usuario_modelo')
            ->middleware('can:acesso');

        Route::post('controle_modelos_diagramaticos/vincular_usuario_modelo', 'UsuarioModeloController@store')
            ->name('vincular_usuario_modelo_modelagem')
            ->middleware('can:acesso');
        Route::delete('desvincular_usuario_modelo/codigo/{codigo_usuario_modelo}', 'UsuarioModeloController@destroy')
            ->name('desvincular_usuario_modelo')
            ->middleware('can:acesso');


        Route::resource('controle_logs', 'LogController')
            ->middleware('can:acesso');

        Route::get('index_logs', 'LogController@index')
            ->name('index_logs')
            ->middleware('can:acesso');

        Route::resource('controle_documentacoes', 'DocumentacaoController')
            ->middleware('can:acesso');

        Route::resource('controle_modelos', 'ModeloController')
            ->middleware('can:acesso');

        Route::get('create_vinculo_repositorio/repositorio/{codrepositorio}/operacao/{codoperacao}', 'VinculoUsuarioRepositorioController@create')
            ->name('create_vinculo_repositorio');

        Route::get('controle_relatorios_graficos/relatorio/{codrelatorio}/repositorio/{codrepositorio}', 'RelatoriosGraficosController@index')
            ->name('controle_relatorios_graficos_index')
            ->middleware('can:acesso-repositorio,codrepositorio');

        Route::get('controle_relatorio/relatorio/{codprojeto}', 'RelatorioPDFController@index')
            ->name('gerar_relatorio_projeto')
            ->middleware('can:acesso-processo,codprojeto');

        Route::get('controle_relatorio_repositorio/relatorio/{codrepositorio}', 'RelatorioPDFController@show')
            ->name('gerar_relatorio_repositorio')
            ->middleware('can:acesso-repositorio,codrepositorio');

        Route::get('delete_vinculo_repositorio', 'VinculoUsuarioRepositorioController@index')
            ->name('delete_vinculo_repositorio')
            ->middleware('can:acesso');


        Route::get('controle_projetos_index/repositorio/{codrepositorio}', 'ProjetoController@index')
            ->name('controle_projetos_index')
            ->middleware('can:acesso-repositorio,codrepositorio');


        Route::get('todos_modelos', 'RepresentacaoDiagramaticaController@all')
            ->name('todos_modelos')
            ->middleware('can:acesso-no-repositorio');

        Route::get('todos_projetos', 'ProjetoController@all')
            ->name('todos_projetos')
            ->middleware('can:acesso-no-repositorio');


        Route::get('controle_projetos_create/{codrepositorio}', 'ProjetoController@create')
            ->name('controle_projetos_create')
            ->middleware('can:acesso-repositorio,codrepositorio');

        Route::get('controle_modelos_diagramaticos_create/modelo/{codmodelo}', 'RepresentacaoDiagramaticaController@create')
            ->name('controle_modelos_diagramaticos_create')
            ->middleware('can:acesso-modelo,codmodelo');


        Route::get('controle_historico_diagramas_create/recuperar/diagrama/{codigo}', 'RepresentacaoDiagramaticaVersionavelController@create')
            ->name('controle_historico_diagramas_create')
            ->middleware('can:acesso-diagrama-versionavel,codigo');

        Route::resource('controle_historico_diagramas', 'RepresentacaoDiagramaticaVersionavelController')
            ->middleware('can:acesso');

        Route::get('controle_historico_diagramas/{codigo}', 'RepresentacaoDiagramaticaVersionavelController@show')
            ->name('exibir_historicos_diagrama')
            ->middleware('can:acesso-diagrama,codigo');

        Route::delete('controle_historico_diagramas/{codigo}/destroy', 'RepresentacaoDiagramaticaVersionavelController@destroy')
            ->name('deletar_historico_diagrama')
            ->middleware('can:acesso-diagrama,codigo');

        Route::get('controle_modelos_declarativos_create/modelo/{codmodelo}', 'RepresentacaoDeclarativaController@create')
            ->name('controle_modelos_declarativos_create')
            ->middleware('can:acesso-modelo,codmodelo');

        Route::get('controle_modelos_declarativos_lista/modelo/{codmodelo}', 'RepresentacaoDeclarativaController@index')
            ->name('controle_modelos_declarativos_lista')
            ->middleware('can:acesso-modelo,codmodelo');


        Route::get('controle_modelos_diagramaticos_index/modelo/{codmodelo}', 'RepresentacaoDiagramaticaController@index')
            ->name('controle_modelos_diagramaticos_index')
            ->middleware('can:acesso-modelo,codmodelo');;

        Route::get('historico_alteracoes_diagramas/diagrama/{codmodelodiagramatico}', 'RepresentacaoDiagramaticaVersionavelController@index')
            ->name('historico_alteracoes_diagramas')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::get('controle_modelos_declarativos_index/modelo/{codmodelo}', 'RepresentacaoDeclarativaController@index')
            ->name('controle_modelos_declarativos_index')
            ->middleware('can:acesso-modelo,codmodelo');;


        Route::get('edit_vinculo/{codusuario}', 'UsuarioSemRepositorioController@edit')
            ->name('edit_vinculo')
            ->middleware('can:acesso');

        Route::resource('controle_regras', 'RegraController')
            ->middleware('can:acesso');

        Route::get('controle_regras_index/modelodeclarativo/{codmodelodeclarativo}', 'RegraController@index')
            ->name('controle_regras_index')
            ->middleware('can:acesso');


        Route::get('painel', 'PainelPrincipalController@index')
            ->name('painel');


        /////////////////////////////ROTAS A SEREM REFATORADAS///////////////////////////////////


        Route::get('criar/repositorio/padrao/{nome}', function ($nome) {
            return \App\Http\Fachadas\FachadaAbstract::make('RepositorioController')->criarRepositorioPadrao($nome);
        })
            ->name('criar_repositorio_padrao');

        Route::post('criar/projeto', function (Request $request) {
            return \App\Http\Fachadas\FachadaAbstract::make('ProjetoController')->criarProjeto($request);
        })
            ->name('criar_projeto_padrao');

        Route::get('atualizar/repositorio/padrao/{nome}', function ($nome) {
            return \App\Http\Fachadas\FachadaAbstract::make('RepositorioController')->atualizarRepositorioPadrao($nome);
        })
            ->name('atualizar_repositorio_padrao');



        Route::put('controle_modelos_update/{codmodelo}', function (Request $request, $codmodelo) {
            return \App\Http\Fachadas\FachadaAbstract::make('ModeloController')->atualizar($request,$codmodelo);
        })->middleware('can:acesso-modelo,codmodelo');


        Route::put('atualizar_descricao_modelo/{codmodelo}', function (Request $request, $codmodelo) {
            return \App\Http\Fachadas\FachadaAbstract::make('ModeloController')->atualizarDescricao($request,$codmodelo);
        })
            ->name('atualizar_descricao_modelo')
            ->middleware('can:acesso-modelo,codmodelo');

        Route::put('atualizar_descricao_diagrama/{codmodelodiagramatico}', function (Request $request, $codmodelodiagramatico) {
            return \App\Http\Fachadas\FachadaAbstract::make('RepresentacaoDiagramaticaController')->atualizarDescricao($request,$codmodelodiagramatico);
        })
            ->name('atualizar_descricao_diagrama')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::get('chat', 'ChatController@index')
            ->name('chat')
            ->middleware('can:acesso');

        Route::post('upload/arquivo/', 'UploadController@upload')
            ->name('upload')->middleware('can:jean');

        Route::get('validar/modelo/{codmodelo}', 'ValidadorModeloController@show')
            ->name('ValidarModelo')
            ->middleware('can:acesso-modelo,codmodelo');


        Route::put('validar/diagrama/{codmodelodiagramatico}', function (Request $request, $codmodelodiagramatico) {
            return \App\Http\Fachadas\FachadaAbstract::make('ValidadorDiagramaController')->validarDiagrama($codmodelodiagramatico);
        })
            ->name('ValidarDiagrama')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::put('adicionar/validador/modelo/{codmodelo}', function (Request $request, $codmodelo) {
            return \App\Http\Fachadas\FachadaAbstract::make('ValidadorModeloController')->validarModelo($codmodelo);
        })
            ->name('ValidarModelo')
            ->middleware('can:acesso-modelo,codmodelo');

        Route::get('richtext/{codmodelo}', 'DocumentacaoTextualModeloController@show')
            ->name('rich_text')
            ->middleware('can:acesso-modelo,codmodelo');

        Route::post('salvar/documentacao', 'DocumentacaoController@gravar')
            ->name('salvar_documentacao')
            ->middleware('can:acesso');

        Route::put('atualizar/documentacao/{coddocumentacao}', 'DocumentacaoController@alterar')
            ->name('atualizar_documentacao')
            ->middleware('can:acesso');

        Route::get('richtext_diagrama/{codmodelodiagramatico}', 'DocumentacaoTextualDiagramaController@show')
            ->name('rich_text_diagrama')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::get('controle_modelos_diagramaticos/baixar/{codmodelodiagramatico}/{tipo}', 'DownloadDiagramaController@download')
            ->name('baixar')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

        Route::get('controle_historico_diagramas/baixar/{codmodelodiagramatico}/{tipo}', 'DownloadDiagramaController@download')
            ->name('baixar')
            ->middleware('can:acesso-diagrama-versionavel,codmodelodiagramatico');

        Route::get('edicao_modelo_diagramatico/baixar/{codmodelodiagramatico}/{tipo}', 'DownloadDiagramaController@download')
            ->name('baixar')
            ->middleware('can:acesso-diagrama,codmodelodiagramatico');

//////////////////////////////////////FIM DO REFATORAMENTO////////////////////////////////
        Route::get('/clear-cache', function () {

            limpar_cache();
            return redirect()->back();
        })->name('limpar_cache');

        Route::get('donwload/arquivo/{link}', function ($link) {
            if (!Auth()->check()) {
                return abort(404);
            }
            if (Storage::disk('local')->exists($link))
                return Storage::disk('local')->download($link);
            return false;
        })->name('donwload_arquivo')->middleware('can:jean');

        Route::get('uploads/arquivos', function () {
            return view('dropzone.dropzone');
        })->name('dropzone')->middleware('can:jean');

        Route::get('uploads/arquivos/documentacao/{coddocumentacao}', function ($coddocumentacao) {
            $documentacao = Documentacao::FindOrFail($coddocumentacao);
            return \Response::json($documentacao->arquivos);
        })->name('arquivos')->middleware('can:jean');

        Route::get('uploads/arquivos/diagrama/{codmodelodiagramatico}', function ($codmodelodiagramatico) {
            $diagrama = RepresentacaoDiagramatica::FindOrFail($codmodelodiagramatico);
            return view('dropzone.dropzone', compact('diagrama'));
        })->name('DropzoneDiagrama')->middleware('can:jean');

    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
