@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ログイン') }}</div>

                <div class="card-body">
                    <div class="login-content">
			            <form action="{{ route('login') }}" method="POST">
                            @csrf
				            <img src="img/avatar.svg">
                            <h2 class="title">Welcome</h2>
                            
           		            <div class="row input-div one">
           		                <div class="i">
           		   		            <i class="fas fa-user"></i>
           		                </div>
           		                <div class="div">
                                    <h5>Username</h5>
                                    <input type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
           		                </div>
                            </div>
                               
           		            <div class="row input-div pass">
           		                <div class="i"> 
           		    	            <i class="fas fa-lock"></i>
           		                </div>
           		                <div class="div">
                                    <h5>Password</h5>
           		    	            <input type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row my-3">
                                <div class="offset-md-4 mx-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                        <label class="form-check-label" for="remember">
                                            {{ __('ログイン情報を保存する') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">パスワードを忘れましたか?</a>
                                @endif
                                <input type="submit" class="submit" value="Login">
                            </div>

                        </form>
                    </div>                                
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/main.js"></script>
@endsection
