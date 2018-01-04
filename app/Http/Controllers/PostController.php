<?php

namespace App\Http\Controllers;

use App\{Post,Content};
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->only(['new', 'upload']);
	}

	public function index()
	{
		$posts = Post::paginate(15);
		return view('posts', compact('posts'));
	}

    public function show(Post $post)
    {
        $post->increment('views');
        $contents = $post->contents()->paginate(1);
        return view('post', compact('post', 'contents'));
    }

    public function new()
    {
    	return view('upload');
    }

    public function upload(Request $request)
    {
        if(!$request->hasFile('content')) {
            return back()->with('file', 'no file uploaded!');
        }

        $episodes = (new \App\CutPage(
            file_get_contents($request->content)
        ))->cut_str();

        $post = Post::create([
            'title' => $request->title,
            'author' => $request->author,
        ]);

    	foreach($episodes as $episode) {
    		$post->contents()->create([
                'content' => $episode
            ]);
    	}

    	return back();
    }

    public function search(Request $request)
    {
        $keywords = explode(' ', $request->q);

        $query = Content::where('content', 'LIKE', "%$request->q%");
        
        foreach($keywords as $w) {
            $query = $query->orWhere('content', 'LIKE', "%$w%");
        }
        
        $contents = $query->paginate(15);
        
        $contents->load('post');
        return view('search', compact('contents'));
    }
}
