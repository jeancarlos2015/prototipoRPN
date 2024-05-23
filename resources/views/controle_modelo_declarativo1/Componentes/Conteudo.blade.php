<div class="top-content" style="margin-top: 5%">
    <div class="container">

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text">
                <h1>RPN - Tarefas do Modelo {!! $representacao_declarativa->modelo->nome !!}</h1>
                <div class="description">
                    <p>
                        Este de Projeto de caráter acadêmico
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                @includeIf('controle_modelo_declarativo1.layouts.componentes.form',
                [
                'representacao_declarativa' => $representacao_declarativa
                ])
            </div>
        </div>

    </div>
</div>
