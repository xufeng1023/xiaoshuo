@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<div class="card border-light">
                @if(count($contents))
            		<ul class="list-group list-group-flush mb-4">
            			@foreach($contents as $content)
    					    <li class="list-group-item">			  
    				        	<a href="/post/{{ $content->post->title }}">
                                    <h6 class="h4">{{ $content->post->title }}</h6>
                                </a>
    				        	<p>{!! $content->searchedText(request()->q) !!}...</p>
    			        	</li>
    		        	@endforeach
    	        	</ul>
    	        	{!! $contents->appends(['q' => request()->q])->links('vendor.pagination.bootstrap-4') !!}
                @else
                    没有找到任何包含“{{ request()->q }}”的小说
                @endif
        	</div>
        </div>
    </div>
</div>
@endsection
