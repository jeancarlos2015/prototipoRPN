<script>

</script>
@if(!empty($logs))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false">
            <i class="fa fa-fw fa-bell faa-pulse "></i>

            <span class="d-lg-none">Alertas
              <span class="badge badge-pill badge-warning">{!! count($logs) !!}</span>
            </span>
            @if(count($logs)>0)
                <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle faa-pulse "></i>
            </span>
            @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            @if(count($logs)>0)
                <h6 class="dropdown-header">Novas Alertas</h6>
            @else
                <h6 class="dropdown-header">Sem Alertas</h6>
            @endif
            @foreach($logs as $log)
                @if(!$log->visto)
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{!! route('controle_logs.index',[$log->codlog]) !!}">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw faa-pulse "></i>{!! $log->descricao!!}</strong>
              </span>
                        <span class="small float-right text-muted">{!! $log->created_at !!}</span>
                        <div class="dropdown-message small"> A operação foi feita na página {!! $log->pagina !!} através
                            do
                            método {!! $log->acao !!}
                        </div>
                    </a>
                @endif
                {!! $log->viu() !!}
            @endforeach
        </div>
    </li>

@endif
