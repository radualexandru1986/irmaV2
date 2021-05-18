<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use App\Models\LocationDetails;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationDetailsTest extends TestCase
{
   use DatabaseMigrations;

    /**
     * @test
     */
   public function itCreatesLocationDetails()
   {
       //creating the location
       $location = Location::factory()->create();
       //creating the location details
       $locationDetails = LocationDetails::factory()->create(['location_id'=>$location->id]);

       //testing creation
       $this->assertEquals(1, $locationDetails->id);

       //testing relation locationDetails -> location
       $this->assertEquals($location->id, $locationDetails->location->id);

//       testing relation location ->location details via details()
       $this->assertEquals($location->details->id, $locationDetails->id);
   }
}
