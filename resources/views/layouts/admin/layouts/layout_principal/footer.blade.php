
    <footer class="sticky-footer" style="width: 100%;">
        @if(Auth::user()->existe_repositorio())
            <div class="container">

                <div class="text-center">
                    <small>Copyright © Repositório de Processos de Negócio 2018</small>
                </div>
            </div>
        @else
            <div class="row">
                <div class="text-center">
                    <small>Copyright © Repositório de Processos de Negócio 2018</small>
                </div>
            </div>

        @endif
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
