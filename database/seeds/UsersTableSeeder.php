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
                'username' => 'merlinda',
                'email'    => 'merlinda@kemenkeu.go.id',
                'password' => bcrypt('testing'),
                'isAdmin' => 0
            ],
        ]);
    }
}
