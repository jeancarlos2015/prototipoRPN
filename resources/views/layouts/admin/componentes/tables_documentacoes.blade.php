@if(!empty($documentacoes))
    <tbody>

    @foreach($documentacoes as $documentacao)

        <tr>
            <td>
            @includeIf('controle_documentacao.componentes.descricao')

            </td>

            <td>
               @includeIf('controle_documentacao.componentes.rotas')

            </td>
        </tr>
    @endforeach
    </tbody>
@endif
