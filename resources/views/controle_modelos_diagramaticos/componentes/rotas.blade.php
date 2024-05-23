@if(Auth::getuser()->TemPermissaoParaEscluir())
    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exclusao))
{{--                @include('componentes.form_delete',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exclusao])--}}
        <a style="cursor: pointer" onclick="excluir('{!! $modelo1->codmodelodiagramatico !!}','codmodelodiagramatico')">
            <img
                src="{!! asset('img/delete.png') !!} " style="width: 20px"
                title="deletar">
        </a>
    @endif
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])

    @endif
@elseif($modelo1->modelo->papel()==='COLABORADOR')
    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif
@elseif($modelo1->modelo->papel()==='CLIENTE')
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif
@endif

@if(Auth::getuser()->TemPermissaoParaEscluir())

    <div class="form-group">
        <a href="javascript:void(window.open('{!! route('rich_text_diagrama',[$modelo1->codmodelodiagramatico]) !!}','','width=720,height=640'))">
            <div class="media">

                <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/pergaminho.png') !!} "
                     style="width: 30px">
            </div>
        </a>
    </div>
    @if(!empty($modelo1->validador))
        @if($modelo1->validador->codusuario==Auth::getUser()->codusuario || Auth::getUser()->papel()=='PROPRIETARIO' || Auth::getUser()->EAdministrador() || $modelo1->codusuario==Auth::getUser()->codusuario)
            @if($modelo1->validado)
                <div class="form-group">

                </div>
                <div class="form-group">
                    <a onclick="return confirm('Deseja Desvalidar este Diagrama?');"
                       href="{!! route('ValidarDiagrama',[$modelo1->codmodelodiagramatico]) !!}">
                        <i id="desvalidar2020" class="fa fa-check-circle fa-2x" style="color: green;"></i>
                    </a>
                </div>
            @else
                <div class="form-group">
                    <a onclick="return confirm('Deseja Validar este Diagrama?');"
                       href="{!! route('ValidarDiagrama',[$modelo1->codmodelodiagramatico]) !!}">
                        <i id="validar2020" class="fa fa-check fa-2x" style="color: black;" title="Validar"></i>
                    </a>
                </div>

            @endif
        @endif
    @endif


@else
    @if(!empty($modelo1->validador))
        @if($modelo1->validador->codusuario==Auth::getUser()->codusuario || Auth::getUser()->papel()=='PROPRIETARIO' || Auth::getUser()->EAdministrador() || $modelo1->codusuario==Auth::getUser()->codusuario)
            @if($modelo1->validado)
                <div class="form-group">

                </div>
                <div class="form-group">
                    <a onclick="return confirm('Deseja Desvalidar este Diagrama?');"
                       href="{!! route('ValidarDiagrama',[$modelo1->codmodelodiagramatico]) !!}">
                        <i id="desvalidar2020" class="fa fa-check-circle fa-2x" style="color: green;"></i>
                    </a>
                </div>
            @else
                <div class="form-group">
                    <a onclick="return confirm('Deseja Validar este Diagrama?');"
                       href="{!! route('ValidarDiagrama',[$modelo1->codmodelodiagramatico]) !!}">
                        <i id="validar2020" class="fa fa-check fa-2x" style="color: black;" title="Validar"></i>
                    </a>
                </div>

            @endif
        @endif
    @endif

@endif
