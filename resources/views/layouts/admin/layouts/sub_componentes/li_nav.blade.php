<li class="nav-item para-canto">
    @if(!empty($rota))
        <a class="nav-link"
           href="{!! route($rota) !!}" @if(!empty($descricao_titulo_menu)) title="{!! $descricao_titulo_menu !!}" @endif>
            @if(!empty($nome))
                <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"> {!! $nome !!} </i>
            @else
                <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"></i>
            @endif
            <span class="sr-only"></span>
        </a>
    @elseif(!empty($rota_historico))
        <a class="nav-link"
           href="{!! route($rota_historico,[$id]) !!}" @if(!empty($descricao_titulo_menu)) title="{!! $descricao_titulo_menu !!}" @endif>
            @if(!empty($nome))
                <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"> {!! $nome !!} </i>
            @else
                <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"></i>
            @endif
            <span class="sr-only"></span>
        </a>
    @else
        @if(!empty($link))

            <a class="nav-link"
               href="{!! $link !!}" @if(!empty($descricao_titulo_menu)) title="{!! $descricao_titulo_menu !!}" @endif>
                @if(!empty($nome))
                    <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"> {!! $nome !!} </i>
                @else
                    <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"></i>
                @endif
                <span class="sr-only"></span>
            </a>
        @else
            <a class="nav-link" onclick="refresh(this)" @if(!empty($descricao_titulo_menu)) title="{!! $descricao_titulo_menu !!}" @endif>
                @if(!empty($nome))
                    <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"> {!! $nome !!} </i>
                @else
                    <i @if(!empty($id)) id="{!! $id !!}" @endif class="{!! $ico !!}"></i>
                @endif
                <span class="sr-only"></span>
            </a>
        @endif
    @endif
</li>
