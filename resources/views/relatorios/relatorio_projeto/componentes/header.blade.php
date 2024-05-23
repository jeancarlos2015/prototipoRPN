
<div class="fluid-row" id="header">
    <table class="table table-bordered" id="example">
        <thead>
        <tr class="header">
            <td>
                <div class="card-header">
                    <h3>Relatório do Processo:</h3>
                </div>
            </td>
            <td>
                <div class="card-header">
                    <h3>{!! $projeto->nome !!}</h3>
                </div>
            </td>

        </tr>
        </thead>
        <tbody>
        <tr class="odd">
            <td align="left"><strong>Repositório</strong></td>
            <td align="left"> {!! $projeto->repositorio->nome !!}</td>
        </tr>
        <tr class="odd">
            <td align="left"><strong>Processo</strong></td>
            <td align="left"> {!! $projeto->nome !!}</td>
        </tr>
        </tbody>
    </table>
</div>
