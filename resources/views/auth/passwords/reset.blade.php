@extends('layouts.home.main')

@section('content')
    <section id="signup" class="signup-section">
        <div class="container">
            <div class="card text-center">
                <div class="card-header dark-text-white">{{ trans('auth.Reset_Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.request') }}" role="form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label>Email</label>
                        </div>
                        <div class="form-group">
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ $email ?? old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                        </div>
                        <div class="form-group">

                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirmar Senha</label>
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark form-control">
                                Resetar Senha
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('nav')
    @includeIf('layouts.home.nav',['pagina' => 'auth.passwords.reset'])
@endsection
