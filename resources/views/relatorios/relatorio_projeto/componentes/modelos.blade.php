@if(count($projeto->modelos)>0)

        <div id="analise-exploratoria-dos-dados" class="section level1 quebrapagina">

            <table class="table table-bordered" id="example">
                <thead>
                <tr class="header">
                    <div class="card-header">
                        <h4>Modelos</h4>
                    </div>
                </tr>

                <tr>
                    <th align="left"><span>Nome</span></th>
                    <th align="left"><span>Descrição</span></th>
                    <th align="left"><span>Proprietário</span></th>
                </tr>
                </thead>
                <tbody>

                @for($indice=0;$indice<count($projeto->modelos);$indice++)
                    <tr class="odd">
                        <td align="left">{!! $projeto->modelos[$indice]->nome !!}</td>
                        <td align="left">{!! $projeto->modelos[$indice]->descricao !!}</td>
                        <td align="left">{!! $projeto->modelos[$indice]->usuario->name !!}</td>
                    </tr>
                @endfor


                </tbody>
            </table>

        </div>

@endif