@if(!empty(Auth::getUser()->Configuracoes()))
    <tbody>

    @foreach(Auth::getUser()->Configuracoes() as $configuracao)

        <tr>
            <td>
            @includeIf('configuracao_menu_ambiente_modelagem.componentes.descricao',['configuracao' => $configuracao])

            </td>

            <td>
               @includeIf('configuracao_menu_ambiente_modelagem.componentes.rotas',['configuracao' => $configuracao])

            </td>
        </tr>
    @endforeach
    </tbody>
@endif
