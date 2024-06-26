@includeIf('controle_modelos_declarativos.controle_regras.componentes.campos')
@includeIf('controle_modelos_declarativos.controle_regras.componentes.select_padroes_binario')
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

<div class="form-group">
    <button type="submit" class="btn btn-dark form-control">Criar Regra</button>
</div>
@includeIf('controle_modelos_declarativos.controle_regras.componentes.script')
