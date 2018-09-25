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
        $user = User::create([
            'email' => 'jhonnymenarim@gmail.com',
            'password' => bcrypt('123456'),
            'name' => 'Jhonny Izidoro Menarim'
        ]);

        $user->assignRole('admin');
        $user->assignRole('author');

    }
}
