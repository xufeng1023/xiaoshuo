@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card p-3">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">@lang('index.email')</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">@lang('index.password')</label>

                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>

                    <input type="checkbox" name="remember" checked="checked" hidden>

                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('index.login')</button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">@lang('index.forgot password')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
