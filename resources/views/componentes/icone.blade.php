@if(!empty($rota) && !empty($id))
    <a class="nav-link"
       href="{!! route($rota,[$id]) !!}" @if(!empty($descricao_titulo_menu)) title="{!! $descricao_titulo_menu !!}" @endif>
        @if(!empty($nome))
            <p class="{!! $ico !!}"> {!! $nome !!} </p>
        @else
            <i class="{!! $ico !!}"></i>
        @endif
        <span class="sr-only"></span>
    </a>
@endif
