@if(count($projeto->usuarios_projetos)>0)

    <div id="analise-exploratoria-dos-dados" class="section level1 quebrapagina">

        <table class="table table-bordered" id="example">
            <thead>
            <tr class="header">
                <div class="card-header">
                    <h4>Participantes do Processo</h4>
                </div>
            </tr>
            <tr class="header">
                <th align="left">Nome</th>
                <th align="left">Papel</th>
            </tr>
            </thead>
            <tbody>

            @foreach($projeto->usuarios_projetos as $entrada)
                <tr class="odd">
                    <td align="left">{!! $entrada->usuario->name !!}</td>
                    <td align="left">{!! $entrada->tipo !!}</td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>

@endif
