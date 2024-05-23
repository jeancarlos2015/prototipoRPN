
    @if(Auth::user()->usuario_esta_no_repositorio())
        <tr>


            <td colspan="2">
                <div class="media" style="cursor: pointer;">
                    <img class="d-flex mr-3 rounded-circle"
                         src="{{ Gravatar::src(Auth::getUser()->email) }}"
                         alt="" width="30">

                    <div class="media-body">
                        @if(Auth::user()->usuario_esta_no_repositorio() )
                            <strong>
                                <i class="fa fa-database faa-pulse "></i> {!! Auth::getUser()->repositorio->nome !!}<br>
                                <i class="fa fa-user-circle-o"></i>{!! Auth::getUser()->papel() !!}
                            </strong>
                        @endif
                    </div>
                </div>
            </td>

            <td style="width: 40%">
                @if(Auth::user()->usuario_esta_no_repositorio())
                    <strong>
                        <a href="{!! route('delete_vinculo_repositorio')!!}"
                           style="cursor: pointer;">
                            <img class="d-flex mr-3 rounded-circle"
                                 src="{!! asset('img/ok.png') !!} "
                                 alt="" width="50" title="Sair">
                        </a>
                    </strong>
                @endif

            </td>
        </tr>
    @endif
