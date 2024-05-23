<section id="signup" class="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">

                <i class="far fa-paper-plane faa-pulse  fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">RPN - Modelos Públicos</h2>

            </div>
        </div>
        <div class="table-responsive table-dark">
            <table id="dataTable" class="table table-dark" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Modelos</th>
                    <th>Alteração</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Modelos</th>
                    <th>Alteração</th>
                </tr>
                </tfoot>
                <tbody>
                @if(!empty($modelos))
                    @foreach($modelos as $diagrama)
                        <tr>
                            <td>
                                @includeIf('modelos_publicos.componentes.tabela.show',['representacao_diagramatica' => $diagrama])
                            </td>

                            <td>
                                {!! $diagrama->updated_at->format('Y-m-d') !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
