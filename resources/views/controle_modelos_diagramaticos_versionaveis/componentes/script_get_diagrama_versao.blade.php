<script>

    $(document).ready(function () {
        var codmodelo = '{!! $modelo->coddiagramaversionavel  !!}';
        $.ajax({
            url: "baixar/" + codmodelo + "/versionavel",
            type: "GET",
            dataType: "text",
            success: function (resposta) {
                console.log(resposta);
                openDiagramAuxiliar(resposta);
            },
            error: function (request, status, error) {
                console.log(request.responseText);
                console.log(status);
                console.log(error);
            }
        });
    });

</script>
