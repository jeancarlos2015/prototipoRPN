@includeIf('controle_documentacao.componentes.campos')
@if(Auth::getUser()->EProprietario() || Auth::getUser()->EAdministrador())
    @if(empty($documentacao))
        @includeIf('componentes.botao_sim_nao',[
        'pergunta' => 'Deseja tornar este registro visível para todos os usuários?',
        'name' => 'publico'
        ])

        <div class="form-group">
            <label>Tipo</label><br>
            <select class="form-control" name="tipo" required>
                <option value="1">VIDEO</option>
                <option value="2">DOCUMENTO</option>
                <option value="3">IMAGEM</option>
                <option value="4" selected>TEXTO</option>
                @if(Auth::getUser()->EAdministrador())
                    <option value="5" selected>AVISO</option>
                @endif
            </select>
        </div>
    @else
        @includeIf('componentes.botao_sim_nao',[
        'pergunta' => 'Deseja tornar este registro visível para todos os usuários?',
        'objeto' => $documentacao,
        'name' => 'publico'
        ])
        <div class="form-group">
            <label>Tipo</label><br>
            <select class="form-control" name="tipo" required>
                @for($tipo =1; $tipo<5; $tipo++)
                    @if($documentacao->tipo==$tipo)
                        <option value="{!! $tipo !!}" selected>{!! $documentacao->GetTipo($tipo) !!}</option>
                    @else
                        <option value="{!! $tipo !!}">{!! $documentacao->GetTipo($tipo) !!}</option>
                    @endif

                @endfor
            </select>
        </div>
    @endif


@else
    <input type="hidden" name="publico" value="true">
@endif
@if(empty($documentacao->codusuario))
    <input type="hidden" name="codusuario" value="{!! Auth::getUser()->codusuario !!}">
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>

