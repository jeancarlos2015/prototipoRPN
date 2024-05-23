@if(!$repositorio->foiSolicitado())
    <a
        width="50"
        onclick="solicitarEntradaNoRepositorio('{!! $repositorio->codrepositorio !!}','controle_solicitacao_usuario','solicitacao')"
        title="Participar" style="cursor: pointer;">
        <img id="imagemRepositorio{{$repositorio->codrepositorio}}" src="{!! asset('img/door-ico.ico') !!}" width="50">
    </a>
@else
    <input id="imagemRepositorio{{$repositorio->codrepositorio}}" type="image" src="{!! asset('img/playng.png') !!}" alt="Submit" width="50" title="Solicitado" disabled>
@endif
