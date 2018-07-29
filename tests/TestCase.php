<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Helper for signing in a user. If no user is provided it will log in an Admin user.
     *
     * @param User $user
     * @param string $guard
     * @return $this
     */
    protected function signIn($user = null, $guard = null)
    {
        $user = $user?: factory(User::class)->states('admin')->create();

        $this->actingAs($user, $guard);

        return $this;
    }
}
