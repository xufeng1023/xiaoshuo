<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake();
    	$this->auth();
        $post = $this->article([], 'raw');
        $post['content'] = UploadedFile::fake()->create('text.txt', 100);
    	$this->post('/upload', $post);
    	$this->assertDatabaseHas('posts', ['title' => $post['title']]);
        $this->assertDatabaseHas('contents', ['post_id' => 1]);
    }

    public function test_guests_can_read_a_post()
    {
        $content = $this->content(['content' => 'hello123']);
        $this->get("/post/{$content->post->title}")
            ->assertSee($content->post->title)
            ->assertSee('hello123');
    }

    public function test_guests_can_search()
    {
        $content1 = $this->content(['content' => 'hello123']);
        $content2 = $this->content(['content' => 'hello456']);
        
        $this->get("/search?q=hello")
            ->assertSee($content1->post->title)->assertSee($content2->post->title);
        $this->get("/search?q=456")
            ->assertDontSee($content1->post->title)->assertSee($content2->post->title);
    }
}
