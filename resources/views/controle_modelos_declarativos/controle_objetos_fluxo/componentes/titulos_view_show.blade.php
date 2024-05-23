<div class="text-center">
    <h3> Visualização de Objeto de Fluxo </h3>
    <h4> Repositório {!! $objeto->repositorio->nome !!} </h4>
    @if($objeto->projeto->publico)
        <strong> Projeto Público -  {!!$objeto->projeto->nome !!} </strong> <br>
    @else
        <strong> Projeto Privado -  {!!$objeto->projeto->nome !!} </strong> <br>
    @endif
    <strong> Modelo Declarativo - {!! $objeto->modelo->nome !!} </strong>
</div>