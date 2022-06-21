<?php

namespace Tests\Unit;

use App\Models\Item;
use App\Models\User;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class ItemTest extends TestCase
{

    public function test_success_store_item()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('random.jpeg');
        $file->mimeType = 'image/jpeg';
        $data = [
            'name'=> "Testing",
            'qty'=> 2,
            'photo'=> $file,
            'description'=> "test"
        ];

        // generate new request data with factory
        // $data = Item::factory()->make()->toArray();
        // act as loggedin user
        $user = User::factory()->create();
        $user['role'] = 'super_user';
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->post('/admin/item', $data);

        // assertion
        $response->assertStatus(302);
        // $this->assertDatabaseHas(
        //     'items',
        //     [
        //         'name' => $data['name'],
        //         'photo' => $data['photo'],
        //         'description' => $data['description'],
        //         'qty' => $data['qty'],
        //     ]
        // );
    }

    public function test_error_store_item()
    {

        // generate new request data with factory
        $data = Item::factory()->make()->toArray();
        // act as loggedin user
        $user = User::factory()->create();
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->post('/item', $data);

        // assertion
        $response->assertStatus(302);
    }

    public function test_success_get_item()
    {
        // act as loggedin user
        $user = User::factory()->create();
        $this->actingAs($user);

        // post data to request item store endpoint
        $this->withSession(['user' => $user]);
        $response = $this->get('/item');

        // assertion
        $response->assertStatus(200);
    }
}
