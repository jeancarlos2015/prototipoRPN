
    <form  action="{!! route('atualizar_descricao_diagrama',[$diagrama->codmodelodiagramatico]) !!}" method="post"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <main>

            <div class="adjoined-bottom">
                <div class="grid-container">
                    <div class="grid-width-100">

				<textarea id="editor" name="descricao">
                    {!! $diagrama->descricao !!}
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
