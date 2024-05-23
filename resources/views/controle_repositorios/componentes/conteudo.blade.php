<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" > Painel</a></li>
<li class="breadcrumb-item"><a  href="#" > Repositórios</a></li>
<li class="breadcrumb-item active"><a  href="#" > Criação de Repositório</a></li>

@includeIf('controle_repositorios.componentes.form_repositorio_create')

@if(!empty($repositorio))
    <div class="alert alert-warning">
        <strong>Warning!</strong> O repositório já existe, para acessá-lo clique neste <a
                href="{!! route('controle_repositorios.show',[$repositorio->codrepositorio]) !!}"
                class="link">Link</a>.
    </div>
@endif