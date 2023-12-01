<?php

namespace Tests\Feature\Api;

use App\Models\work\ChildrenEventWork;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class childrenEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function can_get_all_events()
    {
        $response = $this->getJson(route('api.childrenEvent.integrityСheck'));
        // We will only assert that the response returns a 200 status for now.
        $response->assertOk();
    }
}
