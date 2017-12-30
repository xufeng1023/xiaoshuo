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
        $ipage = $request->ipage ?: 1;
        $content = file_get_contents($_FILES['file']['tmp_name']);
        $cp = new \App\CutPage($content);
        $page = $cp->cut_str();
        echo $page[$ipage - 1];
        echo $cp->pagenav();
   //  	$bytesToRead = '1000';
   //  	$stream = fopen($_FILES['file']['tmp_name'], 'r');
   //  	while(!feof($stream)) {
   //  		$data = fread($stream, $bytesToRead);
   //  		Post::create([
   //  			'title' => $request->title,
   //  			'author' => $request->author,
   //  			'content' => $data
			// ]);
   //  	}
   //  	fclose($stream);
   //  	return back();
    }
}
