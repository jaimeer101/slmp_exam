<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateUserToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user-token {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $userId = $this->argument("user");
        $user = User::find($userId);

        if (! $user) {
            $this->error("User with id {$userId} does not exist.");
            return "User with id {$userId} does not exist.";
        }

        // Create Sanctum token
        $token = $user->createToken('api-token')->plainTextToken;

        $this->info("Token generated successfully:");
        $this->line($token);

        return $token;

    }
}
