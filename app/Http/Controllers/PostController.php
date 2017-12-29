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
		$posts = Post::all();
		return view('posts', compact('posts'));
	}

    public function new()
    {
    	return view('upload');
    }

    public function upload(Request $request)
    {
    	$bytesToRead = '10';
    	$stream = fopen($_FILES['file']['tmp_name'], 'r');
    	while(!feof($stream)) {
    		$data = fread($stream, $bytesToRead);
    		Post::create([
    			'title' => $request->title,
    			'author' => $request->author,
    			'content' => $data
			]);
    	}
    	fclose($stream);
    	return back();
    }
}
