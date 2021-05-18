<?php

namespace Tests\Unit\Models;

use App\Models\Container;
use App\Models\ContainerShift;
use App\Models\Employee;
use App\Models\Rota;
use App\Models\Shift;
use App\Models\ShiftEmployee;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RotaTest extends TestCase
{
    use DatabaseMigrations;


    public function testRota()
    {

        //persons
        $persons = Employee::factory()->count(5)->create();
        //shifts
        $shifts = Shift::factory()->count(3)->create();

        //creating the container
        Container::insert([
            ['container_date'=> now(), 'rota_id' => 1 ],
            ['container_date'=> Carbon::tomorrow()->addDay(), 'rota_id' => 1 ],
            ['container_date'=> Carbon::tomorrow()->addDays(2), 'rota_id' => 1 ],
            ['container_date'=> Carbon::tomorrow()->addDays(3), 'rota_id' => 1 ],
            ['container_date'=> Carbon::tomorrow()->addDays(4), 'rota_id' => 1 ],
            ['container_date'=> Carbon::tomorrow()->addDays(5), 'rota_id' => 1 ],
            ['container_date'=> Carbon::tomorrow()->addDays(6), 'rota_id' => 1 ],
        ]);
        $containers = Container::all();

        //binding shifts and containers together
        $containerShift = ContainerShift::insert([
            ['container_id'=>1, 'shift_id'=>1],
            ['container_id'=>1, 'shift_id'=>2],
            ['container_id'=>1, 'shift_id'=>3],

            ['container_id'=>2, 'shift_id'=>1],
            ['container_id'=>2, 'shift_id'=>2],
            ['container_id'=>2, 'shift_id'=>3],

            ['container_id'=>3, 'shift_id'=>2],
            ['container_id'=>3, 'shift_id'=>1],
            ['container_id'=>3, 'shift_id'=>3],

            ['container_id'=>4, 'shift_id'=>2],
            ['container_id'=>4, 'shift_id'=>1],
            ['container_id'=>4, 'shift_id'=>3],

            ['container_id'=>5, 'shift_id'=>2],
            ['container_id'=>5, 'shift_id'=>1],
            ['container_id'=>5, 'shift_id'=>3],

            ['container_id'=>6, 'shift_id'=>1],
            ['container_id'=>6, 'shift_id'=>2],
            ['container_id'=>6, 'shift_id'=>3],

            ['container_id'=>7, 'shift_id'=>1],
            ['container_id'=>7, 'shift_id'=>2],
            ['container_id'=>7, 'shift_id'=>3],
        ]);

        //creating the rota Eg. 1 rota can /will contain 7 containers
        $rota = Rota::create(['start_date'=>now(), 'end_date'=>Carbon::now()->addDays(7), 'comments'=>'this is rota', 'department_id'=>1, 'location_id'=>1]);


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

        //testing relation from shifts -> employees
        $personsOnShift1 = $shifts->first()->employees;
        $this->assertEquals(1, $personsOnShift1->first()->id);
        $this->assertEquals(2, $personsOnShift1->count());

        //testing relations employees->shifts
        $firstEmployee = $persons->first();
        $this->assertEquals($firstEmployee->id, $personsOnShift1->first()->id);

        //testing container->shift relation
        $firstContainer = $containers->first();
        $this->assertEquals(3, $firstContainer->shifts->count());

//
//        $p = [];
//        foreach($firstContainer->shifts as $shift) {
//            array_push($p, $shift->employees->count());
//        }
//       dd($p);


        //testing shift->container relation
        $firstShift = $shifts->first();
        $this->assertEquals(7, $firstShift->containers->count());

        //testing rota->container relation
        $firstContainerFromRotaRelation = $rota->containers->first();
        $this->assertEquals(7, $rota->containers->count());
        $this->assertEquals($firstContainerFromRotaRelation->container_date, $containers->first()->container_date);

    }

}
