@includeIf('controle_projetos.componentes.campos')
@if(!empty($codrepositorio))
    <input type="hidden" name="codrepositorio" class="form-control"
           value="{!! $codrepositorio !!}">
@endif
@if( Auth::getuser()->TemPermissaoParaEscluir())
    @if(empty($projeto))
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja tornar este processo público?',
        ])
    @else
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja tornar este processo público?',
        'objeto' => $projeto
        ])
    @endif
@else
    <input type="hidden" name="publico" value="true">
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
