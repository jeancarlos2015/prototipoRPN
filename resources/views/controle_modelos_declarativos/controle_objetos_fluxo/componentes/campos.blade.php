@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))

            @if($dados[$indice]->campo!=='Visibilidade')
                <label>{!! $dados[$indice]->campo !!}</label>
                <input type="{!! $dados[$indice]->tipo !!}" class="form-control"
                       name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->campo !!}"
                       value="{!! $dados[$indice]->valor !!}" required>
            @else
                <input type="{!! $dados[$indice]->tipo !!}"
                       name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->campo !!}"
                       value="{!! $dados[$indice]->valor !!}"
                       title="Ao clicar neste ítem todos os usuários poderão manipulá-lo" required>
                <label>{!! $dados[$indice]->campo !!}</label>
            @endif

        @endif
    </div>
@endfor

<div class="form-group">
    <label>Tipo</label>
    <select class="selectpicker form-control" name="tipo">
        @foreach($tipos as $tipo)
            <option value="{!! $tipo !!}">{!! $tipo!!}</option>
        @endforeach
    </select>
</div>
@if(!empty($representacao_declarativa))
    <input type="hidden" value="{!! $representacao_declarativa->codrepositorio !!}" name="codrepositorio">
    <input type="hidden" value="{!! $representacao_declarativa->codusuario !!}" name="codusuario">
    <input type="hidden" value="{!! $representacao_declarativa->codprojeto !!}" name="codprojeto">
    <input type="hidden" value="{!! $representacao_declarativa->codmodelodeclarativo !!}" name="codmodelodeclarativo">
@endif