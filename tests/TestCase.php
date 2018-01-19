<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function auth($data = [])
    {
    	$this->be(
    		factory(\App\User::class)->create($data)
    	);
    }

    public function admin()
    {
        $this->auth(['admin' => 1]);
    }

    public function article($data = [], $action = 'create')
    {
    	return factory(\App\Post::class)->{$action}($data);
    }

    public function content($data = [], $action = 'create')
    {
        return factory(\App\Content::class)->{$action}($data);
    }

    public function bookmark($data = [], $action = 'create')
    {
        return factory(\App\Bookmark::class)->{$action}($data);
    }
}
