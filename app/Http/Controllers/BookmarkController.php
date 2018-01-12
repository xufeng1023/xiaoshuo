<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\RegisterController;

class BookmarkController extends RegisterController
{
    use AuthenticatesUsers;

	public function __construct()
	{
		$this->middleware('auth')->except(['loginStore', 'registerStore']);
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

    public function loginStore(Request $request)
    {
        $this->login($request)->store($request);

        return back()->with('success', 'bookmarked successful.');
    }

    public function registerStore(Request $request)
    {
        $this->register($request)->store($request);

        return back()->with('success', 'bookmarked successful.');
    }

    protected function authenticated()
    {
        return $this;
    }

    protected function registered(Request $request, $user)
    {
        return $this;
    }

    public function delete(Bookmark $bookmark)
    {
    	if(Gate::allows('delete-bookmark', $bookmark)) {
    		$bookmark->delete();
    	}

    	return back();
    }
}
