<li class="nav-item">
    @if(!empty($nome_modelo) && !empty($visualizacao_modelo))
        {{--        <a class="nav-link"  href="{!! route('painel') !!}">--}}
        {{--            <i class="fa fa-eye" title="{!! $nome_modelo !!}"> </i>--}}
        {{--            <span class="sr-only"></span>--}}
        {{--        </a>--}}

    @elseif(!empty($nome_titulo_menu) && !empty($nome_modelo))
            <a class="nav-link" data-toggle="modal" id="limpar_cache"
               data-target="#modal-nome-modelo">
                <p class="fa fa-info faa-pulse "> {!! $nome_modelo !!}</p>
                <span class="sr-only"></span>
            </a>

    @elseif(!empty($descricao_titulo_menu) || !empty($nome_repositorio))
{{--        <a class="nav-link" data-toggle="modal"--}}
{{--           data-target="#modal-nome-repositorio">--}}
{{--            <i class="fa fa-info"--}}
{{--               title="{!! isset($descricao_titulo_menu) ? $descricao_titulo_menu :  $nome_repositorio!!}"></i>--}}
{{--            <span class="sr-only"></span>--}}
{{--        </a>--}}

    @elseif(!empty($nome_repositorio) && (!empty($tela) && $tela=='modelo'))
        <a class="nav-link" data-toggle="modal" id="limpar_cache"
           data-target="#modal-nome-repositorio">
            <i class="fa fa-database faa-pulse " title="{!! $nome_repositorio !!}"></i>
            <span class="sr-only"></span>
        </a>
    @endif

</li>

