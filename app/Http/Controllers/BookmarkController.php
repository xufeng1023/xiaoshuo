<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookmarkController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function store(Request $request)
    {
    	Bookmark::updateOrCreate(
    		[
				'user_id' => auth()->id(),
				'post_id' => $request->post_id
    		],
    		[
    			'content_id' => $request->content_id
    		]
    	);

    	return back()->with('success', 'bookmarked successful.');
    }

    public function delete(Bookmark $bookmark)
    {
    	if(Gate::allows('delete-bookmark', $bookmark)) {
    		$bookmark->delete();
    	}

    	return back();
    }
}
