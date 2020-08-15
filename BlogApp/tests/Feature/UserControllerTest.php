<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
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

        $response = $this->get(route('users.home', ['user' => $user->name]));
        $response->assertStatus(200)->assertViewIs('users.home');
        $response = $this->get(route('users.index', ['user' => $user->name]));
        $response->assertStatus(200)->assertViewIs('users.index');
        $response = $this->get(route('users.likes', ['user' => $user->name]));
        $response->assertStatus(200)->assertViewIs('users.likes');
        $response = $this->get(route('users.followings', ['user' => $user->name]));
        $response->assertStatus(200)->assertViewIs('users.followings');
        $response = $this->get(route('users.followers', ['user' => $user->name]));
        $response->assertStatus(200)->assertViewIs('users.followers');
    }
}
