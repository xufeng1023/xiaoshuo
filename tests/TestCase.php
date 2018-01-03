<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function auth()
    {
    	$this->be(
    		factory(\App\User::class)->create()
    	);
    }

    public function article($data = [], $action = 'create')
    {
    	return factory(\App\Post::class)->{$action}();
    }

    public function content($data = [], $action = 'create')
    {
        return factory(\App\Content::class)->{$action}($data);
    }
}
