@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-content">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h2 class="title">Password Reset</h2>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="div">
                            <h5>Email Address</h5>
                            <input type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <input type="submit" class="submit" value="Send Password Reset Link">
                    </div>
                </form>

            </div>
            </div>
        </div>
    </div>
</div>
@endsection
