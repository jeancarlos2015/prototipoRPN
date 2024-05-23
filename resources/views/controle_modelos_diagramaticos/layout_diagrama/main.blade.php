<!DOCTYPE html>
<html>
<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
    #canvas img {
        display: none;
    }
</style>
@includeIf('layouts.admin.layouts.layout_principal.head')
@yield('css')

<body id="idAmbienteVisualizacaoDiagramaBody">
<div class="se-pre-con"></div>
@includeIf('controle_modelos_diagramaticos.layout_diagrama.nav')
@yield('head_body')
@includeIf('painel.modais.modais')
@yield('modal')
@includeIf('modais.chat.chat_modal')
@yield('content')

@includeIf('layouts.admin.layouts.layout_principal.scripts')
@yield('script_js')

</body>
</html>
