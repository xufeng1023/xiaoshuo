@extends('layouts.app')

@section('title')
<title>{{ __('index.posts') }}-{{ __('index.app name') }}</title>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    	<table class="table table-striped table-bordered">

            @foreach($posts as $p)
	            <tr>
	            	<td>
	                	<a href="/post/{{ $p->title }}">{{ $p->title }}</a>
	                </td>
                </tr>
            @endforeach
            
    	</table>
    	{!! $posts->links('vendor.pagination.bootstrap-4') !!}
    </div>
</div>
@endsection
