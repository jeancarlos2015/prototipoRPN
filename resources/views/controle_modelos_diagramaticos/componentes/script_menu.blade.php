<script>
    $(function () {
        @if($modelo->modelo->publico)
        $('#idTrocarTipoPublicoPrivadoModelo').prop('checked', true).change();
        @else
        $('#idTrocarTipoPublicoPrivadoModelo').prop('checked', false).change();
        @endif
    });
    $(document).ready(function () {
        $('.navbar').mouseleave(function (event) {
            $('.navbar').hide();
            $("#idambienteModelagemBody").css({top: '0px'});
            $("#canvas").css({top: '0px'});
            $("html").css({top: '0px'});
        });

        $('#idambienteModelagemBody').mouseleave(function (event) {
            $('.navbar').show();
            $("#idambienteModelagemBody").css({top: '65px'});
            $("#canvas").css({top: '65px'});
            $("html").css({top: '65px'});
        });
    });
</script>
