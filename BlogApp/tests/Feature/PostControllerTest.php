<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
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
        
        //  記事の詳細ページへ遷移できるかをテスト
        $response = $this->get(route('posts.show', ['post' => $post->id]));
        $response->assertStatus(200)->assertViewIs('posts.show');
        //  記事検索ページへ遷移できるかをテスト
        $response = $this->get(route('posts.search'));
        $response->assertStatus(200)->assertViewIs('posts.search');
    }

    //  トップページへ遷移するかをテスト
    public function testIndex()
    {
        $response = $this->get(route('posts.index'));
        $response->assertStatus(200)->assertViewIs('posts.index');
    }

    //  未ログイン状態で記事投稿画面に遷移すれば、ログイン画面にリダイレクトされるかのテスト
    public function testGuestCreate()
    {
        $response = $this->get(route('posts.new'));
        $response->assertRedirect(route('login'));
    }  

    //  ログイン済み状態で記事投稿画面に遷移すれば、記事投稿画面が表示されることのテスト
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('posts.new'));
        $response->assertStatus(200)->assertViewIs('posts.new');
    }
}
