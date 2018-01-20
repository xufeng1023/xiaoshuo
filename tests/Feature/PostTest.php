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

    public function test_users_cannot_see_upload_page()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
        $this->auth();
        $this->get('/upload');
    }

    public function test_admin_can_see_upload_page()
    {
    	$this->admin();
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

    public function test_users_cannot_post()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
        $this->auth();
        $this->post('/upload');
    }

    public function test_auth_can_post()
    {
        Storage::fake();
    	$this->admin();

        $post = $this->article([], 'raw');
        $post['content'] = UploadedFile::fake()->create('text.txt', 100);

    	$this->post('/upload', $post);
    	$this->assertDatabaseHas('posts', ['title' => $post['title']]);
        $this->assertDatabaseHas('contents', ['post_id' => 1]);
    }

    public function test_post_title_must_be_unique()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        Storage::fake();

        $this->admin();
        $post1 = $this->article();

        $post2 = $this->article(['title' => $post1->title], 'raw');
        $post2['content'] = UploadedFile::fake()->create('text.txt', 100);

        $this->post('/upload', $post2);
    }

    public function test_post_content_is_required()
    {
        $this->expectException('Illuminate\Validation\ValidationException');

        $this->admin();

        $this->post('/upload', $this->article([], 'raw'));
    }

    public function test_guests_can_read_a_post()
    {
        $content = $this->content();

        $this->get("/post/{$content->post->title}")
            ->assertSee($content->post->title)
            ->assertSee($content->content);
    }

    public function test_show_no_page_feedback_when_pagination_not_exist()
    {
        $content = $this->content();

        $this->get("/post/{$content->post->title}?page=999")
            ->assertSee($content->post->title)
            ->assertSee(trans('index.no page'));
    }

    public function test_guests_can_search()
    {
        $content1 = $this->content(['content' => 'hello123']);
        $content2 = $this->content(['content' => 'hello456']);
        
        $this->get("/search?q=hello&search_category=content")
            ->assertSee($content1->post->title)->assertSee($content2->post->title);

        $this->get("/search?q=456&search_category=content")
            ->assertDontSee($content1->post->title)->assertSee($content2->post->title);

        $this->get("/search?q=789&search_category=content")
            ->assertDontSee($content1->post->title)->assertDontSee($content2->post->title)
            ->assertSee(trans('index.no results', ['keyword' => '789', 'category' => trans('index.content')]));

        $this->get("/search?q=hello&page=999&search_category=content")
            ->assertDontSee($content1->post->title)->assertDontSee($content2->post->title)
            ->assertSee(trans('index.no results', ['keyword' => 'hello', 'category' => trans('index.content')]));
    }

    public function test_guests_can_search_by_title_or_author()
    {
        $post1 = $this->article();
        $post2 = $this->article();

        $this->get("/search?q={$post1->title}&search_category=title")
            ->assertSee($post1->author)
            ->assertDontSee($post2->author);

        $this->get("/search?q={$post1->author}&search_category=author")
            ->assertSee($post1->title)
            ->assertDontSee($post2->title);
    }

    public function test_reading_posts_adds_one_post_view()
    {
        $content = $this->content();
        $this->assertDatabaseHas('posts', ['id' => $content->post->id, 'views' => 0]);

        $this->get("/post/{$content->post->title}");
        $this->assertDatabaseHas('posts', ['id' => $content->post->id, 'views' => 1]);
    } 
}
