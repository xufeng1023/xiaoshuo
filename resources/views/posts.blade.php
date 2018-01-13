@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<table class="table table-striped table-bordered">

	            @foreach($posts as $p)
		            <tr>
		            	<td>
		                	<a href="/post/{{ $p->title }}">{{ $p->title }}</a>
		                </td>
	                </tr>
	            @endforeach
	            
        	</table>
        	{!! $posts->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection
