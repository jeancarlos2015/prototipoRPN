<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1">
        <i class="fa fa-fw fa-list faa-pulse "></i>
        <span class="nav-link-text">Sistema</span>
    </a>

    <ul class="sidenav-second-level collapse" id="collapseComponents1">

        <li>
            <a href="{!! route('painel') !!}"><i class="fa fa-fw fa-pencil faa-pulse "></i>Painel</a>
        </li>
        <li>
            <a href="{!! route('controle_mensagens_index',[Auth::user()->codusuario]) !!}"><i class="fa fa-fw fa-pencil faa-pulse "></i>Mensagens</a>
        </li>
        <li>
            <a href="{!! route('todos_modelos') !!}"><i class="fa fa-fw fa-pencil faa-pulse "></i>Modelos</a>
        </li>

        <li>
            <a href="{!! route('todas_regras') !!}"><i class="fa fa-fw fa-pencil faa-pulse "></i>Regras</a>
        </li>
        <li>
            <a href="{!! route('todos_objetos_fluxos') !!}"><i class="fa fa-fw fa-pencil faa-pulse "></i>Objetos De Fluxo</a>
        </li>
        <li>
            <a href="{!! route('todos_projetos') !!}"><i class="fa fa-fw fa-pencil faa-pulse "></i>Processos</a>
        </li>

        @if(Auth::getuser()->EAdministrador())
            <li>
                <a href="{!! route('controle_repositorios.index') !!}"><i
                            class="fa fa-fw fa-pencil faa-pulse "></i>Repositórios</a>
            </li>
        @elseif(in_array(Auth::user()->papel(),['ADMINISTRADOR']))
            <li>
                <a href="{!! route('controle_repositorios.create') !!}"><i
                            class="fa fa-fw fa-pencil faa-pulse "></i>Criar Repositório</a>
            </li>
        @endif

        @yield('menu_modelo')

    </ul>
</li>
