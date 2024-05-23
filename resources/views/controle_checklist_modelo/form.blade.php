@includeIf('controle_checklist_modelo.componentes.css')
<form role="form" action="#" class="f1">
    @csrf
    @method('POST')

    <div class="f1-steps" style="display: none">
        <div class="f1-progress">
            <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="5" style="width: 16.66%;"></div>
        </div>
        @for($indice=0;$indice<count($objetos);$indice++)
            <div class="f1-step active">
                <div class="f1-step-icon"><i class="fa fa-question"></i></div>
                <p>{!! $objetos[$indice]->tipo  !!}: <br> {!! $objetos[$indice]->nome !!}.</p>
            </div>
        @endfor
        <div class="f1-step">
            <div class="f1-step-icon"><i class="fa fa-hourglass-end"></i></div>
            <p>FIM</p>
        </div>
    </div>

    <fieldset>
        <h4></h4>
        <div class="form-group">
            <div id="origem" align="center">
                <label class="sr-only" for="f1-first-name"> {!! $objetos[0]->nome !!}</label>
                @includeIf('controle_checklist_modelo.componentes.chekbox',['objeto' => $objetos[0]])
            </div>
            <div id="destino">
            </div>
        </div>
        <div class="f1-buttons">
            <button type="button" class="btn btn-next">Próximo</button>
        </div>
    </fieldset>
    @for($indice=1;$indice<count($objetos);$indice++)
        <fieldset>
            <h4></h4>
            <div class="form-group">
                <div id="origem" align="center">
                    @if($objetos[$indice]->tipo==='EVENTO DE INÍCIO')
                        <label class="sr-only afasta" for="f1-first-name"> INÍCIO:
                            <br> {!! $objetos[$indice]->nome !!}</label>
                    @elseif($objetos[$indice]->tipo==='EVENTO DE FIM')
                        <label class="sr-only afasta" for="f1-first-name"> FIM:
                            <br> {!! $objetos[$indice]->nome !!}</label>

                    @else
                        <label class="sr-only afasta" for="f1-first-name"> {!! $objetos[$indice]->tipo !!} :
                            <br> {!! $objetos[$indice]->nome !!}</label>

                    @endif
                    @includeIf('controle_checklist_modelo.componentes.chekbox',[
                            'objeto' => $objetos[$indice]
                        ])

                </div>
                <div id="destino">
                </div>
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous">Passo Anterior</button>
                <button type="button" class="btn btn-next">Próxima Passo</button>
            </div>
        </fieldset>
    @endfor

    <fieldset>
        <div class="f1-buttons">
            <button type="button" class="btn btn-previous"> Passo Anterior</button>
            <button type="submit" class="btn btn-submit">Finalizar</button>
        </div>
    </fieldset>

</form>


