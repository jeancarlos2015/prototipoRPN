@includeIf('controle_modelos.componentes.campos')

@if(Auth::getuser()->EstaLiberado())
    @if(empty($modelo))
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar este Modelo/Representação?',
        ])
    @else
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar este Modelo/Representação?',
        'objeto' => $modelo
        ])
    @endif
@else
    <input type="hidden" name="publico" value="true">
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>