<div class="text-center">
    <h4> Repositório {!! $modelo->repositorio->nome !!} </h4> <br>
    @if($regra->projeto->publico)
        <strong> Processo Público -  {!!$regra->projeto->nome !!} </strong> <br>
    @else
        <strong> Processo Privado -  {!!$regra->projeto->nome !!} </strong> <br>
    @endif
    <strong> Modelo Declarativo {!!$modelo->nome !!} </strong> <br>
</div>