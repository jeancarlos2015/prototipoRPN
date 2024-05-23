<!DOCTYPE html>
<html lang="en">

@includeIf('controle_modelo_declarativo1.layouts.wizard1.head')
{{--@includeIf('layouts.home.head')--}}
<body>

<!-- Top menu -->
@includeIf('controle_modelo_declarativo1.layouts.wizard1.menu')
{{--@includeIf('layouts.home.nav')--}}
<!-- Top content -->
{{--@includeIf('controle_modelo_declarativo1.layouts.wizard1.content')--}}
@yield('content')

<!-- Javascript -->
@includeIf('controle_modelo_declarativo1.layouts.wizard1.script')

</body>

</html>