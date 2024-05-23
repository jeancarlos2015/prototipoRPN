@if(!empty($acessorecente->Configuracao))

        <tr>

            <td style="width: 90%;">
                <div class="media">
                    <div class="text-muted smaller form-control">
                        <strong>
                            Usuario : {!! $acessorecente->usuario->name !!}
                        </strong><br>
                        <i class="fa fa-calendar faa-pulse "></i> Acesso:{!! $acessorecente->created_at->format('Y-m-d') !!}<br>
                        <i class="fa fa-info faa-pulse "></i> Descrição:{!! $acessorecente->descricao !!}<br>
                    </div>
                </div>
            </td>

            <td>
                <a onclick="confirmMensagem('{{route('controle_configuracao_modelagem.edit',[$acessorecente->codconfiguracaoambientemodelagem])}}');"
                       style="cursor: pointer;">
                        <i class="fa fa-arrow-right faa-pulse  fa-2x"
                           style="cursor: pointer;color: black;"></i>
                    </a>

            </td>
        </tr>
    @endif



