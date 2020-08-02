@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <img src="img/avatar.svg">
                    <h2 class="title">Welcome</h2>

                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Username</h5>
                            <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>             

                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="div">
                            <h5>Email Adress</h5>
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password Confirm</h5>
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" class="submit" value="Register">
                    </div>
                </form>
            </div>
            <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger mx-auto google">
                <i class="fab fa-google mr-1"></i>Googleで登録
            </a>
        </div>
    </div>
</div>
@endsection
