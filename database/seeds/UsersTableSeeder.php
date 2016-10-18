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
        DB::table('users')->insert([
            [
                'username' => 'rizkyprawira',
                'email'    => 'rizkyprawira@kemenkeu.go.id',
                'password' => bcrypt('testing'),
                'isAdmin' => 1
            ],
            [
                'username' => 'piotun',
                'email'    => 'piotun@kemenkeu.go.id',
                'password' => bcrypt('testing'),
                'isAdmin' => 1
            ],
        ]);
    }
}
