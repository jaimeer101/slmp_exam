<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class CheckPersonalToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        // dd($token);
        if (! $token) {
            return response()->json(['message' => 'Token missing'], 401);
        }

        // Find token in DB
        $accessToken = PersonalAccessToken::findToken($token);
        // $accessList = PersonalAccessToken::all();
        // $user = User::find(1); // or any user ID
        // $token = $user->createToken('api-token')->plainTextToken;

        // echo $token;
        // dd($accessList);
        if (! $accessToken) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        // Attach user to request
        $request->setUserResolver(function () use ($accessToken) {
            return $accessToken->tokenable;
        });

        return $next($request);

    }
}
