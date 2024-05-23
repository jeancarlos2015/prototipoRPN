<!DOCTYPE html>
<html>
@includeIf('layouts.admin.layouts.head')
<body>
@includeIf('controle_modelos_diagramaticos.layout_diagrama.nav')
@includeIf('controle_modelos_diagramaticos.layout_diagrama.head_body')

@yield('content')
@include('flash::message')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@includeIf('controle_modelos_diagramaticos.layout_diagrama.script')
</body>
</html>
