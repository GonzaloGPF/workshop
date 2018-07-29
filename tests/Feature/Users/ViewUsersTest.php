<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ViewUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthenticated_user_cannot_fetch_users()
    {
        $this->getJson(route('users.index'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    function authenticated_user_can_fetch_all_users()
    {
        $this->signIn();

        create(User::class, [], 3);

        $response = $this->getJson(route('users.index'))
            ->json();

        $this->assertCount(User::count(), $response['data']);
    }

    /** @test */
    function authenticated_user_can_fetch_specific_users()
    {
        $this->signIn();

        $user = create(User::class);

        $this->getJson(route('users.show', $user))
            ->assertSuccessful();
    }
}