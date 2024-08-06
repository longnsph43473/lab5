<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $genres = [
            'Hành động',
            'Võ thuật',
            'Kinh dị',
            'Lãng mạn',
            'Hài',
            'Khoa học viễn tưởng',
            'Phiêu lưu',
            'Gia đình',
            'Tâm lý',
            'Hoạt hình'
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
