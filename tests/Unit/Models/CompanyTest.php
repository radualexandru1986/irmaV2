<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function creatingACompany()
    {
        $company = Company::factory()->create();

        $this->assertEquals($company->all()->count(), 1);

    }

    /**
     * @test
     */
    public function testRelations()
    {
        $company = Company::factory()->create();

        $locations = Location::factory()->create([
            'company_id'=>$company->id,
            'manager_id'=>1,
            'name' => 'Dussindael Park'
        ]);

        $employee = Employee::factory()->create([
            'contract_id' => 1 ,
            'department_id' => 1,
            'user_id' => 1,
            'company_id' => $company->id
        ]);

        // checking relations
        $this->assertEquals($company->locations->first()->toArray(), $locations->toArray());
        $this->assertEquals($company->employees->first()->toArray(), $employee->toArray());
    }
}
