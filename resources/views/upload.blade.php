@extends('layouts.app')

@section('meta')
<meta name="robots" content="noindex" />
@endsection

@section('title')
<title>{{ __('index.upload') }}-{{ __('index.app name') }}</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="/upload" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control">
                </div>
                <div class="form-group">
                    <label>File</label>
                    <input type="file" name="content" class="form-control-file">
                    @if(session()->has('file'))
                        <div class="text-danger">{{ session('file') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
