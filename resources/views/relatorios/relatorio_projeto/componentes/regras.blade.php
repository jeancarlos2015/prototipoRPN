@if(count($projeto->regras)>0)

    <div id="analise-exploratoria-dos-dados" class="section level1 quebrapagina">

        <table class="table table-bordered" id="example">
            <thead>
            <tr class="header">
                <div class="card-header">
                    <h4>Regras do Projeto</h4>
                </div>
            </tr>
            <tr class="header">
                <th align="left">Nome</th>
                <th align="left">Tipo</th>
            </tr>
            </thead>
            <tbody>

            @foreach($projeto->regras as $regra)
                <tr class="odd">
                    <td align="left">{!! $regra->nome !!}</td>
                    <td align="left">{!! $regra->tipo !!}</td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>


@endif