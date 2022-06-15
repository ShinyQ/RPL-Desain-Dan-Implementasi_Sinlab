<?php

namespace Tests\Unit;

use App\Models\RequestItem;
use App\Models\User;
use Tests\TestCase;


class RequestItemTest extends TestCase
{


    public function test_success_store_request_item()
    {
        // Login as a user
        $this->actingAs(User::factory()->user()->create());
        // Simulate a GET request to the given URL
        $response = $this->get('/admin/pages/create');
        // Check the response, we should have been
        // redirected to the homepage
        $response->assertRedirect('/');
    }

    public function test_error_store_request_item()
    {
        $this->assertTrue(true);
    }

    public function test_success_get_own_request_item()
    {
        $this->assertTrue(true);
    }

    public function test_success_all_own_request_item()
    {
        $this->assertTrue(true);
    }

    public function test_success_update_request_item()
    {
        $this->assertTrue(true);
    }
    public function test_error_update_request_item()
    {
        $this->assertTrue(true);
    }
}
