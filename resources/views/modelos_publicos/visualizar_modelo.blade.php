@extends('layouts.layout_diagrama_visualizacao.main')
@section('content')
    @if($modelo->modelo->publico)
        @includeIf('modelos_publicos.componentes.Canvas.InfoCanvas')
        @includeIf('modelos_publicos.componentes.modais.modal-modelo',['modelo' => $modelo->modelo])
    @else
        <h3>Não tem permissão para acessar este modelo, favor entrar em contato com o proprietário.</h3>
    @endif
@endsection

@section('boltao_voltar')
    @if($modelo->modelo->publico)
        @includeIf('modelos_publicos.componentes.Canvas.InfoDiagrama')
        @includeIf('componentes.Voltar')
    @endif
@endsection


@Auth
@section('menu_usuarios_superior')
    @if($modelo->modelo->publico)
        @includeIf('menu.componentes.menu_usuarios_superior',[
        'entradas' => $modelo->modelo->usuarios_modelos
        ])
    @endif
@endsection
@endauth


@section('script_js')
    @includeIf('layouts.admin.layouts.layout_principal.scripts')
    <script>
        $(document).ready(function(){
            $('.navbar').mouseleave(function(event){
                $('.navbar').hide();
                $("#bodyModeloPublico").css({top: '0px'});
                $("#canvas").css({top: '0px'});
                $("html").css({top: '0px'});
            });

            $('#bodyModeloPublico').mouseleave(function(event){
                $('.navbar').show();
                $("#bodyModeloPublico").css({top: '65px'});
                $("#canvas").css({top: '65px'});
                $("html").css({top: '65px'});
            });
        });
    </script>
@endsection
