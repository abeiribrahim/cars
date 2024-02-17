@extends('layouts.app2')

@section('content')
    @guest
        @if (Route::has('login'))
            <form method="POST" action="{{route('login') }}">
                @csrf
                
                <h1>Login Form</h1>
                <div class="form-group">
                    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" placeholder="Username" required autocomplete="user_name" >
                    @error('user_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default submit">Log in</button>
                    @if (Route::has('password.request'))
                        <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
                    @endif
                </div>
            </form>
        @endif
        
        <div class="separator">
            <p class="change_link">New to the site?
                <a href="{{ route('register') }}" class="to_register">Create Account</a>
            </p>
        </div>
    @endguest
@endsection
