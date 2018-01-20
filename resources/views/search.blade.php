@extends('layouts.app')

@section('title')
<title>{{ request('q') }}-{{ __('index.app name') }}</title>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    	<div class="card p-3">
            @if(count($contents))
        		<ul class="list-group list-group-flush mb-3">
        			@foreach($contents as $content)
                        @if($content instanceof App\Content)
    					    <li class="list-group-item">			  
    				        	<a href="/post/{{ $content->post->title }}?page={{ $content->page }}">
                                    <h5 class="card-title">{{ $content->post->title }}</h5>
                                </a>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ __('index.the author', ['author' => $content->post->author]) }}
                                    {{ __('index.upload date', ['date' => $content->post->uploadDate]) }}
                                </h6>
    				        	<p class="card-text">{!! $content->searchedText(request()->q) !!}...</p>
    			        	</li>
                        @endif

                        @if($content instanceof App\Post)
                            <li class="list-group-item">              
                                <a href="/post/{{ $content->title }}">
                                    <h5 class="card-title">{{ $content->title }}</h5>
                                </a>
                                <h6 class="card-subtitle mb-2 text-muted m-0">
                                    {{ __('index.the author', ['author' => $content->author]) }}
                                    {{ __('index.upload date', ['date' => $content->uploadDate]) }}
                                </h6>
                            </li>
                        @endif
		        	@endforeach
	        	</ul>
	        	{!! $contents->appends(['q' => request('q'), 'search_category' => request('search_category')])->links('vendor.pagination.bootstrap-4') !!}
            @else
                <p>
                    @lang('index.no results', ['keyword' => request('q'), 'category' => trans('index.'.request('search_category'))])
                </p>
                <a href="/">@lang('index.back to homepage')</a>
            @endif
    	</div>
    </div>
</div>
@endsection
