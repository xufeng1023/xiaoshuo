<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->only(['new', 'upload']);
	}

	public function index()
	{
		$posts = Post::paginate(10);
		return view('posts', compact('posts'));
	}

    public function show(Post $post)
    {
        dd($post->id);
        return view('post', $post->paginate(1));
    }

    public function new()
    {
    	return view('upload');
    }

    public function one(Request $request)
    {
        $bytes = 2200;
        $ipage = $request->ipage ?: 1;
        $start = ($ipage - 1) * $bytes;
        $content = file_get_contents(storage_path('app\public\test.txt'), null, null, $start, $bytes);
        $cp = new \App\CutPage($content);
        $page = $cp->cut_str();
        echo $page[$ipage - 1];
        echo $cp->pagenav();
    }

    public function upload(Request $request)
    {
        $episodes = (new \App\CutPage(
            file_get_contents($request->content)
        ))->cut_str();

    	foreach($episodes as $episode) {
    		Post::create([
    			'title' => $request->title,
    			'author' => $request->author,
    			'content' => $episode
			]);
    	}

    	return back();
    }
}
