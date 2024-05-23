<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents243444"
       data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-cogs faa-pulse "></i>
        <span class="nav-link-text">Relatórios</span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseComponents243444">
        <li>
            <a href="{!! route('controle_relatorios_graficos_index',['codrelatorio'=> 0,'codrepositorio' => Auth::user()->codrepositorio])!!}"><i class="fa fa-fw fa-pencil faa-pulse "></i>Gráfico de Barra</a>
        </li>
    </ul>
</li>
