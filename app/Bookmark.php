<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $guarded = [];

    protected $with = ['post', 'content'];

    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    public function content()
    {
    	return $this->belongsTo(Content::class);
    }
}
