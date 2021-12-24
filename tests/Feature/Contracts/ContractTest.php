<?php

namespace Tests\Feature\Contracts;

use App\Models\Contract;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ContractTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations, WithoutMiddleware;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * @test
     */
    public function itCreatesAContractFromAForm()
    {
        $this->withoutExceptionHandling();
        $this->post('/contract', [
            'name'=> 'Foo Contract',
            'hours' => 33
        ]);

        $contracts = Contract::all();

        $this->assertEquals(1, $contracts->count());
        $this->assertEquals('Foo Contract', $contracts->last()->name);
    }

    /**
     * @test
     */
    public function itCreatesAContractAndItTestsForJsonResponse()
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson('/contract', [
            'name'=> 'Foo Contract',
            'hours' => 33
        ]);

        $contracts = Contract::all();

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'Your contract is saved!', 'contract' => $contracts->last()->id]);
    }

    /**
     * @test
     */
    public function itUpdatesAContract()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        $contracts = Contract::factory(3)->create();

        $allContracts =Contract::all();

        $this->assertEquals(3,Contract::all()->count());

        $lastDepartment = $allContracts->last();

        $this->patch('/contract/'.$lastDepartment->id, [
            'name'=> 'Test2',
            'hours' => 33
        ]);

        $this->assertEquals('Test2',Contract::all()->last()->name);
        $this->assertEquals(33 ,Contract::all()->last()->hours);

    }

    /**
     * @test
     */
    public function itUpdatesAContractAnExpectsJson()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        $contracts =Contract::factory(3)->create();

        $allContracts =Contract::all();

        $this->assertEquals(3,Contract::all()->count());

        $lastDepartment = $allContracts->last();

        $response = $this->patchJson('/contract/'.$lastDepartment->id, [
            'name'=> 'Test2',
            'hours' => 33
        ]);

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'Your contract is updated!', 'contract' =>Contract::all()->last()->id]);
    }

    /**
     * @test
     */
    public function itDeletesAContractAndExpectsJson()
    {
        $contracts = Contract::factory(3)->create();
        $response = $this->deleteJson('/contract/'.$contracts->last()->id);

        // $this->assertDeleted('departments',['department_id' =>$contracts->last()->id]);
        $d = Contract::all();
        $this->assertEquals(2, $d->count());
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'The contract is now destroyed!']);
    }
    /**
     * @test
     */
    public function itDeletesAContract()
    {
        $this->withoutExceptionHandling();
        $contracts = Contract::factory(3)->create();

        $this->delete('/contract/'.$contracts->last()->id);

        $this->assertDeleted('contracts',['id' =>$contracts->last()->id]);
    }

}
