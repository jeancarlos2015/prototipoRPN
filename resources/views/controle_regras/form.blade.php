@includeIf('controle_regras.componentes.campos')
@if(!empty($codrepositorio))
    <input type="hidden" name="codrepositorio" class="form-control"
           value="{!! $codrepositorio !!}">
@endif
@if(Auth::getuser()->EProprietario())
    @if(empty($regra))

        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar esta Regra?',
        ])
    @else

        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar esta Regra?',
        'objeto' => $regra
        ])

    @endif
@else
    <input type="hidden" name="publico" value="true">
@endif

<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
