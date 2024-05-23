@if(Auth::getUser()->TemAviso())
    <div class="modal fade" id="modal-aviso4343456">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img class="d-flex mr-3 rounded-circle"
                         src="{{ Gravatar::src(Auth::getUser()->Aviso()->responsavel->email) }}"
                         alt="" width="30"/>
                    <h4 class="text-info">{!! Auth::getUser()->Aviso()->assunto !!}</h4>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>
                            {!! Auth::getUser()->Aviso()->texto !!}
                        </li>

                    </ul>
                    <div class="modal-footer">
                        <a href="{!! route('controle_avisos.show',[Auth::getUser()->Aviso()->codmensagem]) !!}"
                           class="btn btn-dark" style="cursor: pointer;">Ok</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#modal-aviso4343456").onmouseover(function () {
                $("#modal-aviso4343456").modal();
            });
        });
    </script>
@endif