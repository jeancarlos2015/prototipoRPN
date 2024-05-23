<div class="modal fade" id="modal-mensagem">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{--<button type="button" class="close" data-dismiss="modal"><span>×</span></button>--}}
                @if(!empty($repositorio->nome) && $titulo ==='repositorio')
                    <h4 class="modal-title">Repositório {!! $repositorio->nome !!}</h4>
                @elseif(!empty($projeto->nome) && $titulo ==='projeto')
                    <h4 class="modal-title">Projeto {!! $projeto->nome !!}</h4>
                @elseif(!empty($modelo->nome) && $titulo ==='modelo')
                    <h4 class="modal-title">Modelo {!! $modelo->nome !!}</h4>
                @endif
            </div>
            <div class="modal-body">
                @if(!empty($rota_vinculo))
                    <form action="{!! route($rota_vinculo) !!}" method="post">
                        @method('POST')
                        @csrf
                        <div class="form-group">

                            <label>Usuário</label>
                            <select class="selectpicker form-control" name="codusuario">
                                @if(!empty($usuarios))
                                    @foreach($usuarios as $user)
                                        <option value="{!! $user->codusuario !!}">{!! $user->name.' - '.$user->email !!}</option>
                                    @endforeach
                                @endif
                            </select>

                            <label>Tipo De Usuário</label>
                            <select class="selectpicker form-control" name="tipo">
                                @if(!empty($tipos))
                                    @if(Auth::getuser()->EProprietario() || Auth::user()->tipo==='Administrador' )
                                        @foreach($tipos as $tipo)
                                            <option value="{!! $tipo !!}">{!! $tipo !!}</option>
                                        @endforeach
                                    @elseif(Auth::getuser()->EColaborador())
                                        <option value="COLABORADOR">COLABORADOR</option>
                                        <option value="CLIENTE">CLIENTE</option>
                                    @elseif(Auth::getuser()->Ecliente())
                                        <option value="CLIENTE">CLIENTE</option>
                                    @endif
                                @endif
                            </select>

                            <input type="hidden" value="{!! $projeto->codprojeto !!}" name="codprojeto">
                        </div>
                        <input type="submit" class="btn btn-dark form-control" value="Atribuir Usuario">

                    </form>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>