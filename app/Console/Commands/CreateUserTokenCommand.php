<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateUserTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create token for each users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user){
            $token = $user->createToken('api-token')->plainTextToken;
        }
        Log::info("successful creations for each users");
    }
}
