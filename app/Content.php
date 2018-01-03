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

	public function searchedText($text, $limit = 100)
	{
		$before = str_limit(
			trim(str_before($this->content, $text))
		, $limit);

		$after = str_limit(
			trim(str_after($this->content, $text))
		, $limit);

		return $before.'<span class="text-danger font-weight-bold">'.$text.'</span>'.$after;
	}
}
