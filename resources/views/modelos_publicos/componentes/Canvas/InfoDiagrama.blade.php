@if(!empty($modelo))
    <li class="nav-item">
        <a class="nav-link"
           href="#" data-toggle="modal"
           data-target="#modal-nome-modelo">
            <i class="fa fa-info faa-pulse " title="Modelo: {!! strtoupper($modelo->modelo->nome) !!}"></i>
            <span class="sr-only"></span>
        </a>
    </li>
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link"--}}
{{--           onclick="donwload('diagrama.bpmn','{!! $modelo->codmodelodiagramatico !!}')" download="diagrama.bpmn"--}}
{{--           title="Donwload do BPMN">--}}
{{--            <p class="fa fa-download faa-pulse ">BPMN</p>--}}
{{--            <span class="sr-only"></span>--}}
{{--        </a>--}}
{{--    </li>--}}
    @if ($modelo->existeSVG())
        <li class="nav-item">
            <a class="nav-link"
               onclick="dowloadSVGModeloPublico('{!!$modelo->codmodelodiagramatico  !!}','diagrama.svg')"
               title="Donwload do BPMN">
                <p class="fa fa-download faa-pulse ">SVG</p>
                <span class="sr-only"></span>
            </a>
        </li>
    @endif

{{--    <li class="nav-item">--}}
{{--        <a class="nav-link btn-toggle1" id="descricao-link-id1"--}}
{{--           onclick="MudarestadoModeloPublico('descricao-label-id1','descricao-link-id1')"--}}
{{--           title="Esconder Legenda">--}}
{{--            <i class="fa fa-info-circle"></i>--}}
{{--            <span class="sr-only"></span>--}}
{{--        </a>--}}
{{--    </li>--}}

@endif
