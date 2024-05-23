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
{{--<div class="content-wrapper" style="background-color: #00a67c">--}}
{{--    @includeIf('layouts.admin.layouts.layout_principal.content')--}}
{{--    @includeIf('layouts.admin.layouts.layout_principal.footer')--}}
{{--    @includeIf('layouts.admin.layouts.layout_principal.scripts')--}}
{{--</div>--}}
@includeIf('layouts.admin.layouts.layout_principal.content')
@includeIf('layouts.admin.layouts.layout_principal.footer')
@includeIf('layouts.admin.layouts.layout_principal.scripts')
{{--<script>--}}
{{--    ClassicEditor--}}
{{--        .create(document.querySelector('#editor'))--}}
{{--        .then(editor => {--}}
{{--            console.log(editor);--}}
{{--        })--}}
{{--        .catch(error => {--}}
{{--            console.error(error);--}}
{{--        });--}}
{{--</script>--}}
</body>
</html>
@endauth
