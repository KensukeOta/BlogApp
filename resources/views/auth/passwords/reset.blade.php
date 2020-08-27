@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-content">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <h2 class="title">新しいパスワードを設定</h2>
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>新しいパスワード</h5>
                            <input type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
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
                            <h5>新しいパスワード(再入力)</h5>
                            <input type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" class="submit" value="送信">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
