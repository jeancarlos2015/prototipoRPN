
@includeIf('controle_repositorios.componentes.campos')

@if(empty($repositorio))
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'publico',
    'pergunta' => 'Deseja tornar este Repositório Público?',
    ])
@else
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'publico',
    'pergunta' => 'Deseja tornar este Repositório Público?',
    'objeto' => $repositorio
    ])
@endif

<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>

