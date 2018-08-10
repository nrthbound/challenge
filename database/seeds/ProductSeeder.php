<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => '1',
            'user_id' => '1',
            'name' => 'Awesome Product',
            'description' => 'The best description ever.',
            'price' => 4.35
        ]);
    }
}
