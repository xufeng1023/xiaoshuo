<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-light navbar-expand justify-content-between">
            <a class="navbar-brand" href="/">@lang('index.app name')</a>

            <ul class="navbar-nav">
                @admin
                    <li class="nav-item">
                        <a class="nav-link" href="/upload">@lang('index.upload')</a>
                    </li>
                @endadmin

                @auth    
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">@lang('index.my bookmarks')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            @lang('index.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endauth
                
                @guest
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link" href="/login">@lang('index.login')</a>
                        <a class="nav-link">&#124</a>
                        <a class="nav-link" href="/register">@lang('index.register')</a>
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
                <input name="q" class="form-control" type="search" placeholder="{{ __('index.search content') }}" aria-label="Search" value="{{ request('q') ?: '' }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit">@lang('index.search')</button>
                </div>
            </div>
        </form>
    </div>
    
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
