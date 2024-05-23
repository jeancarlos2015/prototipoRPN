@auth
<!DOCTYPE html>
<html lang="en">
@includeIf('layouts.admin.layouts.layout_principal.head')
<body class="fixed-nav sticky-footer" id="page-top">
@includeIf('menu.nav')
{{--<div class="content-wrapper" style="background-color: #d19b3d">--}}
{{--    @includeIf('layouts.admin.layouts.layout_principal.content')--}}
{{--    @includeIf('layouts.admin.layouts.layout_principal.footer')--}}
{{--    @includeIf('layouts.admin.layouts.layout_principal.scripts')--}}
{{--</div>--}}
@includeIf('layouts.admin.layouts.layout_principal.content')
@includeIf('layouts.admin.layouts.layout_principal.footer')
@includeIf('layouts.admin.layouts.layout_principal.scripts')
</body>
</html>
@endauth
