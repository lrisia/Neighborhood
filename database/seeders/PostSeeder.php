<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->command->line("Generating Organization for all posts");
//        $posts = Post::get();
//        $posts->each(function($post, $key) {
//            $organization_id = Organization::inRandomOrder()->get('id');
//            $post->organization = $organization_id;
//        });

        $this->command->line("Generating 500 posts");
        Post::factory(500)->create();
    }
}
