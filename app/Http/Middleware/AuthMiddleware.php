<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    $response = Http::withToken(request()->bearerToken())
            ->accept('application/json')
            ->get(env('AUTH_DOMAIN').'user');

        if($response->status() != 200){
            return response()->json([
                "data"=>json_decode($response->body()),
            ],$response->status());    }

        $user = json_decode($response->body())->user;

        $request->request->add(['user_id' => $user->id, 'fullname' => $user->fullname]);
        return $next($request);
    }
}
