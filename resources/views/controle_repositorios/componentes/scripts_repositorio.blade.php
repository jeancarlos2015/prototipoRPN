<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>
<script>
    $('input#txt_consulta').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_repositorios').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_acessos_recentes').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_solicitacoes').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_validadores').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_listagem_usuarios').quicksearch('table#tabela tbody tr');
</script>
<script>
    $('#desvincular').on('submit', function () {
        var $this = $(this);    // reference to the current scope
        dialog.confirm({
            message: 'Deseja Desvincular Este Usuário?',
            confirm: function () {
                $this.off('submit').submit();
            },
            cancel: function () {
            }
        });

        return false;
    });
</script>
