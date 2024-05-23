@if(count($projeto->modelos)>0)
    @foreach($projeto->modelos as $modelo)
        @if(count($modelo->objetos_fluxos)>0)
            @includeIf('relatorios.relatorio_projeto.componentes.item_relatorio',[
              'modelo' => $modelo
              ])
        @endif
    @endforeach
@endif