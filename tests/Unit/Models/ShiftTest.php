<?php

namespace Tests\Unit\Models;

use App\Models\Department;
use App\Models\Location;
use App\Models\Shift;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShiftTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     */
    public function itCreatesAShift()
    {
        $shift = Shift::factory()->create();
        $this->assertEquals($shift->department_id , 1);
    }

    /**
     * @test
     */
    public function testTheRelations()
    {


        $department = Department::factory()->create();

        $shift = Shift::factory()->create(['department_id' => $department->id]);

        //testing direct relations
        $this->assertEquals($department->toArray(), $shift->department->toArray());

    }
}
