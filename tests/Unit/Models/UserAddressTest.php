<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserAddress;

class UserAddressTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function ItCreatesTheAddress()
    {
        $address = UserAddress::factory(['user_id'=>1])->create();

        //While it creates the address we can not assert that is empty because user_id is not nullable.
        $emptyAddress = UserAddress::create(['user_id'=>1]);
        $this->assertEmpty($emptyAddress->postcode);

        //assert that all the properties are filled;
        $attributes = $address->attributesToArray();
        foreach($attributes as $key=>$value){
            $this->assertNotEmpty($address->$key);
        }
    }

    /**
     * @test
     */
    public function itChecksRelationWithUser()
    {
        //create the user
        $user = User::factory()->create();
        //create the address with he user id inside
        $address = UserAddress::factory(['user_id'=>$user->id])->create();

        //check the relation
        $addressUserRelation = $address->user;
        $this->assertEquals($addressUserRelation->name, $user->name);

    }
}
