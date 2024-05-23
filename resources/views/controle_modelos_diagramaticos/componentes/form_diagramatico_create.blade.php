<form action="{!! route('salvar_diagrama') !!}" method="post" enctype="multipart/form-data">
    @method('POST')
    @csrf
    @includeIf('controle_modelos_diagramaticos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codmodelo' => $modelo->codmodelo
    ])
</form>
