<form role="form" action="{!! route('controle_objetos_fluxos.store') !!}" method="post" class="f1">
    @csrf
    @method('POST')
    <input type="hidden" name="codmodelodeclarativo" value="{!! $representacao_declarativa->codmodelodeclarativo !!}">
    <div class="f1-steps">
        <div class="f1-progress">
            <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
        </div>
        <div class="f1-step active">
            <div class="f1-step-icon"><i class="fa fa-question"></i></div>
            <p>Inclua uma Tarefa/Evento?</p>
        </div>
        <div class="f1-step">
            <div class="f1-step-icon"><i class="fa fa-question"></i></div>
            <p>Deseja acrescentar mais alguma Tarefa/Evento?</p>
        </div>
        <div class="f1-step">
            <div class="f1-step-icon"><i class="fa fa-hourglass-end"></i></div>
            <p>FIM</p>
        </div>
    </div>

    <fieldset>
        <h4></h4>
        <div class="form-group">
            <div id="origem" align="center">
                <label class="sr-only" for="f1-first-name">Objeto de Fluxo</label>
                <input type="text" name="objetos[]" placeholder="Tarefa/Evento" class="f1-first-name form-control"
                       id="f1-first-name">

                    <select class="selectpicker form-control" name="tipos[]">
                            <option value="TAREFA">TAREFA</option>
                            <option value="EVENTO DE FIM">EVENTO DE FIM</option>
                            <option value="EVENTO DE INÍCIO">EVENTO DE INÍCIO</option>
                            <option value="EVENTO DE INÍCIO">EVENTO INTERMEDIÁRIO</option>
                    </select>

            </div>
            <div id="destino">
            </div>
        </div>
        <div class="f1-buttons">
            <button type="button" class="btn btn-next">Próximo</button>
        </div>
    </fieldset>

    <fieldset>

        <div class="f1-buttons">
            <button type="button" class="btn btn-next">Não</button>
            <button type="button" class="btn btn-previous" onclick="duplicarCampos()">Sim</button>
        </div>

    </fieldset>

    <fieldset>

        <div class="f1-buttons">
            <button type="button" class="btn btn-previous">Anterior</button>
            <button type="submit" class="btn btn-submit">Salvar</button>
        </div>
    </fieldset>

</form>

<script>

    function duplicarCampos() {
        var clone = document.getElementById('origem').cloneNode(true);
        var destino = document.getElementById('destino');
        destino.appendChild(clone);
        var camposClonados = clone.getElementsByTagName('input');
        for (i = 0; i < camposClonados.length; i++) {
            camposClonados[i].value = '';
        }
    }

    function removerCampos(id) {
        var node1 = document.getElementById('destino');
        node1.removeChild(node1.childNodes[0]);
    }
</script>