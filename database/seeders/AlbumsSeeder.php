<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AlbumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/albums');
        if ($response->successful()) {
            $albums = $response->json();
            foreach ($albums as $album) {
                $albumsData = [
                    "users_id" => $album["userId"], 
                    "title" => $album["title"], 
                ];
                Album::create($albumsData);
            }
        }
    }
}
