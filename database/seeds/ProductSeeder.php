<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 5)->create()->each(function ($Category) {
            $Category->Products()->save(factory(App\Product::class)->make());
        });
        // $user = \App\User::create([
        //     'first_name'=> 'super',
        //     'last_name'=> 'admin',
        //     'email' => 'super_admin@mail.com',
        //     //'password' => Hash::make('123456789'),

        // ]);

    }
}
