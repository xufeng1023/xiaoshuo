@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<div class="card border-light">
	        	<h1 class="h3 font-weight-bold">{{ $post->title }}</h1>
	        	<p>{!! nl2br($contents->first()->content) !!}</p>
	        	{!! $contents->links('vendor.pagination.bootstrap-4') !!}
        	</div>
        </div>
    </div>
</div>
@endsection
