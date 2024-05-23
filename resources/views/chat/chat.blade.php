@extends('layouts.layout_diagrama_visualizacao.main')
@section('content')
    <ul id="messages"></ul>
    <form action="" id="formulario2020" style="margin-top: 50px;">
        <input id="m" autocomplete="off"/>
        <button class="btn btn-primary">Enviar</button>
    </form>
@endsection

@section('boltao_voltar')
    @includeIf('componentes.Voltar')
@endsection

@section('codigo_css')
    <style>
        /** {*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    box-sizing: border-box;*/
        /*}*/


        #formulario2020 {
            background: transparent;
            padding: 3px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        #formulario2020 input {
            border: 0;
            padding: 10px;
            width: 70%;
            margin-right: .5%;
            background-color: gray;
        }

        #formulario2020 button {
            width: 25%;
            border: none;
            padding: 10px;
        }

        #messages {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #messages li {
            padding: 5px 10px;
        }

        #messages li:nth-child(odd) {
            background: #eee;
        }

        #messages {
            margin-bottom: 40px
        }
    </style>
@endsection

@section('script_js')
    @includeIf('chat.scripts.script')
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
{{--    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>--}}
    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
    @if(Auth::getuser()->EAdministrador())
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('form').submit(function () {
                    socket.emit('chat message','[ADMINISTRADOR] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                socket.on('chat message', function (msg) {
                    $('#messages').append($('<li>').text(msg));
                    window.scrollTo(0, document.body.scrollHeight);
                });
            });
        </script>
    @elseif(Auth::user()->papel()=='PROPRIETARIO')
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('form').submit(function () {
                    socket.emit('chat message','[PROPRIETARIO] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                socket.on('chat message', function (msg) {
                    $('#messages').append($('<li>').text(msg));
                    window.scrollTo(0, document.body.scrollHeight);
                });
            });
        </script>
    @elseif(Auth::user()->papel()=='COLABORADOR')
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('form').submit(function () {
                    socket.emit('chat message','[COLABORADOR] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                socket.on('chat message', function (msg) {
                    $('#messages').append($('<li>').text(msg));
                    window.scrollTo(0, document.body.scrollHeight);
                });
            });
        </script>
    @elseif(Auth::user()->papel()=='CLIENTE')
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('form').submit(function () {
                    socket.emit('chat message','[CLIENTE] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                socket.on('chat message', function (msg) {
                    $('#messages').append($('<li>').text(msg));
                    window.scrollTo(0, document.body.scrollHeight);
                });
            });
        </script>
    @endif
@endsection
