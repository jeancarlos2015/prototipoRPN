<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editor RPN</title>
<meta charset="utf-8">
@includeIf('layouts.admin.layouts.layout_principal.css')
<script src="{!! asset('ckeditor/ckeditor.js') !!}"></script>
<script src="{!! asset('ckeditor/samples/js/sample.js') !!}"></script>
    @Auth
        @yield('token')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endauth
<meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        #lista {
            list-style-type: none;
        }

        #lista li {
            float: left;
        }
        #lista li input{
            margin-top: 2px;
            margin-left: 10px; width: 250px;
        }
        #item {
            display: block;
            text-align: center;
            padding: 16px;
            text-decoration: none;

        }

    </style>
</head>
<body id="main" class="fixed-nav sticky-footer">
@includeIf('menu.nav')

@yield('conteudo')

@includeIf('layouts.admin.layouts.layout_principal.footer')
@includeIf('layouts.admin.layouts.layout_principal.scripts')
</body>
</html>
