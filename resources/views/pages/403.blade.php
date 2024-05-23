@extends('layouts.layout_diagrama_visualizacao.main')
@section('content')
    <h3>Não tem permissão para acessar este modelo, favor entrar em contato com o proprietário.</h3>
@endsection

@section('boltao_voltar')
    @includeIf('componentes.Voltar')
@endsection





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
