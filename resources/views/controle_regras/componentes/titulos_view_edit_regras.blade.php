<div class="text-center">
    <h4> Repositório {!! $regra->repositorio->nome !!} </h4> <br>
    @if($regra->projeto->publico)
        <strong> Processo Público -  {!!$regra->projeto->nome !!} </strong> <br>
    @else
        <strong> Processo Privado -  {!!$regra->projeto->nome !!} </strong> <br>
    @endif
    <strong> Modelo Declarativo {!!$regra->modelo_declarativo->nome !!} </strong> <br>
</div>