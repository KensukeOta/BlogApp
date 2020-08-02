@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-content">
                <form method="POST" action="">
                    @csrf
                    <img src="img/avatar.svg">
                    <h2 class="title">Welcome</h2>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Username</h5>
                            <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

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
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ $email }}" disabled placeholder="Email Adress">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" class="submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
