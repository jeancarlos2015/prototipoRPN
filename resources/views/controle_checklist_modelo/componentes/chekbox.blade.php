<div class="funkyradio">
    <div class="funkyradio-success">

        <input type="checkbox" name="checkbox" id="checkbox{!! $objeto->codobjetofluxo !!}"/>


        <label for="checkbox{!! $objeto->codobjetofluxo !!}">
            @if($objeto->tipo==='EVENTO DE INÍCIO')
                INÍCIO: <br> {!! $objeto->nome !!}
            @elseif($objeto->tipo==='EVENTO DE FIM')
                FIM: <br> {!! $objeto->nome !!}
            @else
                {!! $objeto->tipo !!}: <br> {!! $objeto->nome !!}
            @endif

        </label>


    </div>
</div>
