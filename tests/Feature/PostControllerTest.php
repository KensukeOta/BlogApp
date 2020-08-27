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

    //  トップページへ遷移するかをテスト
    public function testIndex()
    {
        $response = $this->get(route('posts.index'));
        $response->assertStatus(200)->assertViewIs('posts.index');
    }

    //  未ログイン時に記事投稿画面に遷移しようとするとログインページにリダイレクトされるかをテスト
    public function testGuestCreate()
    {
        $response = $this->get(route('posts.new'));
        $response->assertRedirect(route('login'));
    }  

    //  ログイン時に記事投稿画面に遷移するかをテスト
    public function testAuthCreate()
    {
        //  ユーザーのダミーデーターを作成
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('posts.new'));
        $response->assertStatus(200)->assertViewIs('posts.new');
    }

    //  記事の詳細ページへ遷移できるかをテスト
    public function testShow()
    {
        //  記事のダミーデータを作成
        $post = factory(Post::class)->create();

        $response = $this->get(route('posts.show', ['post' => $post->id]));
        $response->assertStatus(200)->assertViewIs('posts.show');
    }

    //  記事検索ページへ遷移できるかをテスト
    public function testSearch()
    {
        $response = $this->get(route('posts.search'));
        $response->assertStatus(200)->assertViewIs('posts.search');
    }
}
