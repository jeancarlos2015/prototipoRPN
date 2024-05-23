
    <div class="modal fade" id="modal-form-aviso">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-info">Novo Aviso</h1>
                </div>
                <div class="modal-body">
                    <form action="{!! route('controle_avisos.store') !!}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Assunto</label>
                            <input type="text" class="form-control" name="assunto">
                        </div>

                        <div class="form-group">
                            <label>Aviso</label>
                            <textarea id="editor" name="texto" class="form-control">
                        </textarea>
                        </div>
                        <input type="hidden" name="tipo" value="5">
                        <input type="hidden" name="codusuario" value="{!! Auth::getUser()->codusuario !!}">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark form-control">Salvar</button>
                            <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        initSample();
    </script>
