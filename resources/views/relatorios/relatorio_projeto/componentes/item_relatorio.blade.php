@if(!empty($modelo))
    @if(count($modelo->objetos_fluxos)>1)

        <div id="analise-exploratoria-dos-dados" class="section level1 quebrapagina">
            <table class="table table-bordered" id="example">
                <thead>
                <tr class="header">
                    <div class="card-header">
                        <h4>Modelo "{!! $modelo->nome !!}"</h4>
                    </div>
                </tr>
                <tr class="header">
                    <th align="left">Tarefa/Evento</th>
                    <th align="left">Tipo</th>
                </tr>
                </thead>
                <tbody>

                @for($indice=0;$indice<count($modelo->objetos_fluxos);$indice++)

                    <tr class="odd">
                        <td align="left">{!! $modelo->objetos_fluxos[$indice]->nome !!}</td>
                        <td align="left">{!! $modelo->objetos_fluxos[$indice]->tipo !!}</td>
                    </tr>
                @endfor


                </tbody>
            </table>
        </div>

    @endif
@endif