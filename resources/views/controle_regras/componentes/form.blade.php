<form action="{!! route('controle_regras.update',[$regra->codregra]) !!}" method="post">
    @method('PUT')
    @csrf
    @includeIf('controle_regras.form',[
    'MAX' => 1,
     'acao' => 'Atualizar Regra'
    ])
</form>
