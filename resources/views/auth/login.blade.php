@extends('layouts.app')
@section('content')
    <div class="login-dark" style="background: #475d62 url({{ asset('img/star-sky.jpg') }});">
        <form method="post" action="{{ route('login') }}">
            @csrf
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group">
                <input id="username" class="form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a></form>
    </div>
@endsection
