@if(!empty($diagrama))
    <div class="form-group">
        <a class="btn btn-dark form-control"
           href="{!! route('configuracao_ambiente_modelagem_create', $diagrama->codmodelodiagramatico) !!}"> Nova
            Configuração Ambiente de Modelagem</a>
    </div>
@endif