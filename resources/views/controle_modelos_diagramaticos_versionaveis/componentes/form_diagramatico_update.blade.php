<form action="{!! route('atualizar_diagrama',['id' => $representacao_diagramatica->codmodelodiagramatico]) !!}" method="post">
    @method('PUT')
    @csrf
    @includeIf('controle_modelos_diagramaticos.form',
    [
    'acao' => 'Atualizar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'organizacao_id' => $representacao_diagramatica->repositorio->codrepositorio,
    'projeto_id' => $representacao_diagramatica->projeto->codprojeto
    ]
    )

</form>
