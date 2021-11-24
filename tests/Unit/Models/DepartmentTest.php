<?php

namespace Tests\Unit\Models;

use App\Models\Shift;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Department;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function itCreatesADepartment()
    {
        $department = Department::factory()->create();

        $this->assertEquals(1, $department->all()->count());
    }

    /**
     * @test
     */
    public function itAddsShiftsToDepartment()
    {
        //creating the department ad shifts
        $department = Department::factory()->has(Shift::factory()->count(3), 'shifts')->create();

        $firstShift = $department->shifts->first();
        $lastShift = $department->shifts->last();

        //Verify the first and last shifts belongs to the department
        $this->assertEquals($department->id, $firstShift->department_id);
        $this->assertEquals($department->id, $lastShift->department_id);
        $this->assertEquals(3, $department->shifts->count());
    }



}
