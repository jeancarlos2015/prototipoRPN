@extends('layouts.home.main')

@section('content')
    <section id="signup" class="signup-section">
        <div class="container">
            <div class="card text-center">
                <div class="card-header dark-text-white">{{ trans('auth.Reset_Password') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" role="form">
                        @csrf

                        <div class="form-group">

                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">
                                {{ trans('auth.Send_Password_Reset_Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('nav')
    @includeIf('layouts.home.nav',['pagina' => 'auth.passwords.email'])
@endsection

