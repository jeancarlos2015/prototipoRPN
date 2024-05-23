@if(Auth::getUser()->email=='jfkdslajfkdlas@gmail.com')
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

        #conteudo {
            margin-bottom: 50%;
        }

        #formulario2020 input {
            border: 0;
            padding: 10px;
            width: 60%;
            margin-right: .5%;
            background-color: gray;
        }

        #formulario2020 button {
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

    @yield('socket_js')
    @if(Auth::user()->EAdministrador())
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('#enviar123').click(function () {
                    socket.emit('chat message', '[ADMINISTRADOR] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                $('#limpar123').click(function () {
                    $('#messages').empty();
                    return false;
                });
                socket.on('chat message', function (msg) {
                    if (msg !== '') {
                        var n = $('#messages li').length;
                        if (n < 11) {
                            $('#messages').append($('<li>').text(msg));
                        } else {
                            $('#messages').append($('<li>').text(msg));
                            $('#messages li').first().remove();
                        }
                        window.scrollTo(0, document.body.scrollHeight);
                    }
                });
            });
        </script>
    @elseif(Auth::user()->papel()=='PROPRIETARIO')
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('#enviar123').click(function () {
                    socket.emit('chat message', '[PROPRIETARIO] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                $('#limpar123').click(function () {
                    $('#messages').empty();
                    return false;
                });
                socket.on('chat message', function (msg) {
                    if (msg !== '') {
                        var n = $('#messages li').length;
                        if (n < 11) {
                            $('#messages').append($('<li>').text(msg));
                        } else {
                            $('#messages').append($('<li>').text(msg));
                            $('#messages li').first().remove();
                        }
                        window.scrollTo(0, document.body.scrollHeight);
                    }

                });
            });
        </script>
    @elseif(Auth::user()->papel()=='COLABORADOR')
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('#enviar123').click(function () {
                    socket.emit('chat message', '[COLABORADOR] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                $('#limpar123').click(function () {
                    $('#messages').empty();
                    return false;
                });
                socket.on('chat message', function (msg) {
                    if (msg !== '') {
                        var n = $('#messages li').length;
                        if (n < 11) {
                            $('#messages').append($('<li>').text(msg));
                        } else {
                            $('#messages').append($('<li>').text(msg));
                            $('#messages li').first().remove();
                        }
                        window.scrollTo(0, document.body.scrollHeight);
                    }
                });
            });
        </script>
    @elseif(Auth::user()->papel()=='CLIENTE')
        <script>
            $(function () {
                var socket = io('https://chatrpn.herokuapp.com');
                $('#enviar123').click(function () {
                    socket.emit('chat message', '[CLIENTE] {!! Auth::user()->name !!} :' + $('#m').val());
                    $('#m').val('');
                    return false;
                });
                $('#limpar123').click(function () {
                    $('#messages').empty();
                    return false;
                });
                socket.on('chat message', function (msg) {
                    if (msg !== '') {
                        var n = $('#messages li').length;
                        if (n < 11) {
                            $('#messages').append($('<li>').text(msg));
                        } else {
                            $('#messages').append($('<li>').text(msg));
                            $('#messages li').first().remove();
                        }
                        window.scrollTo(0, document.body.scrollHeight);
                    }
                });
            });
        </script>
    @endif

    <script>


    </script>
    <div class="modal fade " id="modal-chat2020">

        <div class="modal-dialog modal-full">

            <div class="modal-content" style="height: 550px;">

                <div class="modal-header">
                    <h2><img
                            src="{!! asset('img/batepapo.png') !!} " style="width: 60px"
                            title="Desvalidar"> Bate Papo</h2>
                </div>
                <div class="modal-body">

                    <ul id="messages"></ul>


                    <form action="" id="formulario2020" style="margin-top: 50px;">
                        <input id="m" autocomplete="off"/>
                        <button id="enviar123" class="btn btn-p'rimary" style="width: 15%;">Enviar</button>
                        <button id="limpar123" class="btn btn-primary" style="width: 15%">Limpar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif



