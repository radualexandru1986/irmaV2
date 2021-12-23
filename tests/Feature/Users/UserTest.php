<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;


    protected mixed $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }


    /**
     *
     * @test
     */
    public function itCreatesAUserFromAForm()
    {
        $this->from('user')->post('/user', [
            'role_id' => '1',
            'name'=> 'Test',
            'email'=>'email@gmail.com',
            'password' => '1234'
        ]);

        $users = User::all();

        $this->assertEquals(2, $users->count());
        $this->assertEquals('Test', $users[1]->name);
    }

    /**
     * @test
     */
    public function itCreatesUserAndItTestsForJsonResponse()
    {
        $response = $this->postJson('/user', [
            'role_id' => '1',
            'name'=> 'Test',
            'email'=>'email@gmail.com',
            'password' => '1234'
        ]);

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'Well Done', 'user' => 2]);
    }

    /**
     * @test
     */
    public function itUpdatesAnUser()
    {
        //removing the exceptionHandling,  so we are able to see the errors
        $this->withoutExceptionHandling();
        //it needs to receive the user Id and the new data.
        $users = User::factory(3)->create();

        $this->from('user')->patch('/user/'.$users[2]->id, [
            'role_id' => '1',
            'name'=> 'Test2',
            'email'=>'email@gmail.com',
            'password' => '1234'
        ]);
        $u = User::all();
        $this->assertEquals(4, $u->count());
        $this->assertEquals('Test2', $u[3]->name);

    }

    /**
     * @test
     */
    public function itUpdatesAnUserAnExpectsJson()
    {
        $users = User::factory(3)->create();

        $response = $this->patchJson('/user/'.$users->last()->id, [
            'role_id' => '1',
            'name'=> 'Test2',
            'email'=>'email@gmail.com',
            'password' => '1234'
        ]);
        $u = User::all();

        $this->assertEquals('Test2', $u->last()->name);
        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'The user details are saved', 'userId' => $u->last()->id]);
    }

    /**
     * @test
     */
    public function itDeletesAnUserAndExpectsJson()
    {
        $users =  User::factory(3)->create();
        $response = $this->deleteJson('/user/'.$users->last()->id);

        $this->assertDeleted('users',['user_id' =>$users->last()->id]);

        $response->assertHeader('content-type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonFragment(['msg'=>'The user was deleted']);
    }
    /**
     * @test
     */
    public function itDeletesAnUser()
    {
        $users =  User::factory(3)->create();
        $this->delete('/user/'.$users->last()->id);

        $this->assertDeleted('users',['user_id' =>$users->last()->id]);
    }
}
