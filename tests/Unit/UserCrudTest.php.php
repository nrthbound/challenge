<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCrudTest extends TestCase
{
    /**
     * Setup the Test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
    }

    /**
     * The user can login
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $response = $this->json('POST', '/api/login', [
            'email' => 'awesomedude0@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $response->assetStatus(200);
    }

    /**
     * User can create a Product
     *
     * @return void
     */
    public function test_user_can_create_a_product()
    {
        Auth::loginAsUser(1);

        $response = $this->json('POST', '/api/products', [
            'user_id' => auth()->id,
            'name' => 'Awesome fake product!',
            'description' => 'Coolest description ever!',
            'price' => 4.45
        ]);

        $response->assertDatabaseHas('products', [
            'name' => 'Awesome fake product!'
        ]);
    }

}
