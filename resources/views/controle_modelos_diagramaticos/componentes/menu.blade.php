@if (!empty($diagrama))

    <div class="dropdown" style="zoom: 90%">
        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Funções
        </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="myDropdown">

            <input type="text" class="dropdown-item" placeholder="Pesquisar.."
                   style="background-color: rgb(206,206,206);"
                   id="myInput" onkeyup="filterFunction()">
            <a class="dropdown-item"
               onclick="dowloadSVGModeloPublico('{!! $modelo->codmodelodiagramatico !!}','diagrama.svg')"
               download="diagrama.bpmn"
               title="Donwload do BPMN" style="cursor: pointer;">
                <p class="fa fa-download faa-pulse  text-center"></p>Donwload SVG
                <span class="sr-only"></span>
            </a>
            @if (Auth::getUser()->EColaborador())
                <a class="dropdown-item"
                   onclick="donwload('diagrama.bpmn','{!! $modelo->codmodelodiagramatico !!}','normal')"
                   download="diagrama.bpmn"
                   title="Donwload do BPMN" style="cursor: pointer;">
                    <p class="fa fa-download faa-pulse  text-center"></p>Donwload
                    <span class="sr-only"></span>
                </a>
                {{-- <a class="dropdown-item"
                   data-toggle="modal"
                   data-target="#modal-listagem-versionamento{!! $modelo->codmodelodiagramatico !!}"
                   title="Informações do Diagrama" style="cursor: pointer;">
                    <p class="fa fa-user faa-pulse  text-center"></p>Versões do Diagrama
                    <span class="sr-only"></span>
                </a> --}}
                @if ($diagrama->eCliente())
{{--                    <a class="dropdown-item" data-toggle="modal"--}}
{{--                       data-target="#GSCCModal" title="Enviar Mensagem" style="cursor: pointer;">--}}
{{--                        <p class="fa fa-paper-plane text-center">Enviar Mensagem</p>--}}
{{--                        <span class="sr-onley"></span>--}}
{{--                    </a>--}}
                    @if (Auth::getUser()->email ==='jeancarlospenas25@gmail.com')
                    <a class="dropdown-item"
                       data-toggle="modal"
                       data-target="#modal-mensagem1"
                       title="Informações do Diagrama" style="cursor: pointer;">
                        <p class="fa fa-user faa-pulse  text-center"></p>Usuários
                        <span class="sr-only"></span>
                    </a>
                    @endif
                @endif

                @if($diagrama->eValidador())
                    @if($diagrama->validado)
                        <a class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('ValidarDiagrama',[$modelo->codmodelodiagramatico])}}','Deseja desvalidar este Diagrama?');">
                            <i class="fa fa-check faa-pulse  text-center" style="color:green;"></i>Desvalidar Diagrama
                        </a>
                    @else
                        <a class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('ValidarDiagrama',[$modelo->codmodelodiagramatico])}}','Deseja validar este Diagrama?');"
                        >
                            <p class="fa fa-warning faa-pulse  text-center"></p>Validar Diagrama
                        </a>
                    @endif

                @endif
                <a class="dropdown-item" data-toggle="modal"
                   data-target="#modal-listagem-acessosrecentes" style="cursor: pointer;"
                   title="Acessos Recentes"><i
                        class="fa fa-star faa-pulse  fa-1x"></i>Acessos Recentes</a>


                @if(Auth::getUser()->EColaborador() || $diagrama->eColaborador())
                    @if (Auth::getUser()->email==='jeancarlospenas25@gmail.com')
                        <a class="dropdown-item"
                           href="javascript:void(window.open('{!! route('comentarDiagrama',[$diagrama->codmodelodiagramatico]) !!}','','width=720,height=640'))"
                           title="Comentar Diagrama" style="cursor: pointer;">
                            <p class="fa fa-project-diagram faa-pulse  text-center"></p>Comentar Diagrama
                            <span class="sr-onley"></span>
                        </a>
                    @endif

                    <a class="dropdown-item"
                       href="javascript:void(window.open('{!! route('rich_text_diagrama',[$diagrama->codmodelodiagramatico]) !!}','','width=720,height=640'))">
                        <p class="fa fa-edit faa-pulse  text-center"></p>Editar Descrição Textual
                    </a>
                    @if($tipo=='edicao')
                        <a style="cursor: pointer" class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('edicao_modelo_diagramatico',[$diagrama->codmodelodiagramatico])}}','Deseja Editar o Diagrama?');">
                            <p class="fa fa-edit faa-pulse  text-center"></p>Editar Diagrama
                        </a>


                    @else
                        <a style="cursor: pointer" class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('exibir_diagrama',[$diagrama->codmodelodiagramatico])}}','Deseja visualizar o Diagrama?');">
                            <p class="fa fa-eye faa-pulse  text-center"></p>Visualizar Diagrama
                        </a>
                    <a style="cursor: pointer" class="dropdown-item">


                         <p id="iconePlusEsconder"><i  class="fa fa-minus faa-pulse "></i>Esconder Botões</p>
                        <p id="iconePlusMostrar" style="display: none"><i class="fa fa-plus faa-pulse " ></i>Mostrar Botões</p>
                    </a>

                        <a class="dropdown-item"
                           data-toggle="modal"
                           data-target="#GSCCModalCriacaoDiagramaAutomaticoNovoDiagrama"
                           title="Transferir Diagrama" style="cursor: pointer;">
                            <p class="fa fa-info faa-pulse  text-center"></p>Novo Diagrama
                            <span class="sr-only"></span>
                        </a>

                    @endif
                    @if (Auth::getUser()->EProprietario() || $diagrama->eProprietario())
{{--                        @if (Auth::getUser()->email==='jeancarlospenas25@gmail.com')--}}
{{--                            <a--}}
{{--                               class="dropdown-item"--}}
{{--                               data-toggle="modal"--}}
{{--                               data-target="#modal-usuario-validador"--}}
{{--                               title="Adicionar validador para o diagrama" style="cursor: pointer;">--}}
{{--                                <p class="fa fa-user faa-pulse  text-center"></p>&nbsp;Adicionar Validador--}}
{{--                                <span class="sr-only"></span>--}}
{{--                            </a>--}}
{{--                        @endif--}}

                        <a class="dropdown-item"
                           href="javascript:void(window.open('{!! route('historico_alteracoes_diagramas',[$modelo->codmodelodiagramatico]) !!}','','width=720,height=640'))"
                           style="cursor: pointer;">
                            <p class="fa fa-history faa-pulse  text-center"></p>Alterações
                            <span class="sr-only"></span>
                        </a>
{{--                        <a class="dropdown-item" onclick="return confirm('Deseja Editar o modelo deste Diagrama?');"--}}
{{--                           href="javascript:void(window.open('{!! route('editar_diagrama',[$diagrama->codmodelodiagramatico]) !!}','','width=720,height=640'))">--}}
{{--                            <p class="fa fa-edit faa-pulse  text-center"></p>&nbsp;Editar Modelo /Upload Diagrama--}}
{{--                        </a>--}}
                        <a class="dropdown-item" data-toggle="modal"
                           data-target="#modal-atribuicao-usuarios" title="Adicionar Usuario" style="cursor: pointer;">
                            <i class="fa fa-users faa-pulse  text-center"></i>Adicionar Usuário
                            <span class="sr-onley"></span>
                        </a>
                        <a class="dropdown-item"
                           data-toggle="modal"
                           data-target="#modal-form-transferencia-diagrama"
                           title="Transferir Diagrama" style="cursor: pointer;">
                            <p class="fa fa-info faa-pulse  text-center"></p> Transferir Diagrama
                            <span class="sr-only"></span>
                        </a>
                        <a class="dropdown-item"
                           data-toggle="modal"
                           data-target="#GSCCModalCriacaoDiagramaAutomaticoNovoDiagrama"
                           title="Transferir Diagrama" style="cursor: pointer;">
                            <p class="fa fa-info faa-pulse  text-center"></p> Novo Diagrama
                            <span class="sr-only"></span>
                        </a>
                    @if ($diagrama->diagramaEstaComentado())
                            <a class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('excluirComentarioDiagrama',[$diagrama->codmodelodiagramatico])}}','Deseja apagar os comentarios da versão comentada?');">

                                <p class="fa fa-edit faa-pulse  text-center"></p>Apagar comentarios do Diagrama
                            </a>
                    @endif

                    @endif
                @endif
                <a class="dropdown-item"
                   data-toggle="modal"
                   data-target="#modal-listagem-repositorios"
                   title="Repositórios do usuário" style="cursor: pointer;">
                    <p class="fa fa-database faa-pulse  text-center"></p> Repositórios
                    <span class="sr-only"></span>
                </a>
                @if(Auth::user()->usuario_esta_no_repositorio())
                    <a style="cursor:pointer;" class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('delete_vinculo_repositorio')}}','Deseja Sair do Repositorio');">Sair Do
                        Repositório {!! Auth::getUser()->repositorio->nome !!}</a>
                @endif

            @elseif($diagrama->eProprietario())
                <a class="dropdown-item"
                   onclick="donwload('diagrama.bpmn','{!! $modelo->codmodelodiagramatico !!}','normal')"
                   download="diagrama.bpmn"
                   title="Donwload do BPMN" style="cursor: pointer;">
                    <p class="fa fa-download faa-pulse  text-center"></p>Donwload
                    <span class="sr-only"></span>
                </a>
                <a class="dropdown-item" data-toggle="modal"
                   data-target="#GSCCModal" title="Enviar Mensagem" style="cursor: pointer;">
                    <p class="fa fa-paper-plane faa-pulse  text-center"></p>Enviar Mensagem
                    <span class="sr-onley"></span>
                </a>
                @if($diagrama->eValidador())
                    @if($diagrama->validado)
                        <a class="dropdown-item" onclick="validarDiagrama(
                                '{!! $diagrama->codmodelodiagramatico !!}',
                                '{!! $diagrama->codusuario !!}',
                                '{!! $diagrama->usuario->email !!}',
                                '#validarDiagrama',
                                'Deseja validar Este Diagrama?',
                                'Validar',
                                'false'
                                )">
                            <p class="fa fa-warning faa-pulse  text-center" id="validarDiagrama">Desvalidar Diagrama</p>

                        </a>
                    @else
                        <a class="dropdown-item" onclick="validarDiagrama(
                                                    '{!! $diagrama->codmodelodiagramatico !!}',
                                                    '{!! $diagrama->codusuario !!}',
                                                    '{!! $diagrama->usuario->email !!}',
                                                    '#validarDiagrama',
                                                    'Deseja validar Este Diagrama?',
                                                    'Validar',
                                                    'true'
                                            )">
                            <p class="fa fa-warning faa-pulse  text-center" id="validarDiagrama">Validar Diagrama</p>

                        </a>

                    @endif

                @endif
                <a class="dropdown-item btn-toggle1" id="descricao-link-id3"
                   onclick="Mudarestado('descricao-label-id3','descricao-link-id3')"
                   title="Esconder Legenda" style="cursor: pointer;">
                    <p class="fa fa-info-circle faa-pulse  text-center"></p>Exibir Descrição
                    <span class="sr-only"></span>
                </a>
                <a class="dropdown-item" data-toggle="modal"
                   data-target="#modal-listagem-acessosrecentes" style="cursor: pointer;"
                   title="Acessos Recentes"><i
                        class="fa fa-star faa-pulse  fa-1x"></i>Acessos Recentes</a>
                @if (Auth::getUser()->email ==='jeancarlospenas25@gmail.com')
                <a class="dropdown-item"
                   data-toggle="modal"
                   data-target="#modal-mensagem1"
                   title="Informações do Diagrama" style="cursor: pointer;">
                    <p class="fa fa-user faa-pulse  text-center"></p>&nbsp;Usuários
                    <span class="sr-only"></span>
                </a>
                @endif


                <a class="dropdown-item"
                   href="javascript:void(window.open('{!! route('historico_alteracoes_diagramas',[$modelo->codmodelodiagramatico]) !!}','','width=720,height=640'))"
                   style="cursor: pointer;">
                    <p class="fa fa-history faa-pulse  text-center"></p>Alterações
                    <span class="sr-only"></span>
                </a>
{{--                <a class="dropdown-item" onclick="return confirm('Deseja Editar o modelo deste Diagrama?');"--}}
{{--                   href="javascript:void(window.open('{!! route('editar_diagrama',[$diagrama->codmodelodiagramatico]) !!}','','width=720,height=640'))">--}}
{{--                    <p class="fa fa-edit faa-pulse  text-center"></p>&nbsp;Editar Modelo /Upload Diagrama--}}
{{--                </a>--}}
                <a class="dropdown-item" data-toggle="modal"
                   data-target="#modal-mensagem" title="Adicionar Usuario" style="cursor: pointer;">
                    <i class="fa fa-users faa-pulse  text-center"></i>Adicionar Usuário
                    <span class="sr-onley"></span>
                </a>
                <a class="dropdown-item"
                   data-toggle="modal"
                   data-target="#modal-form-transferencia-diagrama"
                   title="Transferir Diagrama" style="cursor: pointer;">
                    <p class="fa fa-info faa-pulse  text-center"></p> Transferir Diagrama
                    <span class="sr-only"></span>
                </a>
                <a class="dropdown-item"
                   data-toggle="modal"
                   data-target="#GSCCModalCriacaoDiagramaAutomaticoNovoDiagrama"
                   title="Transferir Diagrama" style="cursor: pointer;">
                    <p class="fa fa-info faa-pulse  text-center"></p>Novo Diagrama
                    <span class="sr-only"></span>
                </a>
                @if (Auth::getUser()->email==='jeancarlospenas25@gmail.com')
                    <a class="dropdown-item"
                       href="javascript:void(window.open('{!! route('comentarDiagrama',[$diagrama->codmodelodiagramatico]) !!}','','width=720,height=640'))"
                       title="Comentar Diagrama" style="cursor: pointer;">
                        <p class="fa fa-project-diagram faa-pulse  text-center"></p>Comentar Diagrama
                        <span class="sr-onley"></span>
                    </a>
                @endif

                <a class="dropdown-item"
                   onclick="return confirm('Deseja Editar a documentação textual do Diagrama?');"
                   href="javascript:void(window.open('{!! route('rich_text_diagrama',[$diagrama->codmodelodiagramatico]) !!}','','width=720,height=640'))">
                    <p class="fa fa-edit faa-pulse  text-center"></p>Editar Descrição Textual
                </a>
                @if($tipo=='edicao')

                    <a style="cursor: pointer" class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('edicao_modelo_diagramatico',[$diagrama->codmodelodiagramatico])}}','Deseja Editar o Diagrama?');">
                        <p class="fa fa-edit faa-pulse  text-center"></p>Editar Diagrama
                    </a>

                @else
                    <a style="cursor: pointer" class="dropdown-item" onclick="confirmMensagemPersonalizado('{{route('exibir_diagrama',[$diagrama->codmodelodiagramatico])}}','Deseja visualizar o Diagrama?');">
                        <p class="fa fa-eye faa-pulse  text-center"></p>Visualizar Diagrama
                    </a>
                    <a class="dropdown-item"
                       data-toggle="modal"
                       data-target="#modal-form-transferencia-diagrama"
                       title="Transferir Diagrama" style="cursor: pointer;">
                        <p class="fa fa-info faa-pulse  text-center"></p>Transferir Diagrama
                        <span class="sr-only"></span>
                    </a>
                    <a class="dropdown-item"
                       data-toggle="modal"
                       data-target="#GSCCModalCriacaoDiagramaAutomaticoNovoDiagrama"
                       title="Transferir Diagrama" style="cursor: pointer;">
                        <p class="fa fa-info faa-pulse  text-center"></p>Novo Diagrama
                        <span class="sr-only"></span>
                    </a>

                @endif

                <a class="dropdown-item"
                   data-toggle="modal"
                   data-target="#modal-listagem-repositorios"
                   title="Repositórios do usuário" style="cursor: pointer;">
                    <p class="fa fa-database faa-pulse  text-center"> </p>Repositórios
                    <span class="sr-only"></span>
                </a>


                <a style="cursor: pointer" class="dropdown-item" href="{!! route('delete_vinculo_repositorio')!!}">Sair Do
                    Repositório {!! Auth::getUser()->repositorio->nome !!}</a>

            @endif


        </div>

    </div>
@endif



