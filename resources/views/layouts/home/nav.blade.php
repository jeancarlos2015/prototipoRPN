<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">

    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{ route('/') }}">{!! trans('messages.nome') !!}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @Auth
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger"
                           href="{{ route('painel') }}">{!! trans('messages.Dashboard') !!}</a>
                    </li>
                @EndAuth


                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{ route('documentos_publicos') }}">{!! trans('messages.Documents') !!}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{ route('modelos_publicos') }}"> {!! trans('messages.Models') !!}</a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link js-scroll-trigger" href="{{ route('/') }}">{!! trans('messages.Dashboard') !!}</a>--}}
{{--                </li>--}}

                @guest
                    {{--<li class="nav-item">--}}
                    {{--<a class="nav-link js-scroll-trigger"--}}
                    {{--href="https://docs.google.com/forms/d/e/1FAIpQLSejrrMWM8xYOv2PFMGE3n2LX_b9GjK9hdAYiF4-1SYg2BsRzw/viewform">Form</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger"
                           href="{{ route('login') }}">{{ trans('messages.Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger"
                           href="{{ route('register') }}">{{ trans('messages.Register') }}</a>
                    </li>

                @endguest
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{ route('traduzir',['pt-BR',$pagina]) }}"><img
                            src="{!! asset('img/brasil.png') !!} " style="width: 20px"
                            title="Portugues BR">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{ route('traduzir',['en',$pagina]) }}"><img
                            src="{!! asset('img/eua.png') !!} " style="width: 20px"
                            title="Inglês US">
                    </a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link js-scroll-trigger"--}}
{{--                       href="{{ route('traduzir',['fr']) }}"><img--}}
{{--                            src="{!! asset('img/fr.png') !!} " style="width: 20px"--}}
{{--                            title="Inglês US">--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
