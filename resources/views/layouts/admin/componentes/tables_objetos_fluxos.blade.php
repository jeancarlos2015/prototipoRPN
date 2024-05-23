@if(!empty($objetos_fluxos))
    <tbody>
    @foreach($objetos_fluxos as $objeto)
        @if($objeto->publico || $objeto->email()==Auth::user()->email || Auth::getuser()->EProprietario())
            <tr>
                <td>
                    @if(!empty($rota_edicao))
                        <a href="{!! route($rota_edicao,[$objeto->codobjetofluxo]) !!}">
                            <div class="media">
                                @if(!empty($objeto->usuario->email))
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($objeto->usuario->email) }}"
                                         alt="" width="50">
                                @else
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src('removido@gmail.com') }}"
                                         alt="" width="50">
                                @endif
                                <div class="media-body">
                                    <strong>{!!  $objeto->nome !!}</strong>
                                    <div class="text-muted smaller">Objeto de fluxo: {!! $objeto->nome !!}</div>

                                    <div class="text-muted smaller">Tipo: {!! $objeto->tipo !!}</div>
                                    @if(!empty($objeto->usuario->name))
                                        <div class="text-muted smaller">
                                            Responsável: {!! $objeto->usuario->name !!}</div>
                                    @endif
                                    <div class="text-muted smaller">Descrição: {!! $objeto->descricao !!}</div>
                                    @if(!empty($objeto->repositorio->nome))
                                        <div class="text-muted smaller">Repositório de
                                            origem: {!! $objeto->repositorio->nome !!}</div>
                                    @endif
                                    @if(!empty($objeto->projeto->nome))
                                        <div class="text-muted smaller">Processo:
                                             {!! $objeto->projeto->nome !!}</div>
                                    @endif
                                    @if(!empty($objeto->modelo->nome))
                                        <div class="text-muted smaller">Modelo declarativo de
                                            origem: {!! $objeto->modelo->nome !!}</div>
                                    @endif

                                </div>
                            </div>
                        </a>
                    @else

                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle"
                                 src="{{ Gravatar::src($objeto->usuario->email) }}"
                                 alt="" width="100">
                            <div class="media-body">

                                <strong>{!!  $objeto->nome !!}</strong>
                                <div class="text-muted smaller">Objeto de fluxo: {!! $objeto->nome !!}</div>

                                <div class="text-muted smaller">Tipo: {!! $objeto->tipo !!}</div>
                                <div class="text-muted smaller">Responsável: {!! $objeto->usuario->name !!}</div>
                                <div class="text-muted smaller">Descrição: {!! $objeto->descricao !!}</div>
                                @if(!empty($objeto->repositorio->nome))
                                    <div class="text-muted smaller">Repositório de
                                        origem: {!! $objeto->repositorio->nome !!}</div>
                                @endif
                                @if(!empty($objeto->projeto->nome))
                                    <div class="text-muted smaller">Processo: {!! $objeto->projeto->nome !!}</div>
                                @endif
                                @if(!empty($objeto->modelo->nome))
                                    <div class="text-muted smaller">Modelo declarativo de
                                        origem: {!! $objeto->modelo->nome !!}</div>
                                @endif
                            </div>
                        </div>


                    @endif

                </td>

                <td>

                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $objeto->codobjetofluxo, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $objeto->codobjetofluxo, 'rota' => $rota_exclusao])
                    @endif
                    @if(!empty($rota_exibicao))

                        <div class="form-group">
                            <a href="{!! route($rota_exibicao,[$objeto->codobjetofluxo]) !!}"><img
                                        src="{!! asset('img/olho.png') !!} " style="width: 20px"
                                        title="Visualizar"></a>
                        </div>
                    @endif
                </td>
            </tr>
        @else
            <tr>
                <td>
                    <div class="media">

                        <img class="d-flex mr-3 rounded-circle"
                             src="{!! asset('img/privado.png') !!} "
                             alt="" width="100">
                        <div class="media-body">

                            <strong>{!!  $objeto->nome !!}</strong>
                            <div class="text-muted smaller">Privado</div>

                        </div>
                    </div>

                </td>
                <td>
                    Nenhum
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
@endif
