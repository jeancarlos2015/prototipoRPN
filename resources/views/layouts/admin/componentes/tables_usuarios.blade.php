@if(!empty($usuarios))
    <tbody>

    @foreach($usuarios as $usuario)
        @if(Auth::user()->EAdministrador())

            <tr id="codusuario{!! $usuario->codusuario !!}">

                <td>
                    @includeIf('layouts.admin.componentes.dado_usuario_administrador_descricao')
                </td>
                {{--Ações--}}

                <td>
                    @includeIf('layouts.admin.componentes.dado_usuario_administrador_rotas')
                </td>

            </tr>
        @else


                <tr id="codusuario{!! $usuario->codusuario !!}">

                    <td>
                        @includeIf('layouts.admin.componentes.dado_usuario_administrador_descricao')
                    </td>
                    {{--Ações--}}

                    <td>
                        @includeIf('layouts.admin.componentes.dado_usuario_administrador_rotas')
                    </td>

                </tr>

        @endif
    @endforeach
    </tbody>
@endif
