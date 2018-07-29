<?php

namespace Tests\Feature\Admin;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function only_administrators_can_create_users()
    {
        $this->signIn(create(User::class));

        $userData = $this->getUserData();

        $this->postJson(route('users.store', $userData))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function administrator_can_create_users()
    {
        $this->signIn();
        $userData = $this->getUserData();

        $response = $this->postJson(route('users.store', $userData))
            ->assertStatus(Response::HTTP_CREATED)
            ->json();

        $this->assertEquals($userData['name'], $response['data']['name']);
    }

    /** @test */
    function administrator_can_create_users_and_associate_a_role()
    {
        $this->signIn();
        $role = create(Role::class);
        $userData = $this->getUserData(['role_id' => $role->id]);

        $response = $this->postJson(route('users.store', $userData))
            ->assertStatus(Response::HTTP_CREATED)
            ->json();

        $user = User::find($response['data']['id']);
        $this->assertEquals($role->name, $user->role->name);
    }

    private function getUserData($attributes = [])
    {
        $userData = make(User::class, $attributes)->toArray();
        $userData = array_merge($userData, [
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);

        return $userData;
    }
}