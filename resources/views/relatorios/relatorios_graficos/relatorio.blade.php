@extends('layouts.admin.layouts.layout_principal.main')

@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Relatório de Modelos Criados por Repositório</h4>
            <div id="bar-chart" style="width:100%; height:400px;"></div>
        </div>
    </div>

@endsection
@section('codigo_css')
    <link href="{!! asset('plugins/morrisjs/morris.css') !!}" rel="stylesheet">
@endsection
@section('codigo_js')
    <script src="{!! asset('plugins/sparkline/jquery.sparkline.min.js') !!}"></script>
    <!-- Chart JS -->
    <script src="{!! asset('plugins/echarts/echarts-all.js') !!}"></script>
    {{--<script src="{!! asset('plugins/echarts/echarts-init.js') !!}"></script>--}}
    <script>
        // ==============================================================
        // Bar chart option
        // ==============================================================
        var myChart = echarts.init(document.getElementById('bar-chart'));

        // specify chart configuration item and data
        option = {
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: [@foreach($repositorios as $repositorio) '{!! $repositorio->nome !!} - Modelos de Processos de Negócio', @endforeach]
            },
            toolbox: {
                show: true,
                feature: {

                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            color: [@for($indice=0;$indice<count($cores);$indice++) "{!! $cores[$indice] !!}",  @endfor],
            calculable: true,
            xAxis: [
                {
                    type: 'category',
                    data: [@foreach($meses as $mes) '{!! to_description_date($mes) !!}', @endforeach]
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                    @foreach($repositorios as $repositorio)

                {
                    name: '{!! $repositorio->nome !!} - Modelos de Processos de Negócio',
                    type: 'bar',
                    data: [
                        @foreach($meses as $mes) '{!! $repositorio->qt_modelos_mes($mes) !!}', @endforeach
                    ],
                    markPoint: {
                        data: [
                            {type: 'max', name: 'Máximo'},
                            // {type: 'min', name: 'Mínimo'}
                        ]
                    },
                    // markLine: {
                    //     data: [
                    //         {type: 'average', name: 'Média'}
                    //     ]
                    // }
                },
                    @endforeach
            ]
        };


        // use configuration item and data specified to show chart
        myChart.setOption(option, true), $(function () {
            function resize() {
                setTimeout(function () {
                    myChart.resize()
                }, 100)
            }

            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });

    </script>
    <script src="{!! asset('plugins/styleswitcher/jQuery.style.switcher.js') !!}"></script>
@endsection