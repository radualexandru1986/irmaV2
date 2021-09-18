<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RoleTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function itCreatesARole()
    {
        $role = Role::factory()->create();
        $this->assertEquals($role->all()->count(), 1);
    }
}
