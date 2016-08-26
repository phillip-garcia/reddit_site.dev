<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->command->info('Deleted posts records');
        DB::table('posts')->delete();
        $this->command->info('Deleted users records');
        DB::table('users')->delete();
        $this->call(UserTableSeeder::class);
        $this->call(PostsTableSeeder::class);

        Model::reguard();
    }
}
