<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function searchedText($text, $return = '')
	{
		if(!$text) return;
		
		$keywords = explode(' ', $text);
		
		foreach($keywords as $w) {
			$strArrays = explode($w, $this->content);
			if(count($strArrays) <= 1) continue;
			
			$before = mb_substr(trim($strArrays[0]), -80);			
			$after = mb_substr(trim($strArrays[1]), 0, 80);

			$return = $before.$w.$after;
		}

		foreach($keywords as $w) {
			$highlighted = '<span class="text-danger font-weight-bold">'.$w.'</span>';
			$return = str_replace($w, $highlighted, $return);
		}
		
		return 	$return;	
	}
}
