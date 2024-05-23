@if(!empty($acessorecente->Projeto) && empty($acessorecente->Diagrama))
    @if(Auth::getUser()->EAdministrador())
        <tr>

            <td style="width: 90%;">
                <div class="media">
                    <div class="text-muted smaller form-control-custom">
                        <strong>
                            Projeto:   {!! $acessorecente->Projeto->nome !!}
                        </strong><br>
                        <i class="fa fa-calendar faa-pulse "></i> Acesso:{!! $acessorecente->created_at->format('Y-m-d') !!}<br>
                        <i class="fa fa-info faa-pulse "></i> Descrição:{!! $acessorecente->descricao !!}<br>
                        <i class="fa fa-database faa-pulse "></i> Repositório:{!! $acessorecente->Projeto->Repositorio->nome !!}<br>
                    </div>
                </div>
            </td>
<td></td>
            <td>
                <a onclick="confirmMensagem('{{route('controle_projetos.show',[$acessorecente->codprojeto])}}');"
                       style="cursor: pointer;">
                        <i class="fa fa-arrow-right faa-pulse  fa-2x"
                           style="cursor: pointer;color: black;"></i>
                    </a>

            </td>
        </tr>

    @elseif($acessorecente->Projeto->UsuarioTemPermissao(Auth::getUser()))
        <tr>

            <td style="width: 85%;">
                <div class="media">
                    <div class="text-muted smaller form-control-custom">
                        <strong>
                            Projeto:   {!! $acessorecente->Projeto->nome !!}
                        </strong><br>
                        <i class="fa fa-calendar faa-pulse "></i> Acesso:{!! $acessorecente->created_at->format('Y-m-d') !!}<br>
                        <i class="fa fa-info faa-pulse "></i> Descrição:{!! $acessorecente->descricao !!}<br>
                    </div>
                </div>
            </td>
            <td></td>
            <td style="width: 15%">
                <a onclick="confirmMensagem('{{route('controle_modelos_index',[$acessorecente->codprojeto])}}');"
                   style="cursor: pointer;">
                    <i class="fa fa-arrow-right faa-pulse  fa-2x"
                       style="cursor: pointer;color: black;"></i>
                </a>

            </td>
        </tr>
    @endif

@endif

