@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<div class="card border-light">
        		<ul class="list-group list-group-flush mb-4">
        			@foreach($contents as $content)
					    <li class="list-group-item">			  
				        	<h1 class="h3 font-weight-bold">{{ $content->post->title }}</h1>
				        	<p>{!! $content->searchedText(request()->q) !!}</p>
			        	</li>
		        	@endforeach
	        	</ul>
	        	{!! $contents->appends(['q' => request()->q])->links('vendor.pagination.bootstrap-4') !!}
        	</div>
        </div>
    </div>
</div>
@endsection
