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
            'name' => 'Lenard Mangay-ayam',
            'email' => 'lenard.mangayayam@gmail.com',
            'password' => bcrypt('lenard0727'),
            'type' => Conf::ROLE_ADMIN,
        ]);
    }
}
