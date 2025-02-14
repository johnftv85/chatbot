<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app('router')->aliasMiddleware('check.sanctum.expiration', function ($request, $next) {
            if ($request->bearerToken()) {
                $token = PersonalAccessToken::findToken($request->bearerToken());

                if ($token) {
                    $lastUsed = Carbon::parse($token->last_used_at);
                    $expirationTime = (int) config('sanctum.inactivity_expiration', 10);
                    $expiresAt = $lastUsed->copy()->addMinutes($expirationTime);

                    if ($expiresAt->isPast()) {
                        return response()->json(['message' => 'Token expirado'], 401);
                    }

                    $token->forceFill(['last_used_at' => now()])->save();
                }
            }

            return $next($request);
        });
    }
}
