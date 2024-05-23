<div class="card-box">
    <div class="card-body">
        <div class="form-group">
            <label>Nome</label>
            <input id="idCampoNome" name="name" class="form-control" placeholder="Nome" value="{!! $usuario->name !!}"
                required>
        </div>
        @if (Auth::user()->EAdministrador())
            <div class="form-group">
                <label>Tipo</label><br>
                <select class="form-control" id="idTipoUsuario" name="tipo" required>
                    @if (Auth::getUser()->email == 'jeancarlospenas25@gmail.com' || Auth::getUser()->email == 'mbarcosta@gmail.com')
                        @foreach (['ADMINISTRADOR', 'PROPRIETARIO', 'COLABORADOR', 'CLIENTE', 'PADRAO'] as $tipo)
                            @if ($tipo == $usuario->tipo)
                                <option value="{!! $tipo !!}" selected>
                                    <strong>{!! $tipo !!}</strong></option>
                            @else
                                <option value="{!! $tipo !!}">{!! $tipo !!}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach (['PROPRIETARIO', 'COLABORADOR', 'CLIENTE', 'PADRAO'] as $tipo)
                            @if ($tipo == $usuario->tipo)
                                <option value="{!! $tipo !!}" selected>{!! $tipo !!}</option>
                            @else
                                <option value="{!! $tipo !!}">{!! $tipo !!}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>

        @else
            <div class="form-group">
                <input id="idTipoUsuario" type="hidden" name="{!! $usuario->tipo !!}" value="{!! $usuario->tipo !!}">
            </div>
        @endif
        <div class="form-group">
            <label>Email</label>
            <input id="idCampoEmail" name="email" type="email" class="form-control" placeholder="Email"
                value="{!! $usuario->email !!}" required>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input id="idCampoSenha" name="password" type="password" class="form-control" placeholder="Senha" required>
        </div>

        <div class="form-group">
            <label>Confirmar Senha</label>
            <input id="idCampoSenhaConfirm" name="password_confirm" type="password" class="form-control"
                placeholder="Repita Senha" required>
        </div>
        <button onclick="alterarUsuario('{!! $usuario->codusuario !!}')" class="btn btn-dark form-control"
            style="width: 50%;margin-left: 25%">Atualizar</button>
    </div>
</div>
