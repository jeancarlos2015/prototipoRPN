
@if(Auth::user()->EAdministrador() || Auth::getUser()->codusuario==$usuario->codusuario)
    <div class="card form-group">
        @includeIf('controle_usuario.componente.edicao_de_usuarios')
    </div>
@endif
