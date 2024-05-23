<form method="post" action="{!! route('controle_configuracao_modelagem.store') !!}" style="background-color: white;">
    @csrf
    @method('POST')
    @includeIf('configuracao_menu_ambiente_modelagem.componentes.campos')
</form>