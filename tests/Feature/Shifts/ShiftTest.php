<?php

namespace Tests\Feature\Shifts;

use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShiftTest extends TestCase
{ use DatabaseTransactions, DatabaseMigrations,  WithoutMiddleware;


    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }


    /**
     * @remember - Always check the form request for the authorization e.g. Requests/StoreDepartmentRequest -> authorize
     * @test
     */
    public function itCreatesAShiftFromAForm()
    {
        $this->withoutExceptionHandling();
        $this->post('/shift', [
            'name'=> 'Foo Shift',
            'hours' => 12,
            'department_id' => 1,
            'index' => 1
        ]);

        $shifts = Shift::all();

        $this->assertEquals(1, $shifts->count());
        $this->assertEquals('Foo Shift', $shifts[0]->name);
    }

    /**
     * @test
     */
    public function itCreatesAShiftAndItTestsForJsonResponse()
    {
        $this->withoutExceptionHandling();
       $response =  $this->postJson('/shift', [
            'name'=> 'Foo Shift',
            'hours' => 12,
            'department_id' => 1,
            'index' => 1
        ]);

        $shifts = Shift::all();

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'Shift created!', 'shift' => $shifts->last()->id]);
    }

    /**
     * @test
     */
    public function itUpdatesAShift()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        Shift::factory(3)->create();

        $allShifts = Shift::all();

        $this->assertEquals(3, Shift::all()->count());

        $lastShift = $allShifts->last();

        $this->patch('/shift/'.$lastShift->id, [
            'name'=> 'Test2',
            'hours' => 10,
            'department_id' => 1,
            'index' => 2
        ]);

        $this->assertEquals('Test2', Shift::all()->last()->name);
        $this->assertEquals(10, Shift::all()->last()->hours);

    }

    /**
     * @test
     */
    public function itUpdatesADepartmentAnExpectsJson()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        Shift::factory(3)->create();

        $allShifts = Shift::all();

        $this->assertEquals(3, Shift::all()->count());

        $lastShift = $allShifts->last();

        $response = $this->patchJson('/shift/'.$lastShift->id, [
            'name'=> 'Test2',
            'hours' => 10,
            'department_id' => 1,
            'index' => 1
        ]);

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'Shift Updated!', 'shift' => Shift::all()->last()->id]);
    }

    /**
     * @test
     */
    public function itDeletesADepartmentAndExpectsJson()
    {
        $shift =  Shift::factory(3)->create();
        $response = $this->deleteJson('/shift/'.$shift->last()->id);

        $d =  Shift::all();
        $this->assertEquals(2, $d->count());
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'The shift was deleted!']);
    }
    /**
     * @test
     */
    public function itDeletesADepartment()
    {
        $this->withoutExceptionHandling();
        $shift =  Shift::factory(3)->create();

        $this->delete('/shift/'.$shift->last()->id);

        $this->assertDeleted('shifts',['id' => $shift->last()->id]);

    }
}
