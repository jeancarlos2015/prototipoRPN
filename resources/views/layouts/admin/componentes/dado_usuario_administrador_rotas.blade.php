<ul style="list-style-type: none;">


    @if(Auth::user()->EAdministrador() || (Auth::user()->codusuario==$usuario->codusuario) && $usuario->email!=='jeancarlospenas25@gmail.com')


            @if(!empty($rota_edicao))
                <li>
                    @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao,'mensagem' => 'Deseja editar este usuario?'])
                </li>

            @endif

            @if(!empty($rota_exclusao))
                <li>
                    <a style="cursor: pointer" onclick="excluir('{!! $usuario->codusuario !!}','codusuario')" >
                        <img
                            src="{!! asset('img/delete.png') !!} " style="width: 20px"
                            title="deletar">
                    </a>
                </li>
            @endif
                @if($usuario->existe_repositorio())
                    <li>
                        @includeIf('componentes.form_desvincular',[
                        'id' => $usuario->codusuario
                        ])
                    </li>
                @endif

                @if(!empty($rota_exibicao))
                    <li>
                        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    </li>

                @endif
        @elseif($usuario->codusuario===Auth::user()->codusuario || Auth::getUser()->EAdministrador())
            @if(!empty($rota_edicao))
                <lI>
                    @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao, 'mensagem' => 'Deseja editar este usuario?'])
                </lI>

            @endif

            @if(!empty($rota_exclusao))
                <li>
                    <a style="cursor: pointer" onclick="excluir('{!! $usuario->codusuario !!}','codusuario')" >
                        <img
                            src="{!! asset('img/delete.png') !!} " style="width: 20px"
                            title="deletar">
                    </a>
                </li>

            @endif



    @elseif(in_array($usuario->papel(),['COLABORADOR','CLIENTE']) || $usuario->permissao())
        @if(!empty($rota_exibicao))
            <li>
                @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
            </li>

        @endif

        @if($usuario->existe_repositorio())
            <li>
                @includeIf('componentes.form_desvincular',[
                'id' => $usuario->codusuario
                ])
            </li>
        @endif


    @elseif($usuario->codusuario===Auth::user()->codusuario)
        <li>
            @if(!empty($rota_exibicao))
                @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
            @endif
        </li>
        <li>
            @if($usuario->existe_repositorio())
                @includeIf('componentes.form_desvincular',[
                'id' => $usuario->codusuario
                ])
            @endif
        </li>

    @endif

</ul>



