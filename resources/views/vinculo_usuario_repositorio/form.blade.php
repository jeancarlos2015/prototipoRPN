<div class="form-group">
    @if(!empty($tipos))
        <label>Tipo De Usuário</label>
        <select class="selectpicker form-control" name="tipo">
            @foreach($tipos as $tipo)
                <option value="{!! $tipo !!}">{!! $tipo !!}</option>
            @endforeach
        </select>
    @endif

    <label>Repositórios</label>
    <select class="selectpicker form-control" name="codrepositorio">
        @foreach($repositorios as $repositorio)
            <option value="{!! $repositorio->codrepositorio !!}">{!! $repositorio->nome !!}</option>
        @endforeach
    </select>

</div>
<div class="form-group">

    <input type="text" value="{!! $usuario->name !!}" class="form-control" disabled/>

</div>

<input type="hidden" value="{!! $usuario->codusuario !!}" name="codusuario"/>
<input type="hidden" value="true" name="vinculo">
<button type="submit" class="btn btn-dark form-control">Vincular Usuário</button>