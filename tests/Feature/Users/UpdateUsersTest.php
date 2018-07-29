<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function administrator_can_update_users()
    {
        $this->signIn();
        $user = create(User::class);

        $this->putJson(route('users.update', $user), ['name' => 'Changed Name'])
            ->assertStatus(Response::HTTP_ACCEPTED);

        $this->assertEquals('Changed Name', $user->fresh()->name);
    }

    /** @test */
    function user_cannot_update_other_user()
    {
        $this->signIn(create(User::class));

        $this->putJson(route('users.update', create(User::class)))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function user_can_update_itself()
    {
        $this->signIn(create(User::class));

        $this->putJson(route('users.update', auth()->id()))
            ->assertSuccessful();
    }
}