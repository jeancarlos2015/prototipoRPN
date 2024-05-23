
@includeIf('controle_modelos_diagramaticos.componentes.campos')

@if(Auth::getuser()->EProprietario() || Auth::getuser()->EAdministrador())
    @if(empty($representacao_diagramatica))
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar este modelo?',
        ])
    @else
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar este modelo?',
        'objeto' => $representacao_diagramatica
        ])
    @endif
@else
    <input type="hidden" name="publico" value="true">
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>