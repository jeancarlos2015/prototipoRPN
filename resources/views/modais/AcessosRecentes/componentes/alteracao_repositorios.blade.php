@if($acessorecente->EUmaAlteracaoRepositorio() && !empty($acessorecente->Repositorio))

        <tr>

            <td style="width: 90%;">
                <div class="media">
                    <div class="text-muted smaller form-control-custom">
                        <strong>
                            Repositório:   {!! $acessorecente->Repositorio->nome !!}
                        </strong><br>
                        <i class="fa fa-calendar faa-pulse "></i> Acesso:{!! $acessorecente->created_at->format('Y-m-d') !!}<br>
                        <i class="fa fa-info faa-pulse "></i> Descrição:{!! $acessorecente->descricao !!}<br>
                    </div>
                </div>
            </td>
    <td></td>
            <td>
                <a onclick="confirmMensagem('{{route('create_vinculo_repositorio',[$acessorecente->codrepositorio,0])}}');">
                    <i class="fa fa-arrow-right faa-pulse  fa-2x" style="color: black;"></i>
                </a>
            </td>
        </tr>
@endif

