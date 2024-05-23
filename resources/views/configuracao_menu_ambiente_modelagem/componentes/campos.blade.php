<style>
    .control-label {
        font-weight: bold;
    }

    .organiza {
        width: 100%;
    }

    .organiza li {
        width: 40%;
    }

    .organiza li {
        display: inline-block;
        margin-left: 2%
    }
</style>

<div style="width: 80%;margin-left: 5%;">
{{--    <input name="codusuario" value="{!! Auth::getUser()->codusuario !!}" hidden>--}}
    <label class="control-label">Conceder permissão para o usuário:</label>
    <select class="selectpicker form-control" name="codusuario" data-live-search="true">
        @if(Auth::getUser()->EProprietario() || $diagrama->eProprietario())
            @foreach(Auth::getUser()->repositorio->usuarios_repositorios_cache() as $entrada)
                @if(!empty($configuracao))
                    @if($configuracao->codusuario == $entrada->codusuario)
                        <option data-tokens="{!! $entrada->usuario->name !!}"
                                value="{!! $entrada->codusuario !!}" selected>{!! $entrada->usuario->name !!}</option>
                    @else
                        <option data-tokens="{!! $entrada->usuario->name !!}"
                                value="{!! $entrada->codusuario !!}">{!! $entrada->usuario->name !!}</option>
                    @endif
                @else
                    <option data-tokens="{!! $entrada->usuario->name !!}"
                            value="{!! $entrada->codusuario !!}">{!! $entrada->usuario->name !!}</option>
                @endif

            @endforeach
        @elseif(Auth::getUser()->EAdministrador())
            @foreach(Auth::getUser()->Usuarios() as $usuario)

                @if(!empty($configuracao))
                    @if($configuracao->codusuario == $usuario->codusuario)
                        <option data-tokens="{!! $usuario->name !!}"
                                value="{!! $usuario->codusuario !!}" selected>{!! $usuario->name !!}</option>
                    @else
                        <option data-tokens="{!! $usuario->name !!}"
                                value="{!! $usuario->codusuario !!}">{!! $usuario->name !!}</option>
                    @endif
                @else
                    <option data-tokens="{!! $usuario->name !!}"
                            value="{!! $usuario->codusuario !!}">{!! $usuario->name !!}</option>
                @endif
            @endforeach
        @elseif(Auth::getUser()->Enormal())
            <option data-tokens="{!! Auth::getUser()->name !!}"
                    value="{!! Auth::getUser()->codusuario !!}" selected>{!! Auth::getUser()->name !!}</option>
        @endif
    </select>
    @if(!empty($diagrama))
        <input type="hidden" value="{!! $diagrama->codmodelodiagramatico !!}" name="codmodelodiagramatico">
        <input type="hidden" value="{!! $diagrama->codmodelo !!}" name="codmodelo">
        <input type="hidden" value="{!! $diagrama->codprojeto !!}" name="codprojeto">
        <input type="hidden" value="{!! $diagrama->codrepositorio !!}" name="codrepositorio">
    @endif


</div>

