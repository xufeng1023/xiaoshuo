<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
    	return 'title';
    }

    public function contents()
    {
    	return $this->hasMany(Content::class);
    }
}
