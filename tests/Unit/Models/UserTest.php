<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\UserAddress;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function itCreatesAUser()
    {
        $user = User::factory()->create();

        //Expecting to create 4 users
        $this->assertEquals(1, $user->count());
    }

    /**
     * @test
     */
    public function itAddsAddressToTheUser()
    {
        $user = User::factory()->count(4)->has(UserAddress::factory(), 'addresses')->create();

        //Expecting to create 4 users
        $this->assertEquals(4, $user->count());

        //Expecting to create 4 addresses
        $this->assertEquals(4, UserAddress::all()->count());

        $firstUser = $user->first();
        $lastUser = $user->last();
        $lastAddress = UserAddress::all()->last();
        $firstAddress = UserAddress::first();

        //Asserting that the addresses are correctly assigned to the right user
        $this->assertEquals($lastUser->id, $lastAddress->user_id);
        $this->assertEquals($firstUser->id, $firstAddress->user_id);
    }

            //==   relations    ==
    /**
     * @test
     */
    public function itVerifiesUserAddressRelation()
    {
        $user = User::factory()->count(4)->has(UserAddress::factory(), 'addresses')->create();
        $firstUser = $user->first();
        $addresses = UserAddress::all();
        $firstUserAddress = $addresses->where('user_id', $firstUser->id)->first();

        //verify user-address relation
        $userAddressRelation = $firstUser->addresses->first();
        $this->assertEquals($userAddressRelation->toArray(),$firstUserAddress->toArray());
    }

    /**
     * @test
     */
    public function itVerifiesUserEmployeeRelation()
    {
        //creating the user
        $user = User::factory()->create();

        //creating the employee
        $employee = Employee::create([
            'user_id'=>$user->id,
            'department_id'=>1,
            'contract_id' =>1,
            'company_id'=>1
        ]);


        //check relation
        $this->assertEquals($user->employee->toArray(), $employee->toArray());

    }
}
