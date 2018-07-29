<?php

namespace Tests\Unit;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        parent::setUp();
        $this->seed(\RolesTableSeeder::class);

        $this->user = create(User::class);
    }

    /** @test */
    function it_belongs_to_a_role()
    {
        $this->assertInstanceOf(Role::class, $this->user->role);
    }

    /** @test */
    function it_knows_if_its_an_admin_user()
    {
        $this->assertFalse($this->user->isAdmin());

        $this->user->update(['role_id' => Role::ADMIN]);

        $this->assertTrue($this->user->fresh()->isAdmin());
    }
}
