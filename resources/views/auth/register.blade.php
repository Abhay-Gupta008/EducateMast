@extends('layouts.app')
@section('content')
    <div class="login-dark" style="background: #475d62 url({{ asset('img/star-sky.jpg') }});">
        <form method="post" action="{{ route('register') }}">
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
                <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail Address">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Password" autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password-confirm" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required placeholder="Confirm Password" autocomplete="new-password">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Register</button></div><a class="forgot" href="#">Forgot your email or password?</a></form>
    </div>
@endsection
