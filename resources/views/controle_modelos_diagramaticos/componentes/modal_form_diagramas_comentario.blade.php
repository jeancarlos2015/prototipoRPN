@foreach($diagramas as $diagrama)
    <div id="GSCCModalDiagrama{!! $diagrama->codmodelodiagramatico  !!}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Comentário</h4>
                </div>
                <form action="{!! route('atualizar_diagrama',['id' => $diagrama->codmodelodiagramatico]) !!}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <label>Modelo: {!! $diagrama->nome !!}</label> <br>
                        <label>Projeto: {!! $diagrama->projeto->nome !!}</label><br>
                        <label>Repositório: {!! $diagrama->repositorio->nome !!}</label>
                    </div>
                    <div class="modal-body">
                        <label>Comentário</label>

                        <textarea class="form-control" name="descricao" required></textarea>
                    </div>

                    <div class="modal-body">
                        <div class="text-left">
                    <textarea class="form-control" name="descricao1"  rows="5" disabled>
                        {!! $diagrama->descricao !!}
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
