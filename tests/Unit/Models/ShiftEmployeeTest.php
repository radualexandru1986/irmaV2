<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\Shift;
use App\Models\ShiftEmployee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShiftEmployeeTest extends TestCase
{
    use DatabaseMigrations;
    //create 5 persons

    /**
     * @test
     */
    public function test_rota()
    {
        //persons
        $persons = Employee::factory()->count(5)->create();
        //shifts
        $shifts = Shift::factory()->count(3)->create();
        //link the shifts with employees
        $shiftEmployees = ShiftEmployee::insert(
            [
                ['shift_id'=>1, 'employee_id'=>1],
                ['shift_id'=>1, 'employee_id'=>2],
                ['shift_id'=>2, 'employee_id'=>3],
                ['shift_id'=>2, 'employee_id'=>4],
                ['shift_id'=>3, 'employee_id'=>5],
            ]
        );
        $this->assertEquals(5, $persons->count());
        $this->assertEquals(3, $shifts->count());

//        testing relation from shifts -> employees
        $personsOnShift1 = $shifts->first()->employees;
        $this->assertEquals(1, $personsOnShift1->first()->id);
        $this->assertEquals(2, $personsOnShift1->count());

        //testing relations employees->shifts
        $firstEmployee = $persons->first();
        $this->assertEquals($firstEmployee->id, $personsOnShift1->first()->id);

    }
}
