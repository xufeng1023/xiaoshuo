<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];

	public $timestamps = false;    

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function searchedText($text)
	{
		$strArrays = explode($text, $this->content);

		$before = substr(trim($strArrays[0]), -150);
		$after = substr(trim($strArrays[1]), 0, 150);

		return $before.'<span class="text-danger font-weight-bold">'.$text.'</span>'.$after;
	}
}
