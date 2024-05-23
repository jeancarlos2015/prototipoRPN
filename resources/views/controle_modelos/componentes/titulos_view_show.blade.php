<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-database"></i> Repositório: {!! $modelo_viwer->modelo->repositorio->nome !!}</a></li>
<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-dashboard"></i> Painel</a></li>
<li class="breadcrumb-item"><a  href="{!! route('todos_projetos') !!}" > <i class="fa fa-project-diagram"></i> Processos</a></li>

<li class="breadcrumb-item"><a href="{!! route('controle_modelos_index',[$modelo_viwer->modelo->codprojeto]) !!}"> <i class="fa fa-eye"></i> Projeto: {!! $modelo_viwer->modelo->projeto->nome !!}</a></li>

<li class="breadcrumb-item active"><a  href="#" ><i class="fa fa-eye"></i> Exibição do Modelo: {!! $modelo_viwer->modelo->nome !!}</a></li>