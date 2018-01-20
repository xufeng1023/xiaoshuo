<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    @yield('title')
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110529389-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-110529389-1');
    </script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <header class="container">
        <nav class="navbar navbar-light navbar-expand justify-content-between px-0">
            <a class="navbar-brand p-0" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="45">
            </a>

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
            <!-- <div class="jumbotron"></div> -->
        @endif
        <hr class="mt-0">
        <form class="mb-3 d-flex justify-content-center" action="/search" method="get">
            <div class="input-group">
                <select class="form-control" name="search_category">
                    <option {{ (request("search_category") == 'title')? 'selected="selected"' : '' }} value="title">@lang('index.search title')</option>
                    <option {{ (request("search_category") == 'content')? 'selected="selected"' : '' }} value="content">@lang('index.search content')</option>
                    <option {{ (request("search_category") == 'author')? 'selected="selected"' : '' }} value="author">@lang('index.search author')</option>
                </select>

                <input name="q" class="form-control" type="search" placeholder="{{ __('index.search keywords') }}" aria-label="Search" value="{{ request('q') ?: '' }}" required>
                
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit">@lang('index.search')</button>
                </div>
            </div>
        </form>
    </header>
    
    <main class="container">
        @yield('content')
    </main>
    
    <footer class="container py-3">
        <div class="row">
            <div class="col">
                <div class="small">
                    <div class="text-muted">@lang('index.repost statement')</div>
                    <div class="text-muted">&copy @lang('index.app name') {{ date('Y') }}</div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
