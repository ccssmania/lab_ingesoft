<?php

use Illuminate\Database\Seeder;
// use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'juancamilo.fernandez@utp.edu.co',
                'password' => bcrypt('123456'),
            ]
            
        );
    }
}
