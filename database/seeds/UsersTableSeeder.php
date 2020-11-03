<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\Conf;
use App\Model\User;

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
            'name' => env('USER_NAME', 'Lenard Mangay-ayam'),
            'email' => env('USER_EMAIL', 'lenard.mangayayam@email.com'),
            'password' => bcrypt(env('USER_PASSWORD', 'lenard0727')),
            'type' => Conf::ROLE_ADMIN,
        ]);
    }
}
