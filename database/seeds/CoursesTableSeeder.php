<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert(
            [
                'title' => 'Intro to CS',
                'user_id' => 1,
                'description' => 'This is Intro to CS.'
            ]
        );
    }
}