<ul class="organiza">
    <li>
        <div class="form-group">
            <label class="control-label" for="exibirdescricaodiagrama">Exibir Descrição do Diagrama</label>
            <div class="controls">

                <input name="exibirdescricaodiagrama" type="hidden" value="0">

                <label class="switch-light switch-candy">


                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibirdescricaodiagrama"
                               value="1" {!! $configuracao->ExibirDescricaoDiagrama() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibirdescricaodiagrama"
                               value="1">
                    @endif

                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiradicaousuariosdiagrama">Adição de Usuários </label>
            <div class="controls">
                <input name="exibiradicaousuariosdiagrama" type="hidden" value="0">
                <label class="switch-light switch-candy">


                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiradicaousuariosdiagrama"
                               value="1" {!! $configuracao->ExibirAdicaoUsuariosDIagrama() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiradicaousuariosdiagrama"
                               value="1">
                    @endif
                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiralteracoes">Exibir Alterações</label>
            <div class="controls">
                <input name="exibiralteracoes" type="hidden" value="0">
                <label class="switch-light switch-candy">
                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiralteracoes"
                               value="1" {!! $configuracao->ExibirAlteracoes() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiralteracoes"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiriconepainel">Exibir Ícone do Painel</label>
            <div class="controls">
                <input name="exibiriconepainel" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiriconepainel"
                               value="1" {!! $configuracao->ExibirIconePainel() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiriconepainel"
                               value="1">
                    @endif

                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibireditarmodelouploaddiagrama">Editar Modelo</label>
            <div class="controls">
                <input name="exibireditarmodelouploaddiagrama" type="hidden" value="0">
                <label class="switch-light switch-candy">
                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibireditarmodelouploaddiagrama"
                               value="1" {!! $configuracao->ExibirEditarModeloUploadDiagrama() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibireditarmodelouploaddiagrama"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessoeditardiagrama">Editar/Transferir/Novo Diagrama</label>
            <div class="controls">
                <input name="exibiracessoeditardiagrama" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessoeditardiagrama"
                               value="1" {!! $configuracao->ExibirAcessoEditarDiagrama() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessoeditardiagrama"
                               value="1">
                    @endif

                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessodocumentacaotextual">Acesso a Documentação
                Textual</label>
            <div class="controls">
                <input name="exibiracessodocumentacaotextual" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessodocumentacaotextual"
                               value="1" {!! $configuracao->ExibirAcessoDocumentacaoTextual() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessodocumentacaotextual"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessosrecentes">Exibir Acessos Recentes</label>
            <div class="controls">
                <input name="exibiracessosrecentes" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessosrecentes"
                               value="1" {!! $configuracao->ExibirAcessosRecentes() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessosrecentes"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

    </li>

    <li>


        <div class="form-group">
            <label class="control-label" for="exibiracessousuarios">Usuários</label>
            <div class="controls">
                <input name="exibiracessousuarios" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessousuarios"
                               value="1" {!! $configuracao->ExibirAcessoUsuarios() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessousuarios"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessoadicaovalidador">Adição de Validador</label>
            <div class="controls">
                <input name="exibiracessoadicaovalidador" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessoadicaovalidador"
                               value="1" {!! $configuracao->ExibirAcessoAdicaoValidador() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessoadicaovalidador"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessovalidardiagrama">Validar Diagrama</label>
            <div class="controls">
                <input name="exibiracessovalidardiagrama" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessovalidardiagrama"
                               value="1" {!! $configuracao->ExibirAcessoValidarDiagrama() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessovalidardiagrama"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label" for="exibiracessoenviarmensagem">Enviar Mensagem</label>
            <div class="controls">
                <input name="exibiracessoenviarmensagem" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessoenviarmensagem"
                               value="1" {!! $configuracao->ExibirAcessoEnviarMensagem() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessoenviarmensagem"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessodonwloaddiagrama">Donwload Diagrama</label>
            <div class="controls">
                <input name="exibiracessodonwloaddiagrama" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessodonwloaddiagrama"
                               value="1" {!! $configuracao->ExibirAcessoDonwloadDiagrama() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessodonwloaddiagrama"
                               value="1">
                    @endif


                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessoinformacoesdiagrama">Informações do Diagrama</label>
            <div class="controls">
                <input name="exibiracessoinformacoesdiagrama" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessoinformacoesdiagrama"
                               value="1" {!! $configuracao->ExibirAcessoInformacoesDiagrama() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessoinformacoesdiagrama"
                               value="1">
                    @endif

                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="exibiracessorepositorios">Repositórios</label>
            <div class="controls">
                <input name="exibiracessorepositorios" type="hidden" value="0">
                <label class="switch-light switch-candy">

                    @if(!empty($configuracao))
                        <input type="checkbox" name="exibiracessorepositorios"
                               value="1" {!! $configuracao->ExibirAcessoRepositorios() ? 'checked' : '' !!}>
                    @else
                        <input type="checkbox" name="exibiracessorepositorios"
                               value="1">
                    @endif

                    <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                </label>
            </div>
        </div>
    </li>
    <button style="width: 82%;margin-left: 2%;" type="submit" class="btn btn-dark form-control">Salvar</button>

</ul>
