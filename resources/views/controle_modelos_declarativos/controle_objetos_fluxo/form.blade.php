@includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.campos')
@if(Auth::getUser()->EProprietario())
    @if(empty($objeto_fluxo))
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar esta Objeto de Fluxo?',
        ])
    @else
        @includeIf('componentes.botao_sim_nao',[
        'name' => 'publico',
        'pergunta' => 'Deseja publicar este Objeto de Fluxo?',
        'objeto' => $objeto_fluxo
        ])
    @endif
@else
    <input type="hidden" name="publico" value="true">
@endif
<div class="form-group">
    <button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
</div>
