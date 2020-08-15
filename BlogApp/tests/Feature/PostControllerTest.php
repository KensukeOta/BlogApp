<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testExample()
    {
        //  ユーザーのダミーデータを作成
        $user = factory(User::class)->create();
        //  記事のダミーデータを作成
        $post = factory(Post::class)->create();
        
        $response->assertStatus(200);
    }
}
