@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<table class="table table-striped">

	            @foreach($posts as $post)
		            <tr>
		            	<td>
		                	<a href="/post/{{ $post->title }}">{{ $post->title }}</a>
		                </td>
	                </tr>
	            @endforeach
	            
        	</table>
        	{!! $posts->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection
