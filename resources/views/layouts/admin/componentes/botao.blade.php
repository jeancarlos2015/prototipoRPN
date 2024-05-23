@if(!empty($tipo))
    @switch($tipo)
        @case ('repositorio')
{{--        <div class="form-group">--}}

{{--            <a class="btn btn-dark form-control"--}}
{{--               href="{!! route('controle_repositorios.create') !!}">Novo Repositório</a>--}}


{{--        </div>--}}

        @break;
        @case ('modelo')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_modelos_create',[
                        'codprojeto' => $projeto->codprojeto
                        ]) !!}">Novo Modelo </a>
        </div>
        @break
        @case ('diagramatico')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_modelos_diagramaticos_create',[
                        'codmodelo' => $modelo->codmodelo,
                        ]) !!}">Novo Diagrama BPMN</a>
        </div>

        @break;
        @case ('show')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route($rota,[$id]) !!}">{!! $descricao !!}</a>
        </div>
        @break
        @case ('declarativo')
        <div class="form-group">
            @if(empty(Auth::user()->repositorio()))
                <a class="btn btn-danger form-control"
                   onclick="mensagem()">Nova Representação Declarativa</a>
            @else
                <a class="btn btn-danger form-control"
                   href="{!! route('controle_modelos_declarativos_create',[

                        'codmodelo' => $modelo->codmodelo

                        ]) !!}">Nova Representação Declarativa</a>
            @endif

        </div>

        @break;
        @case ('objetofluxo')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_objetos_fluxos_create',[$modelo_declarativo->codmodelodeclarativo]) !!}">Novo
                Objeto de Fluxo</a>
        </div>


        @break;
        @case ('usuario')
        @if(!empty($rota) && !empty($botao_usuario))
            <div class="form-group">
                <a class="btn btn-dark form-control"
                   href="{!! route($rota) !!}">{!! $botao_usuario !!}</a>
            </div>
        @endif
        @break;

        @case ('projeto')
{{--        <div class="form-group">--}}
{{--            <a class="btn btn-dark form-control"--}}
{{--               href="{!! route('controle_projetos_create',['organizacao_id' => $repositorio->codrepositorio]) !!}">Novo--}}
{{--                Processo</a>--}}
{{--        </div>--}}
        @break;
        @case ('documentacao')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_documentacoes.create')!!}">Nova
                Documentação</a>
        </div>

        @break;
        @case ('regra')
        @if(!empty($modelo_declarativo))
            @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.links_padroes_recomendacao')
        @endif
        @break;
        @case ('mensagem')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_mensagens_create',[Auth::user()->codusuario]) !!}">{!! $botao_usuario !!}</a>
        </div>

        @break;


    @endswitch


@endif
