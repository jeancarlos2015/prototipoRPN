<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RPN - Repositório de Processos de Negócio">
    <meta name="author" content="Jean Carlos Penas">
    <title>RPN - Repositório de Processos de Negócios</title>
    <link rel="stylesheet" href="{!! asset('css/jquery-confirm.min.css') !!}">
    @auth
    <link rel="stylesheet" href="{!! asset('css/toggle-switch.css') !!}">
    @endauth
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('vendor/datatables/dataTables.bootstrap4.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/sb-admin.css') !!}" rel="stylesheet">
    <style type="text/css">
        .quebrapagina {
            page-break-before: always;
        }

    </style>

</head>
