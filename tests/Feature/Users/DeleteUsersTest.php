<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function administrator_can_delete_users()
    {
        $this->signIn();
        $user = create(User::class);

        $this->assertNull($user->deleted_at);

        $this->deleteJson(route('users.destroy', $user))
            ->assertSuccessful();

        $this->assertNotNull($user->fresh()->deleted_at);
    }

    /** @test */
    function user_cannot_delete_other_user()
    {
        $this->signIn(create(User::class));

        $user = create(User::class);

        $this->deleteJson(route('users.destroy', $user->id))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function user_can_delete_itself()
    {
        $this->signIn(create(User::class));

        $this->deleteJson(route('users.destroy', auth()->id()))
            ->assertSuccessful();
    }
}