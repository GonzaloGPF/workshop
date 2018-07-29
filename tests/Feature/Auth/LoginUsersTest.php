<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    /** @test */
    function it_lets_users_log_in()
    {
        $user = create(User::class);

        $response = $this->postJson(route('login', [
            'email' => $user->email,
            'password' => config('custom.default_user_pass')
        ]))->assertSuccessful()
            ->json();

        $this->assertArrayHasKey('token', $response['data']);
    }

    /** @test */
    function it_can_fetch_the_current_user()
    {
        $this->signIn();

        $this->getJson(route('user'))
            ->assertSuccessful()
            ->assertJsonStructure(['data' => ['id', 'name', 'email']]);
    }

    /** @test */
    function it_can_log_out()
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => config('custom.default_user_pass'),
        ])->json();

        $token = $response['data']['token'];

        $this->postJson(route('logout', ['token' => $token]))
            ->assertSuccessful();

        $this->getJson(route('user', ['token' => $token]))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}