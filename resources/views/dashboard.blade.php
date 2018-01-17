@extends('layouts.app')

@section('meta')
<meta name="robots" content="noindex" />
@endsection

@section('title')
<title>{{ __('index.my bookmarks') }}-{{ __('index.app name') }}</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<div class="card">
	        	<div class="card-header">
                    <h1 class="h4 m-0">@lang('index.my bookmarks')</h1>
                </div>

	        	<div class="card-body">
                    @if($bookmarks->count())
                        <table class="table table-striped m-0">
                            <tbody>
            	        		@foreach($bookmarks as $bm)
                                    <tr>
                                        <td>
                                            <a href="/post/{{ $bm->post->title }}?page={{ $bm->content->id }}">{{ $bm->post->title }}</a>
                                        </td>
                                        <td>
                                            <a href="/post/{{ $bm->post->title }}?page={{ $bm->content->id }}">@lang('index.bookmark page', ['page' => $bm->content->id])</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        @lang('index.no bookmarks')
                    @endif
	        	</div>
        	</div>
        </div>
    </div>
</div>
@endsection
