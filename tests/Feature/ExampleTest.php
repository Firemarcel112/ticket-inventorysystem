<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\UserController;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected UserController $userController;

    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertOk();

    }

}
