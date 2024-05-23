<div class="card text-white o-hidden h-100" style="background-color: #5f3f3f">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        @if(!empty($repositorios))
            <div class="mr-5">{!! count($repositorios)!!} REPOSITÓRIOS</div>
        @else
            <div class="mr-5">0 REPOSITÓRIOS</div>
        @endif
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! route('painel') !!}">
            <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>
</div>