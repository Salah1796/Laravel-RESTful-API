<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
        //factory(App\User::Class,10)->create();

        factory(App\Product::Class,50)->create();
        factory(App\Review::Class,200)->create();

    }
}
