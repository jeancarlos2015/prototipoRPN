<div id="canvas" style="background-color: #EAEAEA"></div>
{{--<div class="form-group btn-toggle1" id="descricao-label-id1" style="display: none;margin-top: 40%;">--}}
{{--    <label class="descricao-label">--}}
{{--        Modelo: {!! $modelo->modelo->nome !!} <br>--}}
{{--        Projeto: {!! $modelo->projeto->nome !!} <br>--}}
{{--        Repositório: {!! $modelo->repositorio->nome !!}<br>--}}
{{--        Autor: {!! $modelo->usuario->name !!}--}}
{{--    </label>--}}
{{--</div>--}}
@if(isset($modelo))
    <script>

        window.onload = function () {
            openDiagram('{!! $modelo->codmodelodiagramatico  !!}');
        }
    </script>
@endif
