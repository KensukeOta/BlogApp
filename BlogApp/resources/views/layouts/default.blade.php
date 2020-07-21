<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body style="background: #f6f6f4;">
    <header class="navbar bg-success">
        <nav class="container">
            <a href="/" class="text-light text-decoration-none">BlogApp</a>
            <a href="/search" class="text-light">記事検索</a>
            @if (Auth::check())
            <div class="dropdown">
                @if (url('/home'))
                <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                    {{ $loginUser->name }}
                </a>
                @else
                <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                    {{ $user->name }}
                </a>
                @endif
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @if (url('/home'))
                    <li><a class="dropdown-item" href="/user/{{ $loginUser->name }}">マイページ</a></li>
                    @else
                    <li><a class="dropdown-item" href="/user/{{ $user->name }}">マイページ</a></li>
                    @endif
                    <li><a class="dropdown-item" href="/logout" >ログアウト</a></li>
                </ul>
            </div>
            @else
            <a href="/login" class="text-light text-decoration-none">ログイン</a>
            @endif
        </nav>
    </header>
    <div class="container" style="padding: 32px; background: #fff;">
        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>