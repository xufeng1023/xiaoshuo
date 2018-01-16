@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<div class="card p-3">
                @if(count($contents))
            		<ul class="list-group list-group-flush mb-4">
            			@foreach($contents as $content)
    					    <li class="list-group-item">			  
    				        	<a href="/post/{{ $content->post->title }}?page={{ $content->id }}">
                                    <h6 class="h4">{{ $content->post->title }}</h6>
                                </a>
    				        	<p>{!! $content->searchedText(request()->q) !!}...</p>
    			        	</li>
    		        	@endforeach
    	        	</ul>
    	        	{!! $contents->appends(['q' => request()->q])->links('vendor.pagination.bootstrap-4') !!}
                @else
                    <p>
                        @lang('index.no results', ['keyword' => request('q')])
                    </p>
                    <a href="/">@lang('index.back to homepage')</a>
                @endif
        	</div>
        </div>
    </div>
</div>
@endsection
