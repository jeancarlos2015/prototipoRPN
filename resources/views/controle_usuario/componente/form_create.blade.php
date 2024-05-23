<div class="card-box">

    <div class="card-body">
        <div class="form-group">
            <label>Nome</label>
            <input style="background-color: gray;font-weight: bold;color: black;" name="name" class="form-control" placeholder="Nome" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input style="background-color: gray; font-weight: bold;color: black;" name="email" type="email" class="form-control" placeholder="Email" required>
        </div>
        @if(Auth::user()->EAdministrador())
            <div class="form-group">
                <label>Tipo</label><br>
                <select style="background-color: gray; font-weight: bold;color: black;" class="form-control" name="tipo" required>
                    @foreach(['PROPRIETARIO','COLABORADOR','CLIENTE'] as $tipo)

                        <option value="{!! $tipo !!}">{!! $tipo !!}</option>

                    @endforeach
                </select>

            </div>

        @else
            <input type="hidden" name="tipo" value="CLIENTE">
        @endif
        <div class="form-group">
            <label>Senha</label>
            <input style="background-color: gray; font-weight: bold;color: black;" name="password" type="password" class="form-control" placeholder="Senha" required>
        </div>
        <div class="form-group">
            <label>Confirmar Senha</label>
            <input style="background-color: gray; font-weight: bold;color: black;" name="password_confirm" type="password" class="form-control" placeholder="Repita Senha"
                   required>
        </div>
        <button type="submit" class="btn btn-dark form-control" style="width: 50%;margin-left: 25%">Cadastrar</button>
    </div>
</div>
