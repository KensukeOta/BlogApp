<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    //  引数としてnullを渡した時、falseが返ってくることをテスト
    public function testIsLikedByNull()
    {
        $post = factory(Post::class)->create();

        $result = $post->isLikedBy(null);
        $this->assertFalse($result);
    }

    //  記事をいいねしているUserモデルのインスタンスを引数として渡した時、trueが返ってくることをテスト
    public function testIsLikedByTheUser()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $post->likes()->attach($user);

        $result = $post->isLikedBy($user);
        $this->assertTrue($result);
    }

    //  記事をいいねしていないUserモデルのインスタンスを引数として渡した時、falseが返ってくることをテスト
    public function testIsLikedByAnother()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $post->likes()->attach($another);

        $result = $post->isLikedBy($user);
        $this->assertFalse($result);
    }
}
