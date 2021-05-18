<?php

namespace Tests\Unit\Routes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class RoutesTest extends TestCase
{

    /**
     * @test
     */
    public function itSendsARequestToHomeRoute()
    {
        $appUrl = env('APP_URL');
       $response = $this->call('GET', '/');
       $this->assertEquals(200, $response->status());

    }

}
