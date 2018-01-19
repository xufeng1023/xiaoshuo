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
					    <li class="list-group-item">			  
				        	<a href="/post/{{ $content->post->title }}?page={{ $content->id }}">
                                <h5 class="card-title">{{ $content->post->title }}</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ __('index.author', ['author' => $content->post->author]) }}
                                {{ __('index.upload date', ['date' => $content->post->uploadDate]) }}
                            </h6>
				        	<p class="card-text">{!! $content->searchedText(request()->q) !!}...</p>
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
@endsection
