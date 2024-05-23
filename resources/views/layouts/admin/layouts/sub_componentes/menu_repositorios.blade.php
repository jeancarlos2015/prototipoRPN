
@if(count(Auth::user()->usuarios_repositorios)<=10)
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
           Meus Repositórios
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach(Auth::user()->usuarios_repositorios_distintos() as $usuario_repositorio)
                @if(Auth::getuser()->TemPermissaoParaEscluir())
                    <a class="dropdown-item"
                       href="{!! route('create_vinculo_repositorio',[$usuario_repositorio->repositorio->codrepositorio,0]) !!}">
                        @if(Auth::user()->usuario_esta_no_repositorio() && Auth::user()->repositorio->codrepositorio == $usuario_repositorio->codrepositorio)
                            <strong>
                                <i class="fa fa-database faa-pulse "></i> {!! $usuario_repositorio->repositorio->nome !!}
                                - {!! $usuario_repositorio->tipo !!}
                            </strong>
                        @else
                            <i class="fa fa-database faa-pulse "></i>     {!! $usuario_repositorio->repositorio->nome !!}
                            - {!! $usuario_repositorio->tipo !!}
                        @endif

                    </a>
                @else

                    <a class="dropdown-item"
                       href="{!! route('create_vinculo_repositorio',[$usuario_repositorio->repositorio->codrepositorio,0]) !!}">
                        @if(Auth::user()->usuario_esta_no_repositorio() && Auth::user()->repositorio->codrepositorio == $usuario_repositorio->codrepositorio)
                            <strong>
                                <i class="fa fa-database faa-pulse "></i> {!! $usuario_repositorio->repositorio->nome !!}
                                - {!! $usuario_repositorio->tipo !!}
                            </strong>
                        @else
                            <i class="fa fa-database faa-pulse "></i> {!! $usuario_repositorio->repositorio->nome !!}
                            - {!! $usuario_repositorio->tipo !!}
                        @endif

                    </a>
                @endif

            @endforeach
            @if(Auth::user()->usuario_esta_no_repositorio())
                <a class="dropdown-item" href="{!! route('delete_vinculo_repositorio')!!}">Sair Do Repositório</a>
            @endif
        </div>
    </div>

@else
    <a class="nav-link"
       data-toggle="modal"
       data-target="#modal-listagem-repositorios"
       style="cursor: pointer;" title="Repositórios Vinculados">
        <img style="width: 10px;" src="{!! asset('images/gifs/seta-apontando.gif') !!}"/>
        <i class="fa fa-database faa-pulse "></i>
        <div id="repositorios2020"></div>

    </a>
@endif

{{--<script>--}}

{{--    function Mostrar() {--}}
{{--        Swal.fire({--}}
{{--            title: '<strong><i class="fa fa-database"></i>Repositorios</strong>',--}}
{{--            icon: 'info',--}}
{{--            html:'Está prestes a exibir os repositórios, tem certeza que deseja continuar?',--}}
{{--            showCloseButton: true,--}}
{{--            showCancelButton: true,--}}
{{--            focusConfirm: false,--}}
{{--            confirmButtonText:--}}
{{--                '<a style="cursor:pointer;"  data-toggle="modal" data-target="#modal-listagem-repositorios" > Sim </a>',--}}
{{--            confirmButtonAriaLabel: 'Thumbs up, great!',--}}
{{--            cancelButtonText:--}}
{{--                '<i class="fa fa-thumbs-down"></i>',--}}
{{--            cancelButtonAriaLabel: 'Não'--}}
{{--        })--}}
{{--    }--}}
{{--</script>--}}
