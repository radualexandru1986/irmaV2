<?php

namespace Tests\Unit\Models;

use App\Models\Container;
use App\Models\ContainerShift;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContainerShiftTest extends TestCase
{
    use DatabaseMigrations;

    public function testRelations()
    {
        //create shift and containers
        $shifts = Shift::factory()->count(3)->create();

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

        $this->assertEquals($containers->first()->shifts()->count(), $shifts->count());

    }
}
