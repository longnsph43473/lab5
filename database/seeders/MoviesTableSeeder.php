<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $genres = \App\Models\Genre::pluck('id')->toArray(); // Lấy tất cả ID của genres để gán cho phim

        foreach (range(1, 50) as $index) {
            DB::table('movies')->insert([
                'title' => $faker->sentence,
                'poster' => $faker->optional()->image('public/storage/posters', 640, 480, null, false),
                'intro' => $faker->paragraph,
                'release_date' => $faker->date,
                'genre_id' => $faker->randomElement($genres),
            ]);
        }
    }
}
