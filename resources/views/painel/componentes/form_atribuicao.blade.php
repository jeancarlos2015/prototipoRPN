{{--<form onsubmit="return confirm('Deseja participar da organização?');"--}}
{{--      action="{!! route('vincular_usuario_repositorio_publico') !!}" method="post"--}}
{{--      style="display: inline-block">--}}
{{--    @csrf--}}
{{--    @method('POST')--}}

{{--    <input type="hidden" value="{!! $repositorio->codrepositorio !!}" name="codrepositorio">--}}
{{--    <input type="hidden" value="{!! Auth::getUser()->codusuario !!}" name="codusuario">--}}
{{--    <input type="hidden" value="CLIENTE" name="tipo">--}}
{{--    <input type="image" src="{!! asset('img/door-ico.ico') !!}" alt="Submit" width="50" title="Participar">--}}
{{--</form>--}}
@if(!$repositorio->foiSolicitado())
    <a
        width="50"
        onclick="entrarNoRepositorioPublico('{!! $repositorio->codrepositorio !!}','vincular_usuario_repositorio_publico','CLIENTE')"
        title="Participar" style="cursor: pointer;">
        <img id="imagemRepositorio{{$repositorio->codrepositorio}}" src="{!! asset('img/door-ico.ico') !!}" width="50">
    </a>
@else
    <input id="imagemRepositorio{{$repositorio->codrepositorio}}" type="image" src="{!! asset('img/playng.png') !!}" alt="Submit" width="50" title="Solicitado" disabled>
@endif
