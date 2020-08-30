<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 5 ; $i++) {
            # code...
        $user = \App\User::create([
            'first_name'=> 'user',
            'last_name'=> 'name'.$i,
            'email' => 'user_name'.$i.'@mail.com',
            // 'first_name'=> 'super',
            // 'last_name'=> 'admin',
            // 'email' => 'super_admin@mail.com',
            //'password' => Hash::make('123456789'),
            'password' => Hash::make('123456789'),

        ]);

        $user->attachRole('admin');
    }
        for ($i=1; $i < 2 ; $i++) {
            # code...
        $user = \App\User::create([
            // 'first_name'=> 'user',
            // 'last_name'=> 'name'.$i,
            // 'email' => 'user_name'.$i.'@mail.com',
            'first_name'=> 'super',
            'last_name'=> 'admin',
            'email' => 'super_admin@mail.com',
            //'password' => Hash::make('123456789'),
            'password' => Hash::make('123456789'),

        ]);

        $user->attachRole('super_admin');
    }

    }
}
