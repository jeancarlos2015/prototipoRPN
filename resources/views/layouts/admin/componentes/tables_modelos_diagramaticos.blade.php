@if(!empty($modelos))
    <tbody>

    @foreach($modelos as $modelo1)
        @if($modelo1->modelo->permissao() || $modelo1->modelo->publico)
            <tr id="codmodelodiagramatico{!!$modelo1->codmodelodiagramatico  !!}">
                <td>
                   @includeIf('controle_modelos_diagramaticos.componentes.descricao')
                </td>
                <td>
                 @includeIf('controle_modelos_diagramaticos.componentes.descricaoBasica')
                </td>

                <td>
                    @includeIf('controle_modelos_diagramaticos.componentes.rotas')
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
                            <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                            <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
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
