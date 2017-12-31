@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6">
        	<div class="row">
	            @foreach($posts as $post)
		            <div class="col-6">
		                <h4>{{ $post->title }}</h4>
		                <p>{{ str_limit($post->content, 100) }}</p>
		                <a href="/post/{{ $post->title }}">Read more...</a>
	                </div>
	            @endforeach
            </div>
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@endsection
