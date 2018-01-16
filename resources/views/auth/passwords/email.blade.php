@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">@lang('index.email')</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">@lang('index.send reset password link')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
