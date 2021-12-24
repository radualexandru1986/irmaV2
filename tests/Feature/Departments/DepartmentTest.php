<?php

namespace Tests\Feature\Departments;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DepartmentsTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations,  WithoutMiddleware;


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
    public function itCreatesADepartmentFromAForm()
    {
        $this->withoutExceptionHandling();
            $this->post('/department', [
            'name'=> 'Foo Department',
            'description' => 'This is a test department'
        ]);

        $departments = Department::all();

        $this->assertEquals(1, $departments->count());
        $this->assertEquals('Foo Department', $departments[0]->name);
    }

    /**
     * @test
     */
    public function itCreatesADepartmentAndItTestsForJsonResponse()
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson('/department', [
            'name'=> 'Foo Department',
            'description' => 'This is a test department'
        ]);

        $departments = Department::all();

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'The department is saved!', 'department' => $departments->last()->id]);
    }

    /**
     * @test
     */
    public function itUpdatesADepartment()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        $departments = Department::factory(3)->create();

        $allDepartments = Department::all();

        $this->assertEquals(3, Department::all()->count());

        $lastDepartment = $allDepartments->last();

        $this->patch('/department/'.$lastDepartment->id, [
            'name'=> 'Test2',
            'description' => 'Some description'
        ]);

        $this->assertEquals('Test2', Department::all()->last()->name);
        $this->assertEquals('Some description', Department::all()->last()->description);

    }

    /**
     * @test
     */
    public function itUpdatesADepartmentAnExpectsJson()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        $departments = Department::factory(3)->create();

        $allDepartments = Department::all();

        $this->assertEquals(3, Department::all()->count());

        $lastDepartment = $allDepartments->last();

        $response = $this->patchJson('/department/'.$lastDepartment->id, [
            'name'=> 'Test2',
            'description' => 'Some description'
        ]);

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'The department details are saved!', 'department' => Department::all()->last()->id]);
    }

    /**
     * @test
     */
    public function itDeletesADepartmentAndExpectsJson()
    {
        $departments =  Department::factory(3)->create();
        $response = $this->deleteJson('/department/'.$departments->last()->id);

        $d =  Department::all();
        $this->assertEquals(2, $d->count());
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'The department was deleted!']);
    }
    /**
     * @test
     */
    public function itDeletesADepartment()
    {
        $this->withoutExceptionHandling();
        $departments =  Department::factory(3)->create();

        $this->delete('/department/'.$departments->last()->id);

        $this->assertDeleted('departments',['id' =>$departments->last()->id]);

    }
}
