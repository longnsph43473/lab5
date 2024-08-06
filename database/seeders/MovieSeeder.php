<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;
use Faker\Factory as Faker;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $genres = Genre::all();

        foreach (range(1, 50) as $index) {
            Movie::create([
                'title' => $faker->sentence(3),
                'poster' => $faker->optional()->image('public/storage/posters', 640, 480, null, false),
                'intro' => $faker->paragraph,
                'release_date' => $faker->date,
                'genre_id' => $genres->random()->id,
            ]);
        }
    }
}
