<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            factory(App\User::class, 100)->create();
            $user2 = new App\User();
            $user2->email = 'phillip@codeup.com';
            $user2->name = 'Phillip';
            $user2->password = Hash::make('password');
            $user2->save();
        }
    }
}
