<script src="{!! asset('vendor/mordernize/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('vendor/mordernize/2.8.3/modernizr.js') !!}"></script>
<script src="{!! asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') !!}"></script>
@yield('bpmn_model_js')

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="//cdn.rawgit.com/placemarker/jQuery-MD5/master/jquery.md5.js"></script>


<script src="{!! asset("vendor/jquery-ui-1.12.1/jquery-ui.min.js") !!}"></script>
<script src="{!! asset("vendor/bootstrap-4.1.3-dist/js/bootstrap.bundle.min.js") !!}"></script>
<script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
<script src="{!! asset('vendor/chart.js/Chart.min.js') !!}"></script>
<script src="{!! asset('vendor/datatables/jquery.dataTables.js') !!}"></script>
<script src="{!! asset('vendor/datatables/dataTables.bootstrap4.js') !!}"></script>
<script src="{!! asset('js/sb-admin.min.js') !!}"></script>


<script src="{!! asset('plugins/bootstrap-sweetalert/sweet-alert.min.js') !!}"></script>
<script src="{!! asset('pages/jquery.sweet-alert.init.js') !!}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/i18n/defaults-pt_BR.js"></script>
<script src="{!! asset('js/sb-admin-datatables.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>


<script>

    $(window).load(function() {
        $(".se-pre-con").fadeOut("slow");;
    });
    @Auth
    @if(count(Auth::user()->todas_solicitacoes())>0 && in_array(Auth::getUser()->papel(),['ADMINISTRADOR','PROPRIETARIO']))

    $(document).ready(function () {
        $('#modal-mensagem-solicitacao').modal('show');
    })

    @endif


    $(document).ready(function () {

        $('div.alert').delay(30000).slideUp(59);
    });
    $("div.alert-success").show(function () {
        Swal.fire({
            type: 'success',
            title: 'Operação Feita com sucesso',
            timer: 1500
        });
    });
    $("div.alert-info").show(function () {
        Swal.fire({
            type: 'success',
            title: 'Operação feita com sucesso',
            timer: 1500
        });
    });
    $("div.alert-danger").show(function () {
        Swal.fire({
            type: 'error',
            title: 'Algo deu Errado!',
            timer: 1500
        });
    });

    $("div.alert-warning").show(function () {
        Swal.fire({
            type: 'warning',
            title: 'Não foi possível efetuar esta operação!',
            timer: 1500
        });
    });

    function MessageShow(titulo, texto, urlAvatar) {
        Swal.fire({
            title: titulo,
            text: texto,
            imageUrl: urlAvatar,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
    }

    function MostrarModal(idmodal) {
        var html = $(idmodal).html();
        Swal.fire({
            html: html,
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false
        })
    }


    $('.modal-dialog').draggable({
        handle: ".modal-header"
    });

    function mudarVisibilidadeModelo(publico, codmodelo) {
        $.ajax({
            url: '/admin/controle_modelos_update/' + codmodelo,
            type: 'PUT',
            cache: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                publico: publico
            }

        });
    }

    function Mudarestado(el, el2) {
        var display = document.getElementById(el).style.display;
        if (display == "none") {
            document.getElementById(el).style.display = 'block';
            document.getElementById(el2).title = 'Esconder Descrição';
            document.getElementById(el2).innerHTML = ' <p class="fa fa-info-circle">Esconder Descrição</p>';

        } else {
            document.getElementById(el).style.display = 'none';
            document.getElementById(el2).title = 'Exibir Descrição';
            document.getElementById(el2).innerHTML = ' <p class="fa fa-info-circle">Exibir Descrição</p>';
        }

    }

    function MudarestadoModeloPublico(el, el2) {
        var display = document.getElementById(el).style.display;
        if (display == "none") {
            document.getElementById(el).style.display = 'block';
            document.getElementById(el2).title = 'Esconder Descrição';

        } else {
            document.getElementById(el).style.display = 'none';
            document.getElementById(el2).title = 'Exibir Descrição';
        }

    }

    $('#idTrocarTipoPublicoPrivadoModelo').change(function () {
        let codmodelo = $('#idCodModeloModeler').val();
        if ($(this).prop("checked") == true) {
            mudarVisibilidadeModelo(true, codmodelo);
        } else {
            mudarVisibilidadeModelo(false, codmodelo);
        }
    });


    $('input#txt_consulta').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_repositorios').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_acessos_recentes').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_solicitacoes').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_validadores').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_listagem_usuarios').quicksearch('table#tabela tbody tr');
    $('input#txt_consulta_diagrama').quicksearch('table#tabela tbody tr');

    $(function () {
        $("#limpar_cache").click(function () {
            if ($(this).hasClass('fa-refresh ')) {
                $(this).removeClass('fa-refresh ').addClass('fa-spinner fa-spin');
            } else {
                $(this).removeClass('fa-spinner fa-spin').addClass('fa-refresh ');
            }
        });

        $("#validar2020").click(function () {
            if ($(this).hasClass('fa-check ')) {
                $(this).removeClass('fa-check  ').addClass('fa-spinner fa-spin');
            } else {
                $(this).removeClass('fa-spinner fa-spin').addClass('fa-check faa-pulse  ');
            }
        });

        $("#desvalidar2020").click(function () {

            if ($(this).hasClass('fa-check-circle faa-pulse ')) {
                $(this).removeClass('fa-check-circle faa-pulse ').addClass('fa-spinner fa-spin');
            } else {
                $(this).removeClass('fa-spinner fa-spin').addClass('fa-check-circle faa-pulse ');
            }

        });


        $("#inicio2020").click(function () {

            if ($(this).hasClass('fa-home faa-pulse ')) {
                $(this).removeClass('fa-home faa-pulse ').addClass('fa-spinner fa-spin');
            } else {
                $(this).removeClass('fa-spinner faa-pulse  fa-spin').addClass('fa-check-circle faa-pulse ');
            }
        });

    });


    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }


    $("#modal-aviso4343456").modal();

    function atribuirUsuarioValidador(
        rota,
        usuarioText,
        codmodelo
    ) {
        const usuario = JSON.parse(usuarioText);
        let tipo = 'CLIENTE';
        const options = [
            'CLIENTE'
        ];
        options.push('COLABORADOR');
        options.push('PROPRIETARIO');
        options.push('VALIDADOR');
        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(usuario.email);
        let codigoMap = new Map();
        codigoMap.set('vincular_usuario_repositorio', 'codrepositorio');
        codigoMap.set('vincular_usuario_modelo', 'codmodelo');
        codigoMap.set('vincular_usuario_projeto', 'codprojeto');
        $('#imgAvatarMensagem').attr({src: urlImage});
        Swal.fire({
            title: usuario.name,
            input: 'select',
            inputOptions: options,
            inputValue: 'CLIENTE',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Vincular Usuario',
            cancelButtonText: 'Cancelar',
            imageUrl: urlImage,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true,
            preConfirm: (index) => {
                tipo = options[index];
            },


        }).then((result) => {

            console.log(codigoMap.get(rota));
            if (result.value) {
                $.ajax({
                    url: '/admin/' + rota,
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuario: usuario.codusuario,
                        tipo: tipo,
                        [codigoMap.get(rota)]: codmodelo
                    },
                    success: function (data) {
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            Swal.fire({
                                title: msg.message,
                                imageUrl: urlImage
                            })

                        }
                    }
                });
            }
        })
    }

    function atribuirUsuarioProprietarioProjeto(
        rota,
        codusuario,
        nome,
        email,
        codigo,
        idDiv
    ) {
        let tipo = 'CLIENTE';
        const options = [
            'CLIENTE'
        ];
        options.push('COLABORADOR');
        options.push('PROPRIETARIO');
        options.push('VALIDADOR');
        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(email);
        let codigoMap = new Map();
        codigoMap.set('vincular_usuario_repositorio', 'codrepositorio');
        codigoMap.set('vincular_usuario_modelo', 'codmodelo');
        codigoMap.set('vincular_usuario_projeto', 'codprojeto');
        $('#imgAvatarMensagem').attr({src: urlImage});
        Swal.fire({
            title: nome,
            input: 'select',
            inputOptions: options,
            inputValue: 'CLIENTE',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Vincular Usuario',
            cancelButtonText: 'Cancelar',
            imageUrl: urlImage,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true,
            preConfirm: (index) => {
                tipo = options[index];
            },


        }).then((result) => {
            console.log(tipo);
            console.log(codusuario);
            console.log(rota);
            console.log(codigoMap.get(rota));
            if (result.value) {
                $.ajax({
                    url: '/admin/' + rota,
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuario: codusuario,
                        tipo: tipo,
                        [codigoMap.get(rota)]: codigo
                    },
                    success: function (data) {
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            console.log(idDiv);
                            $(idDiv).remove();
                            Swal.fire({
                                title: msg.message,
                                imageUrl: urlImage
                            })

                        }
                    }
                });
            }
        })
    }

    function validarDiagrama(
        codmodelodiagramatico,
        nome,
        email,
        idDiv,
        mensagem,
        textoBotao,
        validado
    ) {
        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(email);
        $('#imgAvatarMensagem').attr({src: urlImage});
        Swal.fire({
            title: nome,
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: textoBotao,
            cancelButtonText: 'Não',
            text: mensagem,
            imageUrl: urlImage,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/admin/validar/diagrama/' + codmodelodiagramatico,
                    type: 'PUT',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        validado: validado
                    },
                    success: function (data) {
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {

                            Swal.fire({
                                title: msg.message,
                                imageUrl: urlImage
                            })
                            if (validado) {
                                $(idDiv).val('Desvalidar o Diagrama');
                            } else {
                                $(idDiv).val('Validar o Diagrama');
                            }
                            window.location.reload();
                        }
                    }
                });
            }
        })
    }
    function criarUsuario(){
        const tipo = $("#idTipoUsuario option:selected").val() ? $("#idTipoUsuario option:selected").val() : $('#idTipoUsuario').val();
        const senha = $('#idCampoSenha').val();
        const senha_confirm = $('#idCampoSenhaConfirm').val();
        const nome = $('#idCampoNome').val();
        const email = $('#idCampoEmail').val();
        Swal.fire({
            title: 'Deseja criar este usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Atualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({

                    url: '/admin/controle_usuarios_create_ajax',
                    type: "POST",
                    cache: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        name: nome,
                        tipo: tipo,
                        email:email,
                        password: senha,
                        password_confirm: senha_confirm,
                    },

                    success: function (data) {
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'success',
                            title: msg.message,
                            timer: 1500
                        });
                    },
                    error: function (data) {
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'error',
                            title: msg.message,
                            timer: 1500
                        });
                    }
                });
            }
        })
    }
    function alterarUsuario(codusuario){
        const tipo = $("#idTipoUsuario option:selected").val() ? $("#idTipoUsuario option:selected").val() : $('#idTipoUsuario').val();
        const senha = $('#idCampoSenha').val();
        const senha_confirm = $('#idCampoSenhaConfirm').val();
        const nome = $('#idCampoNome').val();
        const email = $('#idCampoEmail').val();
        Swal.fire({
            title: 'Deseja alterar a senha deste usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Atualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({

                    url: '/admin/controle_usuarios_edit_ajax/' + codusuario,
                    type: "PUT",
                    cache: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        name: nome,
                        tipo: tipo,
                        email:email,
                        password: senha,
                        password_confirm: senha_confirm,
                    },

                    success: function (data) {
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'success',
                            title: msg.message,
                            timer: 1500
                        });
                    },
                    error: function (data) {
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'error',
                            title: msg.message,
                            timer: 1500
                        });
                    }

                });
            }
        })
    }

    function atribuirUsuario(
        rota,
        codusuario,
        nome,
        email,
        codigo,
        idDiv
    ) {
        let tipo = 'CLIENTE';
        const options = [
            'CLIENTE'
        ];
        @if(Auth::getUser()->EAdministrador())
        options.push('COLABORADOR');
        options.push('PROPRIETARIO');
        @elseif(Auth::getUser()->EProprietario())
        options.push('COLABORADOR');
        options.push('VALIDADOR');
        @endif
        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(email);
        let codigoMap = new Map();
        codigoMap.set('vincular_usuario_repositorio', 'codrepositorio');
        codigoMap.set('vincular_usuario_modelo', 'codmodelo');
        codigoMap.set('vincular_usuario_projeto', 'codprojeto');
        $('#imgAvatarMensagem').attr({src: urlImage});
        Swal.fire({
            title: nome,
            input: 'select',
            inputOptions: options,
            inputValue: 'CLIENTE',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Vincular Usuario',
            cancelButtonText: 'Cancelar',
            imageUrl: urlImage,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true,
            preConfirm: (index) => {
                tipo = options[index];
            },


        }).then((result) => {
            console.log(tipo);
            console.log(codusuario);
            console.log(rota);
            console.log(codigoMap.get(rota));
            if (result.value) {
                $.ajax({
                    url: '/admin/' + rota,
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuario: codusuario,
                        tipo: tipo,
                        [codigoMap.get(rota)]: codigo
                    },
                    success: function (data) {
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            console.log(idDiv);
                            $(idDiv).remove();
                            Swal.fire({
                                title: msg.message,
                                imageUrl: urlImage
                            })

                        }
                    }
                });
            }
        })
    }

    function atualizarRepositorio() {
        const nome = $('#nomeRepositorioAtualizacao').val();
        $.ajax({
            url: '/admin/atualizar/repositorio/padrao/' + nome,
            type: 'GET',
            cache: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data) {

                const msg = data.messages[0];
                if (msg.level === 'danger') {
                    Swal.fire({
                        type: 'error',
                        title: msg.message,
                        timer: 15000,
                    });
                } else {
                    Swal.fire({
                        title: 'Repositorio atualizado com sucesso',
                    })
                    window.location = '/admin/painel';
                }
            }
        });
    }
    function acessar(codprojeto){
        window.location= '/admin/controle_modelos/index/'+codprojeto;
    }
    function criarProjeto() {
        const nome = $('#nomeProjetoCriacao').val();
        const publico = $('#publicoProjetoCriacao').is(":checked") ? true : false;
        $.ajax({
            url: '/admin/criar/projeto',
            type: 'POST',
            cache: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'nome':nome,
                'publico':publico
            },
            success: function (data) {

                const msg = data.messages ? data.messages[0] :data ;
                if (data.messages && msg.level === 'danger') {
                    Swal.fire({
                        type: 'error',
                        title: 'É necessário que esteja no repositório para criação de um processo.',
                        timer: 15000,
                    });
                } else {
                    Swal.fire({
                        title: 'Processo criado com sucesso! Deseja acessá-lo?',
                        showCancelButton: true,
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não',
                        type:'success'
                    }).then((result) => {
                        if (result.value) {
                            window.location= '/admin/controle_modelos/index/'+data.codprojeto;

                        }
                    })
                    // window.location = '/admin/todos_projetos';
                }
            }
        });
    }

    function criarRepositorio() {
        const nome = $('#nomeRepositorioCriacao').val();
        $.ajax({
            url: '/admin/criar/repositorio/padrao/' + nome,
            type: 'GET',
            cache: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data) {

                const msg = data.messages[0];
                if (msg.level === 'danger') {
                    Swal.fire({
                        type: 'error',
                        title: msg.message,
                        timer: 15000,
                    });
                } else {
                    Swal.fire({
                        title: 'Repositorio criado com sucesso',
                    })
                    window.location = '/admin/painel';
                }
            }
        });
    }

    function trocarRepositorio(codrepositorio) {
        Swal.fire({
            text: 'Deseja entrar no repositorio?',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true
        }).then((result) => {
            console.log(result);
            console.log(codrepositorio);
            if (result.value) {
                $.ajax({
                    url: '/admin/create_vinculo_repositorio/repositorio/' + codrepositorio + '/operacao/' + 1,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (data) {

                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            $('#imagemRepositorioModelagem' + codrepositorio).attr("src", '{!! asset('img/playng.png') !!}');
                            Swal.fire({
                                title: 'Solicitação feita com sucesso!',
                            })
                            window.location = '/admin/painel';
                        }
                    }
                });
            }

        });
    }

    function entrarNoRepositorioPublico(
        codrepositorio,
        rota,
        tipo
    ) {

        Swal.fire({
            text: 'Deseja Participar deste repositorio?',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true
        }).then((result) => {
            if(result.value){
                $.ajax({
                    url: rota,
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuario: '{!! Auth::getUser()->codusuario !!}',
                        codrepositorio: codrepositorio,
                        tipo: tipo
                    },
                    success: function (data) {
                        if (tipo == 'CLIENTE') {
                            location.reload();
                        }
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            $('#imagemRepositorio' + codrepositorio).attr("src", '{!! asset('img/playng.png') !!}');
                            Swal.fire({
                                title: 'Solicitação feita com sucesso!',
                            })

                        }
                    }
                });
            }

        });
    }

    function solicitarEntradaNoRepositorio(
        codrepositorio,
        rota,
        tipo
    ) {

        Swal.fire({
            input: 'textarea',
            text: 'Deseja Participar deste repositorio?',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true,
            preConfirm: (texto) => {
                $.ajax({
                    url: rota,
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuario: '{!! Auth::getUser()->codusuario !!}',
                        codrepositorio: codrepositorio,
                        tipo: tipo
                    },
                    success: function (data) {
                        if (tipo == 'CLIENTE') {
                            Location.reload();
                        }
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            $('#imagemRepositorio' + codrepositorio).attr("src", '{!! asset('img/playng.png') !!}');
                            Swal.fire({
                                title: 'Solicitação feita com sucesso!',
                            })

                        }
                    }
                });
            }
        });
    }


    function vincularUsuarioRepositorio(
        codrepositorio,
        rota,
        email,
        codusuario,
        mensagem,
        nome,
        codsolicitacao
    ) {


        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(email);
        let tipo = 'CLIENTE';
        const options = [
            'CLIENTE'
        ];
        @if(Auth::getUser()->EAdministrador())
        options.push('COLABORADOR');
        options.push('PROPRIETARIO');
        @elseif(Auth::getUser()->EProprietario())
        options.push('COLABORADOR');
        @endif


        $('#imgAvatarMensagem').attr({src: urlImage});
        Swal.fire({
            title: nome,
            text: mensagem,
            input: 'select',
            inputOptions: options,
            inputValue: 'CLIENTE',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Vincular Usuario',
            cancelButtonText: 'Cancelar',
            imageUrl: urlImage,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true,
            preConfirm: (index) => {
                tipo = options[index];
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: rota,
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuario: codusuario,
                        tipo: tipo,
                        codrepositorio: codrepositorio
                    },
                    success: function (data) {
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {

                            const id = '#solicitacao' + codsolicitacao;
                            console.log(id);
                            $(id).remove();
                            Swal.fire({
                                title: 'Usuario Vinculado com sucesso',
                                imageUrl: urlImage
                            })

                        }
                    }
                });
            } else {
                excluir(codsolicitacao, 'codsolicitacao');
            }
        })
    }

    function desvincularUsuarioValidador() {
        const usuario = $('#inputUsuarioValidador').val();
        const codmodelo = $('#inputCodModeloAssociadoValidador').val();
        console.log(codmodelo);
        atribuirUsuarioValidador('vincular_usuario_modelo', usuario, codmodelo)
    }

    function exibirFormularioMensagenValidador(
        permissao,
        dtEntrada,
        usuarioText,
        codigo
    ) {
        console.log(codigo);
        const codusuarios = [];
        const usuario = JSON.parse(usuarioText);
        codusuarios.push(usuario.codusuario);
        $('#labelNomeValidador').html(usuario.name);
        $('#labelPermissaoValidador').html(permissao === 'NENHUM' ? 'CLIENTE' : permissao);
        $('#labelEntradaValidador').html(dtEntrada);
        $('#inputCodModeloAssociadoValidador').val(codigo);
        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(usuario.email);
        $('#campoCodUsuarios').val(codusuarios);
        $('#imgAvatarMensagem').attr({src: urlImage});
        $('#inputUsuarioValidador').val(usuarioText);
        const htmlDescricao = $('#GSCCModalUsuarioValidador').html();
        Swal.fire({
            input: 'textarea',
            html: htmlDescricao,
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Enviar Mensagem',
            cancelButtonText: 'Cancelar',
            imageUrl: urlImage,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true,
            preConfirm: (texto) => {
                $.ajax({
                    url: 'controle_mensagens_store',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuarios: codusuarios,
                        texto: texto,
                        assunto: usuario.name
                    },
                    success: function (data) {
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            Swal.fire({
                                title: usuario.name + ' recebeu a mensagem!',
                                imageUrl: urlImage
                            })
                        }
                    }
                });
            }
        });
    }

    function exibirFormularioMensagen(
        codusuario,
        email,
        nome,
        permissao,
        dtEntrada
    ) {
        const codusuarios = [];
        codusuarios.push(codusuario);
        $('#labelNome').html(nome);
        $('#labelPermissao').html(permissao === 'NENHUM' ? 'CLIENTE' : permissao);
        $('#labelEntrada').html(dtEntrada);
        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(email);
        $('#campoCodUsuarios').val(codusuarios);
        $('#imgAvatarMensagem').attr({src: urlImage});
        const htmlDescricao = $('#GSCCModalUsuario').html();
        Swal.fire({
            input: 'textarea',
            html: htmlDescricao,
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Enviar Mensagem',
            cancelButtonText: 'Cancelar',
            imageUrl: urlImage,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: 'Custom image',
            showLoaderOnConfirm: true,
            preConfirm: (texto) => {
                $.ajax({
                    url: 'controle_mensagens_store',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        codusuarios: codusuarios,
                        texto: texto,
                        assunto: nome
                    },
                    success: function (data) {
                        const msg = data.messages[0];
                        if (msg.level === 'danger') {
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 15000,
                            });
                        } else {
                            Swal.fire({
                                title: nome + ' recebeu a mensagem!',
                                imageUrl: urlImage
                            })
                        }
                    }
                });
            }
        });
    }

    function transferirModelo() {
        const codModelo = $('#modalTransferenciaModeloCampoProjeto').val();
        const codprojeto = $('#selecao_transferencia_processos_modelo').children("option:selected").val();
        console.log(codmodeloDiagrama);
        console.log(codModelo);
        $.ajax({

            url: 'transferir/diagrama',
            type: "POST",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'codmodelo': codModelo,
                'codprojeto': codprojeto
            },

            success: function (data) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'success',
                    title: msg.message,
                    timer: 1500
                });
                $('#modal-form-transferencia-diagrama').modal('hide');
                Location.reload();
            },
            error: function (result) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'error',
                    title: msg.message,
                    timer: 1500
                });
            }

        });

    }

    function transferirRepositorio() {
        const codprojeto = $('#selecao_transferencia_processos').children("option:selected").val();
        const codrepositorio = $('#selecao_transferencia_repositorios').children("option:selected").val();
        console.log(codprojeto);
        console.log(codrepositorio);
        $.ajax({

            url: 'transferir/projeto',
            type: "POST",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'codprojeto': codprojeto,
                'codrepositorio': codrepositorio
            },

            success: function (data) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'success',
                    title: msg.message,
                    timer: 1500
                });
                $('#modal-form-transferencia-repositorio').modal('hide');
                location.reload();
            },
            error: function (data) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'error',
                    title: msg.message,
                    timer: 1500
                });
            }

        });

    }

    function transferirProcesso() {
        const codprojeto = $('#selecao_transferencia_processos').children("option:selected").val();
        const codrepositorio = $('#selecao_transferencia_repositorios').children("option:selected").val();
        console.log(codprojeto);
        console.log(codrepositorio);
        $.ajax({

            url: 'transferir/projeto',
            type: "POST",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'codprojeto': codprojeto,
                'codrepositorio': codrepositorio
            },

            success: function (data) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'success',
                    title: msg.message,
                    timer: 1500
                });
                $('#modal-form-transferencia-processo').modal('hide');
                location.reload();
            },
            error: function (data) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'error',
                    title: msg.message,
                    timer: 1500
                });
            }

        });

    }

    function transferirDiagrama() {
        const codmodeloDiagrama = $('#modalTransferenciaDiagramaCampo').val();
        const codModelo = $('#selecao_transferencia_modelos').children("option:selected").val();
        console.log(codmodeloDiagrama);
        console.log(codModelo);
        $.ajax({

            url: 'transferir/diagrama',
            type: "POST",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'codmodelo': codModelo,
                'codmodelodiagramatico': codmodeloDiagrama
            },

            success: function (data) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'success',
                    title: msg.message,
                    timer: 1500
                });
                $('#modal-form-transferencia-diagrama').modal('hide');
                location.reload();
            },
            error: function (data) {
                const msg = data.messages[0];
                Swal.fire({
                    type: 'error',
                    title: msg.message,
                    timer: 1500
                });
            }

        });

    }


    function desvincular_usuario_repositorio_vinculado(codusuariorepositorio) {
        Swal.fire({
            title: 'Esta certo disto?',
            text: "Apos esta operação não sera possivel revertê-la!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.value) {
                $.ajax({

                    url: 'desvincular_usuario_repositorio_vinculado/codigo/' + codusuariorepositorio,
                    type: "delete",
                    cache: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },

                    success: function (data) {
                        const id = '#usuarioRepositorio' + codusuariorepositorio;
                        console.log(id);
                        $(id).remove();
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'success',
                            title: msg.message,
                            timer: 1500
                        });
                    },
                    error: function (data) {
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'error',
                            title: msg.message,
                            timer: 1500
                        });
                    }

                });
            }
        });
    }


    function confirmMensagem(url) {
        Swal.fire({
            title: 'Esta certo disto?',
            text: "Apos esta operação não sera possivel revertê-la!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.value) {
                window.location = url;
            }
        });
    }

    function confirmMensagemPersonalizado(url, mensagem) {
        Swal.fire({
            title: mensagem,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.value) {
                window.location = url;
            }
        });
    }

    function confirmMensagemPersonalizadoRepositorio(url, mensagem) {
        Swal.fire({
            title: mensagem,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.value) {
                // window.location = url;
                var win = window.open(url, '', 'height=700,width=700');
                win.print();
            }
        });
    }


    function arquivarMensagem(
        assunto,
        codusuario,
        codmensagem,
        mensagem,
        email,
        nome) {
        const codusuarios = [];
        codusuarios.push(codusuario);
        const texto = 'Nome:' + nome + '<br> Assunto:' + assunto + '<br> Mensagem: <br>' + mensagem;
        const urlImage = 'http://www.gravatar.com/avatar/' + $.md5(email);

        Swal.fire({
            title: 'Deseja arquivar esta mensagem?',
            html: texto,
            imageUrl: urlImage,
            imageWidth: 400,
            imageHeight: 200,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                $.ajax({

                    url: 'controle_mensagens_update/' + codmensagem,
                    type: "PUT",
                    cache: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        assunto: assunto,
                        codusuarios: codusuarios
                    },

                    success: function (data) {
                        const id = '#mensagem' + codmensagem;
                        console.log(id);
                        $(id).remove();
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'success',
                            title: msg.message,
                            timer: 1500
                        });
                        location.reload();
                    },
                    error: function (data) {
                        const msg = data.messages[0];
                        Swal.fire({
                            type: 'error',
                            title: msg.message,
                            timer: 1500
                        });
                    }

                });
            }
        })
    }

    $("#my-range").on("change", function () {
        $(".djs-palette").css({"zoom": (($(this).val()) / 4)});
    });

    function excluir(codigo, tipoId) {
        try {
            const codigoRotaMap = new Map();

            codigoRotaMap.set('codrepositorio', 'controle_repositorios/' + codigo);
            codigoRotaMap.set('codmodelodiagramatico', '/admin/controle_modelos_diagramaticos/' + codigo + '/destroy');
            codigoRotaMap.set('codprojeto', 'controle_projetos/' + codigo);
            codigoRotaMap.set('codusuariomodelo', 'desvincular_usuario_modelo/codigo/' + codigo);
            codigoRotaMap.set('codhistoricodiagrama', 'controle_historico_diagramas/' + codigo);
            codigoRotaMap.set('codmensagen', 'controle_mensagens_destroy/' + codigo);
            codigoRotaMap.set('codmodelodiagramaticoComentario', 'Excluir/Comentario/Diagrama/' + codigo);
            codigoRotaMap.set('codmodelo', 'controle_modelos/' + codigo);
            codigoRotaMap.set('codusuario', 'controle_usuarios/' + codigo);
            codigoRotaMap.set('codsolicitacao', 'controle_solicitacao_usuario/codigosolicitacao/' + codigo);

            Swal.fire({
                title: 'Deseja excluir este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar?',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    console.log(tipoId);
                    console.log(codigoRotaMap.get(tipoId));
                    $.ajax({

                        url: codigoRotaMap.get(tipoId),
                        type: "DELETE",
                        cache: false,
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (data) {
                            const id = '#' + tipoId + '' + codigo;
                            console.log(id);
                            $(id).remove();
                            const msg = data.messages[0];
                            Swal.fire({
                                type: 'success',
                                title: msg.message,
                                timer: 5000
                            });
                        },
                        error: function (data) {
                            const msg = data.messages[0];
                            Swal.fire({
                                type: 'error',
                                title: msg.message,
                                timer: 5000
                            });
                        }

                    });
                }
            })
        } catch (e) {
            console.log(e);
        }

    }

    @endauth
    function dowloadSVG(svg) {

        /// Create a fake <a> element
        let fakeLink = document.createElement("a");
        /// Add image data as href
        fakeLink.setAttribute('href', 'data:image/svg+xml;base64,' + window.btoa(svg));
        /// Add download attribute
        fakeLink.setAttribute('download', 'imageName.svg');
        /// Simulate click
        fakeLink.click();
    }


    function dowloadSVGModeloPublico(codmodelodiagramatico, nomeSVG) {
        $.ajax({

            url: '/publico/modelos/baixar/' + codmodelodiagramatico,
            type: "GET",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data) {

                /// Create a fake <a> element
                let fakeLink = document.createElement("a");
                var encodedData = encodeURIComponent(data);
                /// Add image data as href
                fakeLink.setAttribute('href', 'data:application/bpmn20-xml;charset=UTF-8,' + encodedData);
                /// Add download attribute
                fakeLink.setAttribute('download', nomeSVG);
                /// Simulate click
                fakeLink.click();
            }
        });

    };

    function donwload(name, codmodelodiagramatico, tipo) {
        $.ajax({

            url: "baixar/" + codmodelodiagramatico + "/" + tipo,
            type: "GET",
            dataType: "text",
            success: function (resposta) {
                var link = document.createElement('a');
                link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(resposta));
                link.setAttribute('download', name);
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function (request, status, error) {

            }

        });
    };
    function openDiagramVersionavel(codmodeloversionavel) {
        var viewer = new BpmnJS({
            container: '#canvas',
        });
        $.ajax({
            url: "baixar/" + codmodeloversionavel + "/versionavel",
            type: "GET",
            dataType: "text",
            success: function (xml) {
                viewer.importXML(xml, function (err) {
                    if (err) {
                        return console.error('could not import BPMN 2.0 diagram', err);
                    }
                    viewer.get('canvas').zoom('fit-viewport');
                });
            },
            error: function (request, status, error) {
            }
        });

    };

    function openDiagram(codmodelo) {
        var viewer = new BpmnJS({
            container: '#canvas',
        });
        $.ajax({
            url: "baixar/" + codmodelo + "/normal",
            type: "GET",
            dataType: "text",
            success: function (xml) {
                viewer.importXML(xml, function (err) {
                    if (err) {
                        return console.error('could not import BPMN 2.0 diagram', err);
                    }
                    viewer.get('canvas').zoom('fit-viewport');
                });
            },
            error: function (request, status, error) {
            }
        });

    };

    function donwloadXML(name, codmodelodiagramatico) {
        return $.ajax({
            url: "baixar/" + codmodelodiagramatico,
            type: "GET",
            dataType: "text",
            success: function (resposta) {
                return resposta;
            },
            error: function (request, status, error) {

            }
        });
    };

    $('#iconePlusMostrar').click(function () {

        $('#download-diagram').show();
        $('#download-svg').show();
        $('#btnSalvarDiagramaEntry').show();
        $('#zoom-paleta-diagrama').show();
        $('#idDivTrocarTipoPublicoPrivadoModelo').show();
        $('#iconePlusMostrar').hide();
        $('#iconePlusEsconder').show();

    });

    $('#iconePlusEsconder').click(function () {
        $('#download-diagram').hide();
        $('#download-svg').hide();
        $('#btnSalvarDiagramaEntry').hide();
        $('#zoom-paleta-diagrama').hide();
        $('#idDivTrocarTipoPublicoPrivadoModelo').hide();
        $('#iconePlusMostrar').show();
        $('#iconePlusEsconder').hide();
    });


</script>
