@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<div class="card border-light">
	        	<h1 class="h3 font-weight-bold">{{ $post->title }}</h1>
	        	<div>
	        		@auth
		        		<form action="/bookmark" method="post">
		        			{{ csrf_field() }}
		        			<input type="hidden" name="post_id" value="{{ $post->id }}">
		        			<input type="hidden" name="content_id" value="{{ $contents->first()->id }}">
		        			<button type="submit" class="btn btn-outline-secondary btn-sm">bookmark</button>
		        		</form>
	        		@endauth
	        		<form>
	        			<button type="button" class="btn btn-outline-secondary btn-sm">bookmark</button>
	        		</form>
	        		
	        		<button type="button" class="btn btn-outline-secondary btn-sm">favorite</button>
	        	</div>
	        	@if(session()->has('success'))
	        		<div class="modal fade" id="ss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  		<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				    		<div class="modal-content border-0">
				      			<div class="modal-body bg-info text-center text-white">{{ session('success') }}</div>
				    		</div>
				  		</div>
					</div>
	        	@endif
	        	<p>{!! nl2br($contents->first()->content) !!}</p>
	        	{!! $contents->links('vendor.pagination.simple-bootstrap-4') !!}
        	</div>
        </div>
    </div>
</div>
@endsection
