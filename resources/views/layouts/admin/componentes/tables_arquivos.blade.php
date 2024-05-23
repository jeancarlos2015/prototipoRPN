@if(!empty($arquivos))
    <tbody>
    @foreach($arquivos as $arquivo)
        @includeIf('layouts.admin.componentes.arquivo')
    @endforeach
    </tbody>
@endif
