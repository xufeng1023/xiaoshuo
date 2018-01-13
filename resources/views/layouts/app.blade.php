<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($post)? $post->title.'-' : '' }}{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-light navbar-expand justify-content-between">
            <a class="navbar-brand" href="/">Navbar</a>

            <ul class="navbar-nav">
                @admin
                    <li class="nav-item">
                        <a class="nav-link" href="/upload">Upload</a>
                    </li>
                @endadmin

                @auth    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endauth
                
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                @endguest
            </ul>
        </nav>
        @if(url()->current() !== url('upload'))
            <div class="jumbotron">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            </div>
        @endif
        <form class="form-inline mb-4 d-flex justify-content-center" action="/search" method="get">
            <div class="input-group">
                <input name="q" class="form-control" type="search" placeholder="Search" aria-label="Search" value="{{ request('q') ?: '' }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
    
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
