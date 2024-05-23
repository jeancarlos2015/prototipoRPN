<div style="background-color: white">
    <div style="margin-top: 2%; margin-left: 85%" class="lista">
        <ul>
            @if(Auth::user()->email==='jeancarlospenas@gmail.com')
                @if(!empty($lupa) && $lupa)

                    <li>
                        <input type="image" onclick="Mudarestado('grafico')" src="{!! asset('img/olho.png') !!}"
                               alt="Submit"
                               width="20">
                    </li>
                    <script>
                        function Mudarestado(el) {
                            var display = document.getElementById(el).style.display;
                            if (display == "none")
                                document.getElementById(el).style.display = 'block';
                            else
                                document.getElementById(el).style.display = 'none';
                        }

                    </script>
                @endif
            @endif


            <li>
                <a data-toggle="modal"
                   data-target="#modal-mensagem1" style="cursor: pointer;" title="Pesquisar Usuários"><i
                        class="fa fa-clipboard faa-pulse  fa-2x"></i></a>
            </li>
            @if(!empty($repositorio) || Auth::getUser()->usuario_esta_no_repositorio())
                <li>
                    <a data-toggle="modal"
                       data-target="#modal-atribuicao-usuarios" style="cursor: pointer;" title="Adicionar Usuários"><i
                            class="fa fa-user-plus faa-pulse  fa-2x"></i></a>
                </li>
            @endif
                @if (Auth::getUser()->usuario_esta_no_repositorio())
                    <li>

                        <a
                            data-toggle="modal"
                            data-target="#modal-pesquisa-diagramas"
                            style="cursor: pointer;"
                            title="Esta funcionalidade permite exibir uma  lista de diagramas"><i
                                class="fa fa-search faa-pulse  fa-2x"></i></a>

                    </li>
                @endif
                @if(Auth::getUser()->EAdministrador())
                    <a
                        data-toggle="modal"
                        data-target="#modal-form-aviso"
                        style="cursor: pointer;"
                        title="Esta funcionalidade permite criar avisos que serão exibidos para todos os usuários"><i
                            class="fa fa-bullhorn faa-pulse  fa-2x"></i></a>
                @endif
            <li>
                <a data-toggle="modal"
                   data-target="#modal-listagem-acessosrecentes" style="cursor: pointer;" title="Acessos Recentes"><i
                        class="fa fa-star faa-pulse  fa-2x"></i></a>
            </li>

            @yield('botao_batepapo')

        </ul>
    </div>


</div>
