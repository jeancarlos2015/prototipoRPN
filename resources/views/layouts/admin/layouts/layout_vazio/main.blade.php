@auth
<!DOCTYPE html>
<html lang="en">
@includeIf('layouts.admin.layouts.layout_principal.head')
<body class="fixed-nav sticky-footer" id="page-top">
@includeIf('layouts.admin.layouts.layout_vazio.componentes.menu_vazio')
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
@yield('content')
@includeIf('layouts.admin.layouts.layout_principal.footer')
@includeIf('layouts.admin.layouts.layout_principal.scripts')
</body>
</html>
@endauth
