@includeIf('controle_modelos.componentes.campos',['codprojeto' => $codprojeto])

@if(Auth::getUser()->TemPermissaoParaEditar())
    @if(empty($modelo))
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja tornar este Modelo/Representação Público?',
        ])
    @else
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja tornar este Modelo/Representação Público?',
        'objeto' => $modelo
        ])
    @endif
@else
    <input type="hidden" name="publico" value="true">
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
