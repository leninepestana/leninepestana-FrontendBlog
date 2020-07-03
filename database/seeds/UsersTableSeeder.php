<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the users table
        DB::TABLE('users')->truncate();

        // generate 3 users/author
        DB::table('users')->insert([
            [
                'name'     => "John Doe",
                'email'    => "johndoe@test.com",
                'password' => bcrypt('secret')
            ],
            [
                'name'     => "Eliot Hut",
                'email'    => "ellhut@gmail.com",
                'password' => bcrypt('secret')
            ],
            [
                'name'     => "Fhart Fieop",
                'email'    => "fhartfi@yahoo.com",
                'password' => bcrypt('secret')
            ],
        ]);

    }
}
