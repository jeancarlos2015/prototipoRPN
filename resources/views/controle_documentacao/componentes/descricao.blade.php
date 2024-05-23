@if($documentacao->tipo()=='video')

    <a onclick="return confirm('Deseja acessar o documento?');"
       href="{!! $documentacao->link !!}"
       style="display: inline-block">'
        <div class="media-body">
            <strong>{!!  $documentacao->nome !!}</strong>
            <div class="text-muted smaller">Responsável: {!! $documentacao->usuario->name !!}</div>
            <div class="text-muted smaller">
                Descrição: {!! $documentacao->descricao !!}</div>
            <input type="image" src="https://img.youtube.com/vi/{!! $documentacao->getIdVideoYoutube() !!}/maxresdefault.jpg" alt="Submit"
                   width="450"
                   title="Abrir Documento">
        </div>

    </a>

@else
    <a href="{!! $documentacao->link !!}" title="{!! $documentacao->link !!}">
        <div class="media">
            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($documentacao->usuario->email) }}"
                 alt="" width="100">
            <div class="media-body">
                <strong>{!!  $documentacao->nome !!}</strong>
                <div class="text-muted smaller">Código da
                    Documentação: {!! $documentacao->coddocumentacao !!}</div>
                <div class="text-muted smaller">Código da
                    Responsável: {!! $documentacao->usuario->name !!}</div>
                <div class="text-muted smaller">Nome da Documentação: {!! $documentacao->nome !!} </div>
                <div class="text-muted smaller">Descrição da
                    Documentação: {!! $documentacao->descricao !!}</div>
{{--                <div class="text-muted smaller">Tipo: {!! $documentacao->tipo() !!}</div>--}}
            </div>
        </div>
    </a>
@endif
