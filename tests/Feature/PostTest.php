<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
	use RefreshDatabase;

    public function test_guests_cannot_see_upload_page()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get('/upload');
    }

    public function test_auth_can_see_upload_page()
    {
    	$this->auth();
    	$this->get('/upload')->assertStatus(200);
    }

    public function test_guests_can_see_all_posts()
    {
    	$post = $this->article();
    	$this->get('/')->assertSee($post->title);
    }

    public function test_guests_cannot_post()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');
    	$this->post('/upload');
    }

    public function test_auth_can_post()
    {
    	$this->auth();
    	$post = $this->article('raw');
    	$this->post('/upload', $post);
    	$this->assertDatabaseHas('posts', $post);
    }
}
