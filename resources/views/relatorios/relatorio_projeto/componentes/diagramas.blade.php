@if(count($projeto->diagramas)>0)

    <div id="analise-exploratoria-dos-dados" class="section level1 quebrapagina">

        <table class="table table-bordered" id="example">
            <thead>
            <tr class="header">
                <div class="card-header">
                    <h4>Diagramas</h4>
                </div>
            </tr>

            <tr>
                <th align="left"><span>Modelo</span></th>
                <th align="left"><span>Diagrama</span></th>
                <th align="left"><span>Autor</span></th>
            </tr>
            </thead>
            <tbody>

            @for($indice=0;$indice<count($projeto->diagramas);$indice++)
                <tr class="odd">
                    <td align="left">{!! $projeto->diagramas[$indice]->nome !!}</td>

                    <td align="left">


                        @if (Auth::getUser()->EProprietario())
                            @if ($projeto->diagramas[$indice]->existeSVG())
                                <a style="cursor: pointer"
                                   onclick="confirmMensagemPersonalizado('{{route('edicao_modelo_diagramatico',[$projeto->diagramas[$indice]->codmodelodiagramatico])}}','Deseja Editar o Diagrama?');">
                                    <div style="zoom: 7%;">
                                        {!! $projeto->diagramas[$indice]->svg_modelo !!}
                                    </div>
                                </a>
                            @else
                                <a style="cursor: pointer"
                                   onclick="confirmMensagemPersonalizado('{{route('edicao_modelo_diagramatico',[$projeto->diagramas[$indice]->codmodelodiagramatico])}}','Deseja Editar o Diagrama?');">
                                    <div style="zoom: 7%;">
                                        {!! $projeto->diagramas[$indice]->svgPadrao() !!}
                                    </div>
                                </a>
                            @endif

                        @else($projeto->diagramas[$indice]->publico)
                            @if ($projeto->diagramas[$indice]->existeSVG())
                                <a onclick="confirmMensagemPersonalizado('{{route('visualizar_modelo_publico',[$projeto->diagramas[$indice]->codmodelodiagramatico])}}','Deseja visualizar o Diagrama?');">
                                    <div style="zoom: 7%;">
                                        {!! $projeto->diagramas[$indice]->svg_modelo !!}
                                    </div>
                                </a>
                            @else
                                <a onclick="confirmMensagemPersonalizado('{{route('visualizar_modelo_publico',[$projeto->diagramas[$indice]->codmodelodiagramatico])}}','Deseja visualizar o Diagrama?');">
                                    <div style="zoom: 7%;">
                                        {!! $projeto->diagramas[$indice]->svgPadrao() !!}
                                    </div>
                                </a>

                            @endif

                        @endif
                    </td>
                    <td>
                        {!! $projeto->diagramas[$indice]->usuario->name !!}
                    </td>
                </tr>
                @endfor

            </tbody>
        </table>

    </div>

@endif
