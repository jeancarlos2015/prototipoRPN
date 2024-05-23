@if(!empty($modelo->codmodelo))
    <form action="{!! route('controle_modelos_declarativos.store') !!}" method="post">
        @csrf
        @method('POST')
        @includeIf('controle_modelos_declarativos.modelos_declarativos.form',
        [
        'acao' => 'Salvar e Proseguir',
        'dados' => $dados,
        'MAX' => 2,
        'codmodelo' => $modelo->codmodelo,
        ])
    </form>

@endif