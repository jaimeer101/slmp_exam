<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');
        if ($response->successful()) {
            $todos = $response->json();
            foreach ($todos as $todo) {
                $todoData = [
                    "users_id" => $todo["userId"], 
                    "title" => $todo["title"], 
                    "completed" => $todo["completed"], 
                ];
                Todo::create($todoData);
            }
        }
    }
}
