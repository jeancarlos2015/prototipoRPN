@auth
<!DOCTYPE html>
<html lang="en">
@includeIf('layouts.admin.layouts.layout_principal.head')
<style>
    body{
        background-image: url("{!! asset('../img/water.png') !!}");
    }
</style>
<body class="fixed-nav sticky-footer" id="page-top">
<div class="se-pre-con"></div>
@includeIf('menu.nav')
{{--<div class="content-wrapper" style="background-color: #5f5f5f">--}}
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
