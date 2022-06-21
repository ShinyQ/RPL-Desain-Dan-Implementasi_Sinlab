<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_success_get_login_page()
    {
        $response = $this->get('/user/login');
        $response->assertStatus(200);
    }

    public function test_success_post_login()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->get('/user/logout');

        // assertion
        $response->assertStatus(302);
    }

    public function test_success_get_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->get('/user/profile');

        // assertion
        $response->assertStatus(200);
    }

    public function test_success_get_list_user()
    {
        $user = User::factory()->create();
        $user['role'] = 'superuser';

        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->get('/admin/user');

        // assertion
        $response->assertStatus(302);
    }
}
