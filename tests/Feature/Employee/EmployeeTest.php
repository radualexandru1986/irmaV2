<?php

namespace Tests\Feature\Employee;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, WithoutMiddleware;
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
    public function itCreatesAEmployeeFromAForm()
    {
        $this->withoutExceptionHandling();
        $this->post('/employee', [
            'department_id'=> 1,
            'user_id' => 1,
            'contract_id' => 1
        ]);

        $employee = Employee::all();

        $this->assertEquals(1, $employee->count());
        $this->assertEquals([
            'department_id'=> 1,
            'user_id' => 1,
            'contract_id' => 1
        ], [
            'department_id'=> $employee[0]->department_id,
            'user_id' => $employee[0]->user_id,
            'contract_id' => $employee[0]->contract_id
        ]);
    }

    /**
     * @test
     */
    public function itCreatesAEmployeeAndItTestsForJsonResponse()
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson('/employee', [
            'department_id'=> 1,
            'user_id' => 1,
            'contract_id' => 1
        ]);

        $employee = Employee::all();

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'Your employee is saved', 'employee' => $employee->last()->id]);
    }

    /**
     * @test
     */
    public function itUpdatesAEmployee()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        $employees = Employee::factory(3)->create();

        $this->patch('/employee/'.$employees->last()->id, [
            'department_id'=> 2,
            'user_id' => 2,
            'contract_id' => 2
        ]);

        $this->assertEquals(2, Employee::all()->last()->user_id);
        $this->assertEquals(2, Employee::all()->last()->department_id);
        $this->assertEquals(2, Employee::all()->last()->contract_id);
    }

    /**
     * @test
     */
    public function itUpdatesAEmployeeAndExpectsJson()
    {

        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        $employees = Employee::factory(3)->create();

        $response = $this->patchJson('/employee/'.$employees->last()->id, [
            'department_id'=> 2,
            'user_id' => 2,
            'contract_id' => 2
        ]);

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'msg' => 'Your employee is updated!',
            'employee' => Employee::all()->last()->id
        ]);
    }


    /**
     * @test
     */
    public function itDeletesAEmployeeAndExpectsJson()
    {
        $employees =  Employee::factory(3)->create();
        $response = $this->deleteJson('/employee/'.$employees->last()->id);

        $d =  Employee::all();
        $this->assertEquals(2, $d->count());
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'Your employee is now destroyed !']);
    }
    /**
     * @test
     */
    public function itDeletesAEmployee()
    {
        $this->withoutExceptionHandling();
        $employees =  Employee::factory(3)->create();
        $response = $this->delete('/employee/'.$employees->last()->id);

        $d =  Employee::all();

        $this->assertDeleted('employees',['id' =>$employees->last()->id]);

    }
}
