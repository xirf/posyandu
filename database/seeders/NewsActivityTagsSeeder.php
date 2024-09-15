<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsActivityTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Quill delta formatted content
        $quildDelta = [
            'ops' => [
                ['insert' => 'Gandalf', 'attributes' => ['bold' => true]],
                ['insert' => ' the '],
                ['insert' => 'Grey', 'attributes' => ['color' => '#cccccc']]
            ]
        ];

        // Create sample tags
        $tags = ['Technology', 'Health', 'Sports', 'Education', 'Entertainment'];
        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create sample news
        for ($i = 1; $i <= 5; $i++) {
            DB::table('news')->insert([
                'title' => "News Title $i",
                'slug' => Str::slug("News Title $i"),
                'thumbnail' => "thumbnail$i.jpg",
                'content' => json_encode($quildDelta),
                'user_id' => $faker->numberBetween(1, 2),
                'published_at' => now(),
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create sample activities
        for ($i = 1; $i <= 5; $i++) {
            DB::table('activities')->insert([
                'title' => "Activity Title $i",
                'slug' => Str::slug("Activity Title $i"),
                'thumbnail' => "thumbnail$i.jpg",
                'content' => json_encode($quildDelta),
                'user_id' => $faker->numberBetween(1, 2),
                'published_at' => now(),
                'status' => 'published',
                'medias' => json_encode([['type' => 'image', 'description' => 'Image description', 'url' => 'https://picsum.photos/200/300.webp']]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Attach tags to news
        $newsIds = DB::table('news')->pluck('id');
        $tagIds = DB::table('tags')->pluck('id');
        foreach ($newsIds as $newsId) {
            DB::table('news_tags')->insert([
                'news_id' => $newsId,
                'tag_id' => $tagIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Attach tags to activities
        $activityIds = DB::table('activities')->pluck('id');
        foreach ($activityIds as $activityId) {
            DB::table('activity_tags')->insert([
                'activity_id' => $activityId,
                'tag_id' => $tagIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}