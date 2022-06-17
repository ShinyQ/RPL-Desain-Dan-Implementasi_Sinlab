<?php

namespace Tests\Unit;

use App\Models\RequestItem;
use App\Models\User;
use Tests\TestCase;

class RequestItemTest extends TestCase
{

    public function test_success_store_request_item()
    {
        // generate new request data with factory
        $data = RequestItem::factory()->make()->toArray();
        // act as loggedin user
        $user = User::factory()->create();
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->post('/request', $data);

        // assertion
        $response->assertStatus(200);
        $this->assertDatabaseHas(
            'request_items',
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'qty' => $data['qty'],
            ]
        );
    }

    public function test_error_store_request_item()
    {
        // generate new request data with factory
        $data = RequestItem::factory()->make()->toArray();

        // post data to request item store endpoint
        $response = $this->post('/request', $data);

        // assertion
        $response->assertStatus(302);
    }

    public function test_success_get_own_request_item()
    {
        // act as loggedin user
        $user = User::factory()->create();
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->get('/request');

        // assertion
        $response->assertStatus(200);
    }

    public function test_success_all_own_request_item()
    {
        // act as super user
        $user = User::factory()->create();
        $user['role'] = "super_user";
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->get('/admin/request');

        // assertion
        $response->assertStatus(200);
    }

    public function test_success_update_request_item()
    {
        // generate new request data with factory
        $data = RequestItem::factory()->create();
        $data['status'] = "Menunggu Persetujuan";
        // act as loggedin user
        $user = User::factory()->create();
        $user['role'] = "super_user";
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->put('/admin/request/' . $data['id'], $data->toArray());

        // assertion
        $response->assertStatus(200);
        $this->assertDatabaseHas(
            'request_items',
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'qty' => $data['qty'],
            ]
        );
    }
    public function test_not_found_update_request_item()
    {
        // generate new request data with factory
        $data = RequestItem::factory()->create();
        $data['status'] = "Menunggu Persetujuan";
        $data['id'] = "invalid-id";

        // act as loggedin user
        $user = User::factory()->create();
        $user['role'] = "super_user";
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->put('/admin/request/' . $data['id'], $data->toArray());

        // assertion
        $response->assertStatus(404);
        $this->assertDatabaseHas(
            'request_items',
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'qty' => $data['qty'],
            ]
        );
    }
}
