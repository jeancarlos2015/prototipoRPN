{{--<div class="col-xl-3 col-sm-6 mb-3">--}}
{{--<div class="card text-white bg-dark o-hidden h-100">--}}
{{--@if($tipo==='modelos')--}}
{{--<div class="card-body">--}}
{{--<div class="card-body-icon">--}}
{{--<i class="fa fa-fw fa-list"></i>--}}
{{--</div>--}}
{{--@if(!empty($funcionalidades))--}}
{{--<div class="mr-5">{!! $funcionalidades[$indice]->titulo !!}</div>--}}
{{--@else--}}
{{--<div class="mr-5">{!! $titulos[$index] !!}</div>--}}
{{--<div class="mr-5">Quantidade: {!! $quantidades[$index] !!}</div>--}}
{{--@endif--}}
{{--</div>--}}
{{--@if(!empty($funcionalidades))--}}
{{--@if(!empty($tipo_modelo))--}}
{{--<a class="card-footer text-white clearfix small z-1"--}}
{{--href="{!! route($funcionalidades[$indice]->rota,[$modelo->codmodelo]) !!}">--}}
{{--<span class="float-left">Visualizar</span>--}}
{{--<span class="float-right">--}}
{{--<i class="fa fa-angle-right"></i>--}}
{{--</span>--}}
{{--</a>--}}
{{--@else--}}
{{--<a class="card-footer text-white clearfix small z-1"--}}
{{--href="{!! route($funcionalidades[$indice]->rota,[$modelodeclarativo->codmodelodeclarativo]) !!}">--}}
{{--<span class="float-left">Visualizar</span>--}}
{{--<span class="float-right">--}}
{{--<i class="fa fa-angle-right"></i>--}}
{{--</span>--}}
{{--</a>--}}
{{--@endif--}}
{{--@else--}}
{{--@if(!empty($funcionalidades))--}}
{{--<a class="card-footer text-white clearfix small z-1"--}}
{{--href="{!! route($funcionalidades[$indice]->rota,[$modelo->codmodelo]) !!}">--}}
{{--<span class="float-left">Visualizar</span>--}}
{{--<span class="float-right">--}}
{{--<i class="fa fa-angle-right"></i>--}}
{{--</span>--}}
{{--</a>--}}
{{--@elseif(!empty($modelodeclarativo))--}}
{{--<a class="card-footer text-white clearfix small z-1"--}}
{{--href="{!! route($rotas[$index],[$modelodeclarativo->codmodelodeclarativo]) !!}">--}}
{{--<span class="float-left">Visualizar</span>--}}
{{--<span class="float-right">--}}
{{--<i class="fa fa-angle-right"></i>--}}
{{--</span>--}}
{{--</a>--}}
{{--@endif--}}
{{--@endif--}}
{{--@else--}}
{{--<div class="card-body">--}}
{{--<div class="card-body-icon">--}}
{{--<i class="fa fa-fw fa-list"></i>--}}
{{--</div>--}}
{{--@if(!empty($funcionalidades))--}}
{{--<div class="mr-5">{!! $funcionalidades[$indice]->titulo !!}</div>--}}
{{--@else--}}
{{--<div class="mr-5">{!! $titulos[$index] !!}</div>--}}
{{--<div class="mr-5">Quantidade: {!! $quantidades[$index] !!}</div>--}}
{{--@endif--}}
{{--</div>--}}
{{--@if(!empty($tipo_modelo))--}}
{{--<a class="card-footer text-white clearfix small z-1"--}}
{{--href="{!! route($rotas[$index],[$modelo->codmodelo]) !!}">--}}
{{--<span class="float-left">Visualizar</span>--}}
{{--<span class="float-right">--}}
{{--<i class="fa fa-angle-right"></i>--}}
{{--</span>--}}
{{--</a>--}}
{{--@else--}}
{{--<a class="card-footer text-white clearfix small z-1" href="{!! route($rotas[$index]) !!}">--}}
{{--<span class="float-left">Visualizar</span>--}}
{{--<span class="float-right">--}}
{{--<i class="fa fa-angle-right"></i>--}}
{{--</span>--}}
{{--</a>--}}
{{--@endif--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-dark o-hidden h-100">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
            </div>

            <div class="mr-5">{!! $titulo !!}</div>

        </div>
        <a class="card-footer text-white clearfix small z-1"
           href="#">
            <span class="float-left">Visualizar</span>
            <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
        </a>
    </div>
</div>