<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/photos');
        if ($response->successful()) {
            $photos = $response->json();
            foreach ($photos as $photo) {
                $photosData = [
                    "albums_id" => $photo["albumId"], 
                    "title" => $photo["title"], 
                    "url" => $photo["url"], 
                    "thumbnail_url" => $photo["thumbnailUrl"], 
                ];
                Photo::create($photosData);
            }
        }

    }
}
