<?php

namespace Tests\Unit\Models;

use App\Models\Contract;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;

class EmployeeTest extends TestCase
{
   use DatabaseMigrations;

    /**
     * @test
     *
     * It adds all the attributes.
     */
   public function itCreatesAFullAttrEmployee()
   {
       //creating the User
       $user = User::factory()->create();

       //creating a contract
       $contract = Contract::create(['hours'=>44, 'location_id'=>1]);

       //creating the Department
       $department = Department::factory()->create();

       //creating the Employee
      $employee = Employee::create([
           'user_id'=>$user->id,
           'department_id'=>$department->id,
           'contract_id' => $contract->id,
            'company_id' => 1
           ]);
      $data = [
          'user_id'=>$user->id,
          'department_id'=>$department->id,
          'contract_id' => $contract->id,
          'company_id' => 1
      ];

      //verify data is inserted
       $this->assertEquals($data['user_id'], $employee->user_id);


   }

    /**
     * @test
     */
   public function itTestsTheRelations()
   {
       //creating the User
       $user = User::factory()->create();

       //creating a contract
       $contract = Contract::create(['hours'=>44, 'location_id'=>1]);

       //creating the Department
       $department = Department::factory()->create();

       //creating the Employee
      $employee = Employee::create([
           'user_id'=>$user->id,
           'department_id'=>$department->id,
           'contract_id' => $contract->id,
          'company_id' => 1
           ]);
      //verify data is inserted
       $this->assertEquals($employee->user_id, $user->id);

       //verify the employee-user relation;
       $employeeUserRelation  = $employee->user;
//       dd($employee->toArray());
       $this->assertEquals($user->name, $employeeUserRelation->name);

       //verify employee-department relation
       $employeeDepartmentRelation = $employee->department;
       $this->assertEquals($department->toArray(), $employeeDepartmentRelation->toArray());

       //verify employee-contract relation
       $employeeContractRelation = $employee->contract;
       $this->assertEquals($contract->toArray(), $employeeContractRelation->toArray());

   }
}
