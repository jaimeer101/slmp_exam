<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http as FacadesHttp;
use League\Uri\Http;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = FacadesHttp::get('https://jsonplaceholder.typicode.com/comments');
        if ($response->successful()) {
            $comments = $response->json();
            foreach ($comments as $comment) {
                $commentsData = [
                    "posts_id" => $comment["postId"], 
                    "name" => $comment["name"], 
                    "email" => $comment["email"], 
                    "body" => $comment["body"], 
                ];
                Comment::create($commentsData);
            }
        }
    }
}
