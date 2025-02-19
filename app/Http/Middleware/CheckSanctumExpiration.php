<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckSanctumExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->bearerToken()) {
            $token = PersonalAccessToken::findToken($request->bearerToken());

            if ($token) {
                $expirationTime = (int) config('sanctum.inactivity_expiration', 10);

                // Evitar errores si last_used_at es null
                $lastUsed = $token->last_used_at ? Carbon::parse($token->last_used_at) : now();
                $expiresAt = $lastUsed->copy()->addMinutes($expirationTime);

                if ($expiresAt->isPast()) {
                    return response()->json(['message' => 'Token expirado en el check'], 401);
                }

                // Actualizar last_used_at solo si es necesario
                if (!$token->last_used_at || $token->last_used_at < now()->subMinutes($expirationTime)) {
                    $token->update(['last_used_at' => now()]);
                }
            }

        }

        return $next($request);
    }
}
