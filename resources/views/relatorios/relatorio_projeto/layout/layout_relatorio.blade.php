<!DOCTYPE html>
<html lang="en">
@includeIf('relatorios.relatorio_projeto.componentes.head')
<body>
<div class="container-fluid">

    <div class="card">


            @yield('content')

    </div>
</div>
</body>
@include('layouts.admin.layouts.layout_principal.scripts')
</html>
