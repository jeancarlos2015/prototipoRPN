@foreach($modelos as $modelo)
<div id="GSCCModalModelo{!! $modelo->codmodelo  !!}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-edit fa-2x"></i> Descrição Textual</h4>
            </div>
            <form action="{!! route('controle_modelos.update',['id' => $modelo->codmodelo]) !!}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <label>Modelo: {!! $modelo->nome !!}</label> <br>
                    <label>Projeto: {!! $modelo->projeto->nome !!}</label><br>
                    <label>Repositório: {!! $modelo->repositorio->nome !!}</label>
                </div>
                <div class="modal-body">

                    <textarea  name="descricao" id="editor" required></textarea>
                </div>

                <div class="modal-body">
                    <div class="text-left">
                    <textarea class="form-control" name="descricao1"  rows="5" disabled>
                        {!! $modelo->descricao !!}
                    </textarea>
                    </div>


                </div>
                <input type="hidden" name="tipoOperacao" value="AtualizarDescricao">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input type="submit" class="btn btn-primary" value="Salvar"/>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach
