<tr>
    @if(!empty($modelo1->tipo))
        <td>
            @if($modelo1->tipo==='bpmn')
                @includeIf('layouts.admin.componentes.representacao_diagramatica')
            @else
                @includeIf('layouts.admin.componentes.representacao_declarativa',[
                'rota' => 'controle_modelos_declarativos.show',
                'id' => $modelo1->codmodelodeclarativo
                ])
            @endif
        </td>

        <td>
            @if($modelo1->tipo==='bpmn')
                @includeIf('layouts.admin.componentes.representacao_diagramatica_rota')
            @else
                @includeIf('layouts.admin.componentes.representacao_declarativa_rota')
            @endif
        </td>
    @else
        <td>
            @includeIf('layouts.admin.componentes.representacao_declarativa',[
               'rota' => 'controle_modelos.show',
               'id' => $modelo1->codmodelo
               ])
        </td>
        <td>
            @if(!empty($modelo1->representacao_diagramatica))
                @includeIf('layouts.admin.componentes.representacao_diagramatica_rota',[
                'modelo1' => $modelo1->representacao_diagramatica
                ])
            @endif
        </td>

    @endif
</tr>