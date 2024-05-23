<form method="post" action="{!! route('controle_configuracao_modelagem.update',[$configuracao->codconfiguracaoambientemodelagem]) !!}" style="background-color: white;">
    @csrf
    @method('PUT')
    @includeIf('configuracao_menu_ambiente_modelagem.componentes.campos')
</form>
