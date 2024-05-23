<tr>
    @if(!empty($titulos))
        @foreach($titulos as $titulo1)
            <th>{!! $titulo1 !!}</th>
        @endforeach
    @endif
    @if(Auth::getuser()->EAdministrador() && $tipo=='repositorio')
        <th>Atribuição</th>
    @endif
</tr>
