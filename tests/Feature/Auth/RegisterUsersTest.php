<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_lets_users_to_register()
    {
        $this->seed(\RolesTableSeeder::class);

        $this->assertCount(0, User::all());

        $this->postJson(route('register', [
            'name' => 'tester',
            'email' => 'test@mail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]))->assertSuccessful();

        $this->assertCount(1, User::all());
    }
}