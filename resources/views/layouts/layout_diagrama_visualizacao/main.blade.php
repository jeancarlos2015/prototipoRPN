<!DOCTYPE html>
<html>
@includeIf('layouts.layout_diagrama_visualizacao.head')
<style>
    #canvas img{
        display: none;
    }
    #canvas, body, html{
        top: 0;
    }
</style>
<body id="bodyModeloPublico">
<div class="se-pre-con"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="display: none">
    @includeIf('menu.nav_menu_titulo')
    <div class="collapse navbar-collapse" id="navbarResponsive">
        @includeIf('menu.nav_menu_superior')
    </div>
</nav>
@yield('modal')
@yield('content')
@yield('script_js')
</body>
</html>
