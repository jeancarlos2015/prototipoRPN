@if(!empty($modelos))
    <tbody>
    @foreach($modelos as $modelo)
        @if(!empty($modelo->representacao_diagramatica))
            @includeIf('componentes.modelo',['modelo1' => $modelo->representacao_diagramatica])
        @elseif(!empty($modelo->representacao_declarativa))
            @includeIf('componentes.modelo',['modelo1' => $modelo->representacao_declarativa])
        @elseif($modelo->tipo==='bpmn')
            @includeIf('componentes.modelo',['modelo1' => $modelo])
        @endif
    @endforeach
    </tbody>
@endif