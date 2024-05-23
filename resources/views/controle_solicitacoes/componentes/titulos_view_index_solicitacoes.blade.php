<div class="card text-white o-hidden h-100" style="background-color: #1e4c4a">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5 text-center">PROJETO {!! strtoupper($projeto->nome) !!}</div>
        <div class="mr-5 text-center">{!! $projeto->qt_modelos()!!} MODELOS</div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! URL::previous()!!}">
               <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>

</div>