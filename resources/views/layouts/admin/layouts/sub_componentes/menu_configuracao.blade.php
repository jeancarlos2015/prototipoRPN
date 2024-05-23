<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
</style>

@if(Auth::getUser()->usuario_esta_no_repositorio() || Auth::getuser()->EAdministrador())
    @yield('versao_diagrama')
    @if(Auth::getuser()->EAdministrador())
        <a class="nav-link" href="#" title="Nenhum Repositório" style="float: left;">{!! Auth::getUser()->papel() !!}</a>
    @else
        <a class="nav-link" href="#" title="{!! Auth::getUser()->repositorio->nome !!}" style="float: left;">{!! Auth::getUser()->papel() !!}</a>
    @endif
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Configuração
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{!! route('painel') !!}"><i class="fa fa-fw fa-home faa-pulse "></i>Painel</a>
            @if(Auth::getUser()->usuario_esta_no_repositorio())

                <a class="dropdown-item" href="{!! route('todos_modelos') !!}"><i class="fa fa-fw fa-eye faa-pulse "></i>Modelos</a>

                <a class="dropdown-item" onclick="return " href="{!! route('desvincular_usuario_repositorio_vinculado',[Auth::getUser()->UsuarioRepositorio()->codusuariorepositorio]) !!}"><i class="fa fa-fw fa-eye faa-pulse "></i>Sair Permanentemente do Repositório Atual</a>


                <a class="dropdown-item" href="{!! route('todas_regras') !!}"><i
                        class="fa fa-fw fa-eye faa-pulse "></i>Regras</a>


                <a class="dropdown-item" href="{!! route('todos_objetos_fluxos') !!}"><i class="fa fa-fw fa-eye faa-pulse "></i>Objetos
                    De Fluxo</a>

                <a class="dropdown-item" href="{!! route('todos_projetos') !!}"><i
                        class="fa fa-fw fa-eye faa-pulse "></i>Processos</a>
            @endif

            @if(Auth::getuser()->EAdministrador() && !Auth::getUser()->usuario_esta_no_repositorio())
                <a class="dropdown-item" href="{!! route('controle_repositorios.index') !!}"><i
                        class="fa fa-cog fa-fw faa-pulse "></i>Repositórios</a>
                <a class="dropdown-item" href="{!! route('controle_repositorios.create') !!}"><i
                        class="fa fa-cog fa-fw faa-pulse "></i>Criar Repositório</a>
            @endif
            @if(Auth::getuser()->EAdministrador())
                <a class="dropdown-item" href="{!! route('controle_usuarios.index') !!}"><i class="fa fa-cog fa-fw faa-pulse "></i>Controle
                    de Usuário</a>
                <a class="dropdown-item" href="{!! route('controle_mensagens_index',[Auth::getUser()->codusuario]) !!}"><i
                        class="fa fa-fw fa-send faa-pulse "></i>Mensagens</a>
            @elseif (Auth::getUser()->EProprietario())
                <a class="dropdown-item" href="{!! route('controle_usuarios_edit',[Auth::getUser()->codusuario]) !!}"><i class="fa fa-cog fa-fw faa-pulse "></i>Alterar Senha</a>
            @endif

            <a class="dropdown-item"
               data-toggle="modal"
               data-target="#modal-listagem-repositorios" style="cursor: pointer;">
                <i class="fa fa-database faa-pulse "></i> Repositórios Vinculados
            </a>
        </div>

    </div>
    @yield('dropdown_menu_ambiente_modelagem')

@endif
