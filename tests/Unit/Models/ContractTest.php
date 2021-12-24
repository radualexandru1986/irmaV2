<?php

namespace Tests\Unit\Models;

use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContractTest extends TestCase
{
  use DatabaseMigrations;

    /**
     * @test
     */
  public function itCreatesAContract()
  {
      $contract = Contract::create(['name'=>'Contract','hours'=>12]);

      $this->assertEquals(12, $contract->hours);
  }

  public function test_relation()
  {
      $contract  = Contract::create(['name'=>'Contract','hours'=>12]);
      $employees = Employee::factory()->count(10)->create();


      //testing the relation contract -> employees via employees()
      $this->assertEquals($employees->count(), $contract->employees->count());
  }



}
