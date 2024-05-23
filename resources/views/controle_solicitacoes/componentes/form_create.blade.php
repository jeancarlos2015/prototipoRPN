<form action="{!! route('controle_modelos.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_modelos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codrepositorio' => $projeto->repositorio->codrepositorio,
    'codprojeto' => $projeto->codprojeto
    ])
</form>