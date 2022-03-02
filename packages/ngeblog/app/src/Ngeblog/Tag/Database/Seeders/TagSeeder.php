<?php

namespace Ngeblog\Tag\Database\Seeders;

use Illuminate\Database\Seeder;
use Lara\Tag\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory(100)->create();

        $posts = \Ngeblog\Post\Models\Post::all();

        $posts->each(function ($post) {

            $numberTag = rand(3, 17);

            Tag::all()->random($numberTag)->each(function($tag) use(&$post) {
                $post->tags()->attach($tag);
            });
        });
    }
}
