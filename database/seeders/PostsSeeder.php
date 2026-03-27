<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        if ($response->successful()) {
            $posts = $response->json();
            foreach ($posts as $post) {
                $postData = [
                    "users_id" => $post["userId"], 
                    "title" => $post["title"], 
                    "body" => $post["body"], 
                ];
                Post::create($postData);
            }
        }
    }
}
