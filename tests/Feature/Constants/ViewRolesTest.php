<?php

namespace Tests\Feature;

use App\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewRolesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_can_fetch_all_roles()
    {
        create(Role::class, [], 3);

        $response = $this->getJson(route('roles.index'))
            ->assertSuccessful()
            ->json();

        $this->assertCount(3, $response['data']);
    }
}