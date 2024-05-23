@if(!empty($nomebotao))
    <div class="form-group">
        @if(empty($mensagem))
            <a style="cursor: pointer"
               onclick="confirmMensagemPersonalizado('{!! route($rota,[$id]) !!}','Deseja visualizar este modelo?')">
                <img
                    src="{!! asset('img/olho.png') !!} " style="width: 20px"
                    title="Visualizar"></a>
        @else



            <a style="cursor: pointer"
               onclick="confirmMensagemPersonalizado('{!! route($rota,[$id]) !!}','{!! $mensagem !!}')">
                <img
                    src="{!! asset('img/olho.png') !!} " style="width: 20px"
                    title="Visualizar"></a>

        @endif
    </div>
@elseif(!empty($rota_atualizacao))
    <div class="form-group">
        <a style="cursor: pointer"
           onclick="confirmMensagemPersonalizado('{!! route($rota_atualizacao,[$id]) !!}','Deseja recuperar este modelo?')"><img
                src="{!! asset('img/recover.png') !!} " style="width: 20px"
                title="Recuperar"></a>
    </div>
@elseif(!empty($rota_relatorio) && !empty($tipo_impressao))
    <div class="form-group">
        {{--        <a style="cursor: pointer" onclick="confirmMensagemPersonalizado('{!! route($rota_relatorio,[$id]) !!}','Deseja gerar este relatorio')"><img--}}
        {{--                src="{!! asset('img/impressao.png') !!} " style="width: 20px" title="Imprimir Relatório"></a>--}}
        <a onclick="confirmMensagemPersonalizadoRepositorio('{!! route($rota_relatorio,[$id]) !!}','Deseja gerar o relatorio deste Projeto?')"
           style="cursor: pointer;color: white"
           title="">
            <img src="{!! asset('img/impressao.png') !!} " style="width: 20px" title="Imprimir Relatório">
        </a>
    </div>
@else
    <div class="form-group">
        @if(!empty($mensagem))
            <a style="cursor: pointer"
               onclick="confirmMensagemPersonalizado('{!! route($rota,[$id]) !!}', '{!! $mensagem !!}')">
                <i id="editar2020" class="fa fa-pencil fa-2x" style="color:black;" title="Editar"></i>
            </a>
        @else
            <a style="cursor: pointer"
               onclick="confirmMensagemPersonalizado('{!! route($rota,[$id]) !!}', 'Deseja editar este modelo?')">
                <i id="editar2020" class="fa fa-pencil fa-2x" style="color:black;" title="Editar"></i>
            </a>
        @endif

    </div>
@endif

