@if(in_array($modelo1->papel(),['ADMINISTRADOR','PROPRIETARIO']))

    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exclusao))
        {{--        @include('componentes.form_delete',['id' => $modelo1->codmodelo, 'rota' => $rota_exclusao])--}}
        <a style="cursor: pointer" onclick="excluir('{!! $modelo1->codmodelo !!}','codmodelo')">
            <img
                src="{!! asset('img/delete.png') !!} " style="width: 20px"
                title="deletar">
        </a>
    @endif
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif
@elseif($modelo1->papel()==='COLABORADOR')

    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif
@elseif($modelo1->papel()==='CLIENTE')
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif
@endif

@if(Auth::getuser()->TemPermissaoParaEscluir())

    <div class="form-group">
        <a href="javascript:void(window.open('{!! route('rich_text',[$modelo1->codmodelo]) !!}','','width=720,height=640'))">
            <div class="media">

                <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/pergaminho.png') !!} "
                     style="width: 30px">
            </div>
        </a>
    </div>

@endif
