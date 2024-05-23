@includeIf('layouts.admin.componentes.breadcrumb',[
   'titulo' => 'Painel',
   'sub_titulo' => ''

   ])
@if(Auth::getUser()->Epadrao())
    @includeIf('layouts.admin.componentes.tables',[
                            'titulos' => ["Repositório", "Ação"],
                            'repositorios' => Auth::getUser()->repositorios(),
                            'rota_solicitacao' => 'controle_repositorios.show',
                            'nome_botao' => 'Novo',
                            'titulo' =>'Repositórios - Clique em participar se quiser entrar em algum repositório!!',
                            'tipo' => 'repositorio'

            ])
@endif
