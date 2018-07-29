<?php

namespace Tests\Unit;

use App\Role;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    private $role;

    protected function setUp()
    {
        parent::setUp();
        $this->role = create(Role::class);
    }

    /** @test */
    function it_has_many_users()
    {
        $this->assertInstanceOf(Collection::class, $this->role->users);
    }
}
