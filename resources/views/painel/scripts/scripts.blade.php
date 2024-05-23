@if(Auth::getuser()->EAdministrador())
    @if(!empty(Auth::getUser()->repositorio))
        @includeIf('controle_repositorios.componentes.scripts_repositorio')
    @endif
@endif
@if(Auth::getUser()->existe_repositorio() && Auth::getUser()->papel() != 'ADMINISTRADOR' && !Auth::getUser()->usuario_esta_no_repositorio())
    <script>
        $(document).ready(function () {
            $('#modal-aviso-existencia-repositorio').modal('show');

        })
    </script>
@endif


