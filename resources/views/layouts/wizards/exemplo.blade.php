
@extends('layouts.wizards.material-bootstrap-wizard.main')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="red" id="wizard">
                    <form action="" method="">
                        <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                MODELO
                            </h3>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#details" data-toggle="tab">Criação do Modelo</a></li>
                                <li><a href="#captain" data-toggle="tab">Instanciação</a></li>
                                <li><a href="#description" data-toggle="tab">Execução</a></li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="details">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Vamos começar com a criação do modelo.</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <button class="btn btn-success form-control">Criar Diagrama BPMN
                                                </button>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <button class="btn btn-danger form-control">Criar Representação
                                                    declarativa
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="captain">
                                <h4 class="info-text">Instanciação do modelo </h4>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="col-sm-4">
                                            Instanciação do modelo
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="description">
                                <div class="row">
                                    <h4 class="info-text"> Por favor crie o checklist</h4>
                                    <div class="col-sm-6 col-sm-offset-1">
                                        <div class="form-group">
                                            <button class="btn btn-danger form-control">Criar Checklist</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next'
                                       value='Next'/>
                                <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish'
                                       value='Finish'/>
                            </div>
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd'
                                       name='previous' value='Previous'/>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div> <!-- row -->

@endsection