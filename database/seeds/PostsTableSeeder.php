<?php

use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 10) as $i) {
            $post = new App\Post();
            $post->title = $faker->words(5, true); ;
            $post->url = $faker->url;
            $post->content = $faker->sentence();
            $post->created_by = User::all()->random()->id;
            $post->save();
        }
    }
}
