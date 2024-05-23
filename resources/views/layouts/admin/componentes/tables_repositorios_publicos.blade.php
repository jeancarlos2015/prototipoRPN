@if(!empty($repositorios_publicos))
    <tbody>
    @foreach($repositorios_publicos as $repositorio1)
        <tr>
            <td>
                <a href="{!! route($rota_exibicao,[$repositorio1->codrepositorio]) !!}">
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src('public/img/processo.png') }}"
                             alt="" width="100">
                        <div class="media-body">
                            <strong>{!!  $repositorio1->nome !!}</strong>
                            <div class="text-muted smaller">Repositório: {!! $repositorio1->nome !!}</div>
                            <div class="text-muted smaller">Usuários: {!! count($repositorio1->usuarios) !!}</div>
                            <div class="text-muted smaller">Processos: {!! count($repositorio1->projetos) !!}</div>
                            <div class="text-muted smaller">Modelos: {!! count($repositorio1->modelos_diagramaticos) !!}</div>
                        </div>
                    </div>
                </a>

            </td>
            <td>

                @if(!empty($rota_exibicao))
                    @include('componentes.link',['id' => $repositorio1->codrepositorio, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                @endif


            </td>
        </tr>
    @endforeach
    </tbody>
@endif
