<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-dark o-hidden h-100">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fa fa-fw fa-list faa-pulse "></i>
            </div>

            <div class="mr-5">{!! $titulo !!}</div>

        </div>
        <a class="card-footer text-white clearfix small z-1"
           href="{!! route($rota,[$id]) !!}">
            <span class="float-left">Visualizar</span>
            <span class="float-right">
                <i class="fa fa-angle-right faa-pulse "></i>
              </span>
        </a>
    </div>
</div>