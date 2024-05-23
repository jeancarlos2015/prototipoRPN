<div class="dropdown">
    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Funções
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

        <a class="dropdown-item"
           onclick="donwload('diagrama.bpmn','{!! $modelo->coddiagramaversionavel !!}','versionavel')"
           download="diagrama.bpmn"
           title="Donwload do BPMN">
            <p class="fa fa-download text-center" style="cursor: pointer;">Donwload</p>
            <span class="sr-only"></span>
        </a>


        <a class="dropdown-item"
        href="javascript:window.close()">
            <p class="fa fa-mail-reply text-center"> Fechar</p>
            <span class="sr-only"></span>
        </a>

        <a onclick="return confirm('Deseja Recuperar este Diagrama?');" class="dropdown-item"
           href="{!! route('controle_historico_diagramas_create',[$modelo->coddiagramaversionavel]) !!}">
            <p class="fa fa-window-restore text-center"> Usar Diagrama</p>
            <span class="sr-only"></span>
        </a>
    </div>

</div>
