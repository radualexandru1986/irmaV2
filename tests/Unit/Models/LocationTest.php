<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
   use DatabaseMigrations;

    /**
     * @test
     */
   public function itCreatesALocation()
   {
       $location = Location::factory()->create();

       $this->assertNotFalse($location->name);
   }
}
