@extends('layouts.app')

@section('title')
<title>{{ $post->title }}-{{ __('index.app name') }}</title>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    	<div class="card">
    		<div class="card-header d-flex justify-content-between">
                <h1 class="h4 m-0">{{ $post->title }}</h1>
                @if($contents->count())
                    <div>
		        		@auth
			        		<form action="/bookmark" method="post">
			        			{{ csrf_field() }}
			        			<input type="hidden" name="post_id" value="{{ $post->id }}">
			        			<input type="hidden" name="content_id" value="{{ $contents->first()->page }}">
			        			<button type="submit" class="btn btn-outline-secondary btn-sm">@lang('index.bookmark')</button>
			        		</form>
		        		@else
			        		<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".loginToBookmarkModal">@lang('index.bookmark')</button>
			        		<div class="modal fade loginToBookmarkModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						  		<div class="modal-dialog modal-sm">
						    		<div class="modal-content">
						    			<div class="modal-body">
							    			<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
										  		<li class="nav-item">
										    		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">@lang('index.login')</a>
										  		</li>
										  		<li class="nav-item">
										    		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">@lang('index.register')</a>
										  		</li>
											</ul>
											<div class="tab-content" id="myTabContent">
										  		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										  			<form action="/loginBookmark" method="post">
									    				<div class="form-group">
													    	<label>@lang('index.email')</label>
													    	<input type="email" name="email" class="form-control" aria-describedby="emailHelp" required>
													  	</div>
													  	<div class="form-group">
													    	<label>@lang('index.password')</label>
													    	<input type="password" name="password" class="form-control" required>
													  	</div>
													  	<div class="form-group">
													    	<button type="submit" class="btn btn-primary">@lang('index.bookmark')</button>
													  	</div>
													  	{{ csrf_field() }}
									        			<input type="hidden" name="post_id" value="{{ $post->id }}">
									        			<input type="hidden" name="content_id" value="{{ $contents->first()->page }}">
							    					</form>
										  		</div>
										  		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
										  			<form action="/registerBookmark" method="post">
									    				<div class="form-group">
													    	<label>@lang('index.email')</label>
													    	<input type="email" name="email" class="form-control" aria-describedby="emailHelp" required>
													  	</div>
													  	<div class="form-group">
													    	<label>@lang('index.password')</label>
													    	<input type="password" name="password" class="form-control" required>
													  	</div>
													  	<div class="form-group">
								                            <label>@lang('index.password again')</label>
								                                <input type="password" class="form-control" name="password_confirmation" required>
								                        </div>
													  	<div class="form-group">
													    	<button type="submit" class="btn btn-primary">@lang('index.bookmark')</button>
													  	</div>
													  	{{ csrf_field() }}
									        			<input type="hidden" name="post_id" value="{{ $post->id }}">
									        			<input type="hidden" name="content_id" value="{{ $contents->first()->page }}">
							    					</form>
										  		</div>
											</div>
										</div>
						    		</div>
						  		</div>
							</div>
		        		@endauth
		        	</div>
	        	@endif
            </div>

            <div class="card-body pb-0">
	        	@if($contents->count())
		        	<p>{!! nl2br(trim($contents->first()->content, "\r\n\r\n")) !!}</p>
	        	@else
	        		<p>@lang('index.no page')</p>
	        	@endif

	        	{!! $contents->links('vendor.pagination.bootstrap-4') !!}
        	</div>

        	@if(session()->has('success'))
        		<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  		<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			    		<div class="modal-content border-0">
			      			<div class="modal-body bg-info text-center text-white">{{ session('success') }}</div>
			    		</div>
			  		</div>
				</div>
        	@endif
    	</div>
    </div>
</div>
@endsection
