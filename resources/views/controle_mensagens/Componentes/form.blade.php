<form action="{!! route('controle_mensagens_store') !!}" method="post">
    @method('POST')
    @csrf
    <div class="form-group">
        <label for="assunto">Assunto</label>
        <input type="text" class="form-control" placeholder="Assunto" name="assunto">
    </div>
    <div class="form-group">
        <label for="texto">Texto</label>
        <textarea class="form-control" name="texto"></textarea>
    </div>
    <div class="form-group">
        <label for="usuarios">Destinatários</label>
        <div class="subject-info-box-1">
            <select multiple="multiple" class="form-control" name="codusuarios[]">
                @foreach($usuarios as $usuario)
                    @if(Auth::getUser()->EAdministrador() || Auth::getUser()->EProprietario())
                        <option value="{!! $usuario->codusuario !!}">{!! $usuario->name !!} - {!! $usuario->email
                         !!} - {!! $usuario->papel() !!}</option>
                    @else
                        <option value="{!! $usuario->codusuario !!}">{!! $usuario->name !!}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-dark form-control">Enviar Mensagem</button>
</form>