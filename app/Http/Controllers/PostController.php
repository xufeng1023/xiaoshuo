<?php

namespace App\Http\Controllers;

use App\{Post,Content};
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth', 'admin'])->only(['new', 'upload']);
	}

	public function index()
	{
		$posts = Post::latest()->paginate(15);
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
        $validatedData = $request->validate([
            'title' => 'required|unique:posts,title',
            'author' => 'nullable',
            'content' => 'required|file'
        ]);

        $post = Post::create($validatedData);

        $episodes = (new \App\CutPage(
            file_get_contents($request->content)
        ))->cut_str();

    	foreach($episodes as $episode) {
    		$post->contents()->create([
                'content' => trim($episode, "\r\n\r\n")
            ]);
    	}

    	return back()->withSuccess('file uploaded!');
    }

    public function search(Request $request)
    {
        

        if($request->search_category === 'content') {

            $query = Content::where('content', 'LIKE', "%$request->q%");

            foreach( explode(' ', $request->q) as $w ) {
                $query = $query->orWhere('content', 'LIKE', "%$w%");
            }
            
            $contents = $query->paginate(15);
            $contents->load('post');
        }

        else {
            $contents = Post::where($request->search_category,  'LIKE', "%$request->q%")->paginate(15);
            $contents->load('contents')->first();
        }

        return view('search', compact('contents'));
    }
}
