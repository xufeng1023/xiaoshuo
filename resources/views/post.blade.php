@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<div class="card p-3">
	        	<h1 class="h3 font-weight-bold">{{ $post->title }}</h1>
	        	<div>
	        		@auth
		        		<form action="/bookmark" method="post">
		        			{{ csrf_field() }}
		        			<input type="hidden" name="post_id" value="{{ $post->id }}">
		        			<input type="hidden" name="content_id" value="{{ $contents->first()->id }}">
		        			<button type="submit" class="btn btn-outline-secondary btn-sm">bookmark</button>
		        		</form>
		        		<button type="button" class="btn btn-outline-secondary btn-sm">favorite</button>
	        		@else
		        		<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".loginToBookmarkModal">Small modal</button>
		        		<div class="modal fade loginToBookmarkModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					  		<div class="modal-dialog modal-sm">
					    		<div class="modal-content">
					    			<div class="modal-body">
						    			<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
									  		<li class="nav-item">
									    		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">login</a>
									  		</li>
									  		<li class="nav-item">
									    		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">register</a>
									  		</li>
										</ul>
										<div class="tab-content" id="myTabContent">
									  		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									  			<form action="/loginBookmark" method="post">
								    				<div class="form-group">
												    	<label>Email address</label>
												    	<input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
												  	</div>
												  	<div class="form-group">
												    	<label>Password</label>
												    	<input type="password" name="password" class="form-control" placeholder="Password" required>
												  	</div>
												  	<div class="form-group">
												    	<button type="submit" class="btn btn-primary">bookmark</button>
												  	</div>
												  	{{ csrf_field() }}
								        			<input type="hidden" name="post_id" value="{{ $post->id }}">
								        			<input type="hidden" name="content_id" value="{{ $contents->first()->id }}">
						    					</form>
									  		</div>
									  		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									  			<form action="/registerBookmark" method="post">
								    				<div class="form-group">
												    	<label>Email address</label>
												    	<input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
												  	</div>
												  	<div class="form-group">
												    	<label>Password</label>
												    	<input type="password" name="password" class="form-control" placeholder="Password" required>
												  	</div>
												  	<div class="form-group">
							                            <label>Confirm Password</label>
							                                <input type="password" class="form-control" name="password_confirmation" required>
							                        </div>
												  	<div class="form-group">
												    	<button type="submit" class="btn btn-primary">bookmark</button>
												  	</div>
												  	{{ csrf_field() }}
								        			<input type="hidden" name="post_id" value="{{ $post->id }}">
								        			<input type="hidden" name="content_id" value="{{ $contents->first()->id }}">
						    					</form>
									  		</div>
										</div>
									</div>
					    		</div>
					  		</div>
						</div>
	        		@endauth
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
	        	<p>{!! nl2br($contents->first()->content) !!}</p>
	        	{!! $contents->links('vendor.pagination.simple-bootstrap-4') !!}
        	</div>
        </div>
    </div>
</div>
@endsection
