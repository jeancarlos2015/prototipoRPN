@if(!empty($modelo))
    <li class="nav-item">
        <a class="nav-link"
           href="{!! route('controle_modelos_diagramaticos_index',[$modelo->codmodelo]) !!}" title="Voltar">
            <p class="fa fa-mail-reply"></p>
            <span class="sr-only"></span>
        </a>
    </li>
@endif
