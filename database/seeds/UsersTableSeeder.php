<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'first_name' => 'John',
                'last_name' => 'Doe'.$i,
                'email' => 'awesomeuser'.$i.'@gmail.com',
                'password' => bcrypt('secret')
            ]);
        }
    }
}
