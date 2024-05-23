
    <form  action="{!! route('atualizar_descricao_modelo',[$modelo->codmodelo]) !!}" method="post"
           enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <main>

            <div class="adjoined-bottom">
                <div class="grid-container">
                    <div class="grid-width-100">

				<textarea id="editor" name="descricao">
                    {!! $modelo->descricao !!}
				</textarea>
                        <input type="hidden" name="publico" value="false">
                    </div>
                </div>
            </div>


        </main>

    </form>


<script>
    initSample();


</script>
