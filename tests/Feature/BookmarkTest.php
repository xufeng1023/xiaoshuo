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

    public function test_users_can_login_and_bookmark_together()
    {
        $password = '123123';
        $user = factory(\App\User::class)->create(['password' => bcrypt($password)]);

        $bookmark['post_id'] = 1;
        $bookmark['content_id'] = 1;

        $data = array_merge($user->toArray(), $bookmark); // user array dont include password
        $data['password'] = $password;

        $this->post('/loginBookmark', $data);
        $this->assertDatabaseHas('bookmarks', $bookmark);
    }

    public function test_users_can_register_and_bookmark_together()
    {
        $userInfo = ['email' => 'test@email.com', 'password' => '123123', 'password_confirmation' => '123123'];
        $bookmark = ['post_id' => 1, 'content_id' => 1];

        $data = array_merge($userInfo, $bookmark);

        $this->post('/registerBookmark', $data);
        $this->assertDatabaseHas('bookmarks', $bookmark)->assertDatabaseHas('users', ['id' => 1, 'email' => 'test@email.com']);
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

    public function test_guests_can_not_see_bookmarks_page()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get('/dashboard');
    }

    
}
