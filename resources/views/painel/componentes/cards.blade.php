@if (Auth::getUser()->ECliente())

    @if (isset($quantidades['modelo']))
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color: #00a67c">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list faa-pulse "></i>
                    </div>

                    <div class="mr-5">{!! $quantidades['modelo'] !!} Modelos</div>
                    @if (Auth::getUser()->qt_diagramas() > -1)
                        <div class="mr-5">{!! Auth::getUser()->qt_diagramas() !!} Diagramas</div>
                    @endif

                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas['modelo']) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                        <i class="fa fa-angle-right faa-pulse "></i>
                    </span>
                </a>
            </div>
        </div>
    @endif
    @if (isset($quantidades['projeto']))
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color: #2c4762">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list faa-pulse "></i>
                    </div>

                    <div class="mr-5">{!! $quantidades['projeto'] !!} Processos</div>

                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas['projeto']) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                        <i class="fa fa-angle-right faa-pulse "></i>
                    </span>
                </a>
            </div>
        </div>
    @endif

@endif




@if (Auth::getUser()->EProprietario())
    @if (isset($quantidades['solicitacao']))
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color: gray">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list faa-pulse "></i>
                    </div>

                    <div class="mr-5">{!! $quantidades['solicitacao'] !!} Solicitacoes</div>

                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas['solicitacao']) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                        <i class="fa fa-angle-right faa-pulse "></i>
                    </span>
                </a>
            </div>
        </div>
    @endif
    @if (isset($quantidades['usuariosonline']))
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color: darkblue">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list faa-pulse "></i>
                    </div>

                    <div class="mr-5">{!! $quantidades['usuariosonline'] !!} Usuários Online</div>

                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas['usuariosonline']) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                        <i class="fa fa-angle-right faa-pulse "></i>
                    </span>
                </a>
            </div>
        </div>
    @endif
    @if (isset($quantidades['usuarios']) && Auth::getUser()->EAdministrador() && !Auth::user()->usuario_esta_no_repositorio())
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color: darkmagenta">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list faa-pulse "></i>
                    </div>

                    <div class="mr-5">{!! $quantidades['usuarios'] !!} Usuários</div>

                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas['usuarios']) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                        <i class="fa fa-angle-right faa-pulse "></i>
                    </span>
                </a>
            </div>
        </div>
    @endif
    @if (Auth::getUser()->EAdministrador())
        @if (isset($quantidades['repositorio']))
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white o-hidden h-100" style="background-color: #5f3f3f">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-list faa-pulse "></i>
                        </div>

                        <div class="mr-5">{!! $quantidades['repositorio'] !!} Repositórios</div>

                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas['repositorio']) !!}">
                        <span class="float-left">Visualizar</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right faa-pulse "></i>
                        </span>
                    </a>
                </div>
            </div>
        @endif
    @endif
    @if (Auth::getUser()->EAdministrador() && Auth::getUser()->email === 'jeancarlospenas25@gmail.com')
        @if (isset($quantidades['logs']))
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white o-hidden h-100" style="background-color: darkolivegreen">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-list faa-pulse "></i>
                        </div>

                        <div class="mr-5">{!! $quantidades['logs'] !!} Logs</div>
                        <div class="mr-5"> {!! count(Auth::getUser()->logsErros()) !!} Erros</div>
                        <div class="mr-5">{!! count(Auth::getUser()->logsOutros()) !!} Outros</div>

                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas['logs']) !!}">
                        <span class="float-left">Visualizar</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right faa-pulse "></i>
                        </span>
                    </a>
                </div>
            </div>
        @endif

    @endif
@endif
