@extends('layouts.home.main')

@section('content')
    <section id="signup" class="signup-section">
        <div class="container">
            <div class="card text-center ">
                <div class="card-header dark-text-white">{!! trans('auth.Title') !!}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   value="{{ old('name') }}" placeholder="{!! trans('auth.Name') !!}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" placeholder="Email" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" placeholder="{!! trans('auth.Password') !!}" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">

                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" placeholder="{!! trans('auth.Confirm_Password') !!}" required>
                        </div>
                        <input id="type" type="hidden" name="type" value="padrao">

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">
                                {{ trans('auth.Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('nav')
    @includeIf('layouts.home.nav',['pagina' => 'auth.register'])
@endsection
