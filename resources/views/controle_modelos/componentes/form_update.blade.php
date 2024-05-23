<form action="{!! route('controle_modelos.update',['id' => $modelo->codmodelo]) !!}" method="post">
    @method('PUT')
    @csrf
    @includeIf('controle_modelos.form',
    [
    'acao' => 'Atualizar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'organizacao_id' => $modelo->repositorio->codrepositorio,
    'codprojeto' => $modelo->projeto->codprojeto
    ]
    )

</form>
