@if(Auth::getUser()->TemAviso())

    <div class="modal fade" id="modal-aviso4343456">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img class="d-flex mr-3 rounded-circle"
                         src="{{ Gravatar::src(Auth::getUser()->Aviso()->responsavel->email) }}"
                         alt="" width="60"/>
                    <h1 class="text-info" style="margin-right: 20%">{!! Auth::getUser()->Aviso()->assunto !!}</h1>
                </div>
                <div class="modal-body">


                    {!! Auth::getUser()->Aviso()->texto !!}


                    <div class="modal-footer">
                        <a href="{!! route('controle_avisos.show',[Auth::getUser()->Aviso()->codmensagem]) !!}"
                           class="btn btn-dark form-control" style="cursor: pointer;">Ok</a>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endif
