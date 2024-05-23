<section id="signup" class="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">

                <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">RPN - Documentos Públicos</h2>

            </div>
        </div>
        <div class="table-responsive table-dark">
            <table id="dataTable" class="table table-dark" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>
                        Documentos
                    </th>
                </tr>
                </thead>
                <tfoot>
                <tr>

                    <th>Documentos</th>
                </tr>
                </tfoot>
                <tbody>
                @if(!empty($documentos))
                    @foreach($documentos as $documento)
                        @if($documento->publico)
                            <tr>


                                <td>
                                    @if($documento->tipo()=='video')
                                        <div class="media-body">
                                            <strong>{!!  $documento->nome !!}</strong>

                                            <div class="text-muted smaller">
                                                Responsável: {!! $documento->usuario->name !!}</div>

                                            <div class="text-muted smaller">
                                                Descrição: {!! $documento->descricao !!}</div>

                                        </div>
                                        <a onclick="return confirm('Deseja acessar o documento?');"
                                           href="{!! $documento->link !!}"
                                           style="display: inline-block">'
                                            <input type="image"
                                                   src="https://img.youtube.com/vi/{!! $documento->getIdVideoYoutube() !!}/maxresdefault.jpg"
                                                   alt="Submit"
                                                   width="450"
                                                   title="Abrir Documento">
                                        </a>

                                    @else
                                        <a onclick="return confirm('Deseja acessar o documento?');"
                                           href="{!! $documento->link !!}"
                                           style="display: inline-block">'
                                            <input type="image" src="{!! asset('img/documento.png') !!}" alt="Submit"
                                                   width="50"
                                                   title="Abrir Documento">
                                        </a>
                                        <div class="media-body">
                                            <strong>{!!  $documento->nome !!}</strong>

                                            <div class="text-muted smaller">
                                                Responsável: {!! $documento->usuario->name !!}</div>

                                            <div class="text-muted smaller">
                                                Descrição: {!! $documento->descricao !!}</div>

                                            {{--<div class="text-muted smaller">--}}
                                            {{--Visibilidade: visível </div>--}}
                                        </div>

                                    @endif


                                </td>

                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
