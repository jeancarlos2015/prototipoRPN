<script src="{!! asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') !!}"></script>
<script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset("vendor/jquery-ui-1.12.1/jquery-ui.min.js") !!}"></script>
<script src="{!! asset("vendor/bootstrap-4.1.3-dist/js/bootstrap.bundle.min.js") !!}"></script>
<script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
{{--<script src="{!! asset('vendor/chart.js/Chart.min.js') !!}"></script>--}}
{{--<script src="{!! asset('vendor/datatables/jquery.dataTables.js') !!}"></script>--}}
{{--<script src="{!! asset('vendor/datatables/dataTables.bootstrap4.js') !!}"></script>--}}
{{--<script src="{!! asset('js/sb-admin.min.js') !!}"></script>--}}
{{--<script src="{!! asset('js/sb-admin-datatables.min.js') !!}"></script>--}}
@Auth
    @if(!empty(getenv('homologacao')) && !Auth::user()->EAdministrador())
        <script>

            $(document).ready(function () {
                $('#modal-mensagem4343432').modal('show');
            })
        </script>
    @endif
@endauth

@Auth
    @if(count(Auth::user()->todas_solicitacoes())>0 && in_array(Auth::getUser()->papel(),['ADMINISTRADOR','PROPRIETARIO']))
        <script>
            $(document).ready(function () {
                $('#modal-mensagem-solicitacao').modal('show');
            })
        </script>
    @endif

    <script>
        $(document).ready(function () {
            // $("#successMessage").delay(5000).slideUp(60);
            $('div.alert').delay(30000).slideUp(59);
        });
    </script>
@endauth

<script src="{!! asset('plugins/bootstrap-sweetalert/sweet-alert.min.js') !!}"></script>
<script src="{!! asset('pages/jquery.sweet-alert.init.js') !!}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/i18n/defaults-pt_BR.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>
<script>
    $('input#txt_consulta').quicksearch('table#tabela tbody tr');
</script>
