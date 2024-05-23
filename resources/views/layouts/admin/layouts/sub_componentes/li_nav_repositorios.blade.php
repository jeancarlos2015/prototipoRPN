@if(Auth::user()->existe_repositorio())
   @includeIf('layouts.admin.layouts.sub_componentes.menu_repositorios')
@endif