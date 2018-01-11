<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookmarkTest extends TestCase
{
	use RefreshDatabase;

    public function test_guests_cannot_bookmark()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/bookmark');
    }

    public function test_users_can_add_bookmarks()
    {
        $this->auth();
        $data = ['post_id' => 1, 'content_id' => 1];
        $this->post('/bookmark', $data);
        $data['user_id'] = auth()->id();
        $this->assertDatabaseHas('bookmarks', $data);
    }

    public function test_bookmarks_can_be_updated()
    {
    	$this->auth();
    	$bookmark = $this->bookmark(['user_id' => auth()->id(), 'content_id' => 1]);
    	$data = $bookmark->toArray();
    	$this->assertDatabaseHas('bookmarks', $data);
    	$data2 = $data;
    	$data2['content_id'] = 2;
    	$this->post('/bookmark', $data2);
    	$this->assertDatabaseHas('bookmarks', $data2)->assertDatabaseMissing('bookmarks', $data);
    }

    public function test_users_can_only_delete_his_own_bookmarks()
    {
    	$this->auth();
    	$my_bookmark = $this->bookmark(['user_id' => auth()->id()]);
    	$this->assertDatabaseHas('bookmarks', $my_bookmark->toArray());
    	$this->delete("/bookmark/$my_bookmark->id");
    	$this->assertDatabaseMissing('bookmarks', $my_bookmark->toArray());

    	$not_my_bookmark = $this->bookmark(['user_id' => (auth()->id()) * 2]);
    	$this->delete("/bookmark/$not_my_bookmark->id");
    	$this->assertDatabaseHas('bookmarks', $not_my_bookmark->toArray());
    }
}
