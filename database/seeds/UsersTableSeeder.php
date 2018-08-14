<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'jhonnymenarim@gmail.com',
            'password' => bcrypt('123456'),
            'name' => 'Jhonny Menarim'
        ]);
    }
}
