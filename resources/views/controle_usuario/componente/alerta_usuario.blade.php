@if(!empty($user))
    <div class="alert alert-warning">
        @if($user->tipo!=='Administrador')
            <strong>Warning!</strong> O usuário já existe, para editá-lo clique neste <a
                    href="{!! route('controle_usuarios.edit',[$user->codusuario]) !!}" class="link">Link</a>.
        @else
            <strong>Warning!</strong> O usuário já existe.
        @endif
    </div>
@endif