<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
      /*   User::factory(50)->create()->each(function ($user){
                 $user->posts()->save(Post::factory()->make());
            });*/

          Comment::factory(50)->create();



    }
}
