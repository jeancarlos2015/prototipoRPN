@if(!empty($acessorecente->Diagrama))
    @if(Auth::getUser()->EAdministrador())
        <tr>

            <td style="width: 90%;">
                <div class="media">
                    <div class="text-muted smaller form-control-custom">
                        <strong>
                            Diagrama: {!! $acessorecente->Diagrama->nome !!}
                        </strong><br>
                        <i class="fa fa-calendar faa-pulse "></i> Acesso:{!! $acessorecente->created_at->format('Y-m-d') !!}<br>
                        <i class="fa fa-info faa-pulse "></i> Descrição:{!! $acessorecente->descricao !!}<br>
                    </div>

                </div>
            </td>

            <td>

                    @if ($acessorecente->Diagrama->existeSVG())
                        <a style="cursor: pointer"
                           onclick="confirmMensagemPersonalizado('{{route('edicao_modelo_diagramatico',[$acessorecente->Diagrama->codmodelodiagramatico])}}','Deseja Editar o Diagrama?');">
                            <div style="zoom: 7%;">
                                {!! $acessorecente->Diagrama->svg_modelo !!}
                            </div>
                        </a>
                    @else
                        <a style="cursor: pointer"
                           onclick="confirmMensagemPersonalizado('{{route('edicao_modelo_diagramatico',[$acessorecente->Diagrama->codmodelodiagramatico])}}','Deseja Editar o Diagrama?');">
                            <div style="zoom: 7%;">
                                {!! $acessorecente->Diagrama->svgPadrao() !!}
                            </div>
                        </a>
                    @endif

            </td>
            <td></td>
            <td>

                <a onclick="confirmMensagem('{{route('edicao_modelo_diagramatico',[$acessorecente->codmodelodiagramatico])}}');"
                   style="cursor: pointer;">
                    <i class="fa fa-arrow-right faa-pulse  fa-2x"
                       style="cursor: pointer;color: black;"></i>
                </a>

            </td>
        </tr>
    @elseif($acessorecente->Diagrama->UsuarioTemPermissao(Auth::getUser()))
        <tr>

            <td style="width: 85%;">
                <div class="media">
                    <div class="text-muted smaller form-control-custom">
                        <strong>
                            Diagrama: {!! $acessorecente->Diagrama->nome !!}
                        </strong><br>
                        <i class="fa fa-calendar faa-pulse "></i> Acesso:{!! $acessorecente->created_at->format('Y-m-d') !!}<br>
                        <i class="fa fa-info faa-pulse "></i> Descrição:{!! $acessorecente->descricao !!}<br>
                    </div>
                </div>
            </td>
            <td></td>
            <td style="width: 15%">

                <a onclick="confirmMensagem('{{route('edicao_modelo_diagramatico',[$acessorecente->codmodelodiagramatico])}}');"
                   style="cursor: pointer;">
                    <i class="fa fa-arrow-right faa-pulse  fa-2x"
                       style="cursor: pointer;color: black;"></i>
                </a>

            </td>
        </tr>
    @endif

@endif

