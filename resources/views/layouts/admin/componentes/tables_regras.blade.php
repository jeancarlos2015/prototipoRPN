@if(!empty($regras))
    <tbody>

    @foreach($regras as $regra)
        <tr>
            <td>
                @if(!empty($rota_exibicao))
                    <a href="{!! route($rota_exibicao,[$regra->codregra]) !!}">
                        <div class="media">
                            @if(!empty($regra->usuario->email))
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($regra->usuario->email) }}"
                                     alt="" width="100">
                            @else
                                <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src('removido@gmail.com') }}"
                                     alt="" width="100">
                            @endif
                            <div class="media-body">
                                <strong>{!! $regra->name !!}</strong>
                                @if(!empty($regra->usuario))
                                    <strong>{!! $regra->usuario->name !!}</strong>
                                @endif
                                <div class="text-muted smaller">Código da Regra: {!! $regra->codregra !!}</div>
                                <div class="text-muted smaller">Nome da Regra: {!! $regra->nome !!} </div>
                                @if(!empty($regra->usuario->nome))
                                    <div class="text-muted smaller">Responsável: {!! $regra->usuario->name !!}</div>
                                @endif
                                @if(!empty($regra->modelodeclarativo->descricao))
                                    <div class="text-muted smaller">Descrição do
                                        Modelo: {!! $regra->modelodeclarativo->descricao !!}</div>
                                @endif
                                @if(!empty($regra->projeto->nome))
                                    <div class="text-muted smaller">Projeto: {!! $regra->projeto->nome !!}</div>
                                @endif
                                @if(!empty($regra->repositorio->nome ))
                                    <div class="text-muted smaller">Repositório: {!! $regra->repositorio->nome !!}</div>
                                @endif
                                <div class="text-muted smaller">Objetos
                                    Fluxos: {!! count($regra->objetos_fluxos) !!}</div>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="#">
                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($regra->usuario->email) }}"
                                 alt="" width="100">
                            <div class="media-body">
                                @if(!empty($regra->usuario))
                                    <strong>{!! $regra->name !!}</strong>
                                    <strong>{!! $regra->usuario->name !!}</strong>
                                @endif
                                <div class="text-muted smaller">Descrição da Regra: {!! $regra->nome !!}</div>
                                @if(!empty($regra->modelodeclarativo->descricao))
                                    <div class="text-muted smaller">Descrição do
                                        Modelo: {!! $regra->modelodeclarativo->descricao !!}</div>
                                @endif
                                @if(!empty($regra->usuario))
                                    <div class="text-muted smaller">Responsável: {!! $regra->usuario->name !!}</div>
                                @endif
                                @if(!empty($regra->modelodeclarativo->descricao))
                                    <div class="text-muted smaller">Descrição do
                                        Modelo: {!! $regra->modelodeclarativo->descricao !!}</div>
                                @endif
                                @if(!empty($regra->projeto->nome))
                                    <div class="text-muted smaller">Projeto: {!! $regra->projeto->nome !!}</div>
                                @endif
                                @if(!empty($regra->repositorio->nome ))
                                    <div class="text-muted smaller">Repositório: {!! $regra->repositorio->nome !!}</div>
                                @endif
                                <div class="text-muted smaller">Objetos
                                    Fluxos: {!! count($regra->objetos_fluxos) !!}</div>
                            </div>
                        </div>
                    </a>
                @endif

            </td>

            <td>
                @if((!empty($regra->usuario) && Auth::user()->email===$regra->usuario->email) || (Auth::getuser()->EAdministrador()))
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $regra->codregra, 'rota' => $rota_edicao])
                    @endif

                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $regra->codregra, 'rota' => $rota_exclusao])
                    @endif
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',
                        [
                        'id' => $regra->codregra,
                        'rota' => $rota_exibicao,
                        'nomebotao' => 'Visualizar'
                        ]
                        )
                    @endif
                @else
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',
                        [
                        'id' => $regra->codregra,
                        'rota' => $rota_exibicao,
                        'nomebotao' => 'Visualizar'
                        ]
                        )
                    @endif

                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif