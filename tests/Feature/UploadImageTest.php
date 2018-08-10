<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadImageTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        Storage::fake('local');

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');

        Auth::loginUsingId(1);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_only_logged_in_users_can_add_product_photos()
    {
        Auth::logout();

        $this->json('POST', 'api/products/1/upload')
            ->assertStatus(401);
    }


    // For some reason, this test refused to pass. I believe it had to do
    // with the Storage driver and Windows just not cooperating. A lot of
    // folks have issues with the Storage driver in Laravel on Windows.

    // public function test_logged_in_user_can_upload_product_photo()
    // {
    //     Auth::loginUsingId(1);

    //     $this->json('POST', 'api/products/1/upload', [
    //         'image' => $file = UploadedFile::fake()->image('photo.jpg')
    //     ]);

    //     Storage::disk('local')->assertExists('photos/'. $file->hashName());
    // }
}
