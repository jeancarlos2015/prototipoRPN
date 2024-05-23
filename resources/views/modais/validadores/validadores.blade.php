@if(!empty($diagrama))
    <div class="modal fade" id="modal-usuario-validador">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h2><i class="fa fa-user-plus faa-pulse  fa-2x"></i> Adição de Validador de Diagrama</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                        <input name="consulta" id="txt_consulta_validadores" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    <table id="tabela" class="table table-responsive fonte-menor" style="width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 25%;">Nome</th>
                            <th style="width: 25%;">Ações</th>
                            <th style="width: 25%;">Status</th>
                            <th style="width: 25%;">É Validador?</th>

                        </tr>
                        </thead>
                        <tbody>

                            @foreach(Auth::getUser()->usuarios_repositorios_distintos() as $usuario_repositorio)

                                   @if(!empty($usuario_repositorio->usuario->name))
                                       <tr id="usuarioValidador{!!$usuario_repositorio->codusuario  !!}">


                                           <td style="width: 25%;"
                                               title="{!! $usuario_repositorio->usuario->email !!}">

                                               <div class="media" style="cursor: pointer;">
                                                   <img class="d-flex mr-3 rounded-circle"
                                                        src="{{ Gravatar::src($usuario_repositorio->usuario->email) }}"
                                                        alt="" width="30">

                                                   <div class="media-body">
                                                       {!! $usuario_repositorio->usuario->name !!}
                                                   </div>
                                               </div>
                                           </td>
                                           <td style="width: 25%;"
                                               title="{!! $usuario_repositorio->usuario->email !!}">
                                               <div class="form-group">
                                                   <a
                                                       onclick="atribuirUsuarioProprietarioProjeto(
                                                       '{!! $rota !!}',
                                                       '{!! $usuario_repositorio->codusuario !!}',
                                                       '{!! $usuario_repositorio->usuario->email !!}',
                                                       '{!! $usuario_repositorio->usuario->name !!}',
                                                       '{!! $codigo !!}',
                                                       '#usuarioValidador{{$usuario_repositorio->codusuario}}'
                                                       )">

                                                       <div class="media" style="cursor: pointer;">
                                                           <img class="d-flex mr-3 rounded-circle"
                                                                src="{!! asset('img/user-ico.png') !!} "
                                                                style="width: 15px">
                                                       </div>

                                                   </a>
                                                   {{--                                                <a onclick="return confirm('Deseja configurar um validador este Diagrama?');"--}}
                                                   {{--                                                   href="{!! route('AdicionarValidador',[$usuario_repositorio->codusuario,$diagrama->codmodelodiagramatico]) !!}"--}}
                                                   {{--                                                   title="Tornar o {!! $usuario_repositorio->usuario->name !!} como validador do diagrama?">--}}
                                                   {{--                                                    <div class="media" style="cursor: pointer;">--}}
                                                   {{--                                                        <img class="d-flex mr-3 rounded-circle"--}}
                                                   {{--                                                             src="{!! asset('img/user-ico.png') !!} "--}}
                                                   {{--                                                             style="width: 15px">--}}
                                                   {{--                                                    </div>--}}
                                                   {{--                                                </a>--}}

                                               </div>
                                           </td>
                                           <td style="width: 25%;">
                                               <div class="media" style="cursor: pointer;" align="right">

                                                   @if($usuario_repositorio->usuario->online())
                                                       <img class="d-flex mr-3 rounded-circle"
                                                            src="{!! asset('img/on.png') !!} "
                                                            style="width: 15px">
                                                   @else
                                                       <img class="d-flex mr-3 rounded-circle"
                                                            src="{!! asset('img/off.png') !!} "
                                                            style="width: 15px">
                                                   @endif
                                               </div>
                                           </td>
                                           <td style="width: 25%;">
                                               <div class="media" style="cursor: pointer;" align="right">

{{--                                                   @if($diagrama->eValidador($usuario_repositorio->codusuario))--}}
{{--                                                       <img id="usuariomodelo{!! $usuario_repositorio->codusuariorepositorio !!}" class="d-flex mr-3 rounded-circle"--}}
{{--                                                            src="{!! asset('img/ok.png') !!} "--}}
{{--                                                            style="width: 20px">--}}
{{--                                                   @else--}}
{{--                                                       <img id="usuariomodelo{!! $usuario_repositorio->codusuariorepositorio !!}" class="d-flex mr-3 rounded-circle"--}}
{{--                                                            src="{!! asset('img/nao-ok.png') !!} "--}}
{{--                                                            style="width: 20px">--}}
{{--                                                   @endif--}}
                                               </div>
                                           </td>
                                       </tr>

                                   @endif



                            @endforeach



                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
