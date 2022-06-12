<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Tests\TestCase;
// use Illuminate\Http\UploadedFile;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_update_user()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->create('random.jpeg');
        $file->mimeType = 'image/jpeg';
        $res = $this->put('user/user/1', [
            'phone' => '082234890710',
            'ktm' => $file,
        ]);

        $res->assertStatus(200);
    }
    public function test_exception_failed_update_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $res = $this->put('user/user/1', [
            'phone' => '082234890710',
        ]);
        $res->assertStatus(500);
    }
    public function test_invalid_ktm_update_user()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->create('random.jpeg');
        $file->mimeType = 'application/json';
        $res = $this->put('user/user/1', [
            'phone' => '082234890710',
            'ktm' => $file,
        ]);

        $res->assertStatus(200);
    }
}
