<div class="card-header text-center">
    <h3> Visualização do modelo {!! $modelo_viwer->modelo->nome !!}</h3> <br>
</div>
<div class="card-body text-center">
    <h4> Repositório {!! $modelo_viwer->modelo->repositorio->nome !!} </h4> <br>

    @if($modelo_viwer->modelo->projeto->publico)
        <strong> Projeto Público - {!!$modelo_viwer->modelo->projeto->nome !!} </strong> <br>
    @else
        <strong> Projeto Privado - {!!$modelo_viwer->modelo->projeto->nome !!} </strong> <br>
    @endif

</div>
<div class="card-footer text-center">
    @if($modelo_viwer->modelo->publico)
        <strong> O modelo é público</strong> <br>
    @else
        <strong> Você é {!! strtolower( $modelo_viwer->modelo->papel()) !!} neste modelo</strong> <br>
    @endif

</div>
</div>