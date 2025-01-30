<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AuthorizedIp;

class ValidateIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        $authorizedIps = cache()->remember('authorized_ips', 3600, function () {
            return AuthorizedIp::pluck('ip_address')->toArray(); // Obtén todas las IPs autorizadas
        });

        // Verificar si la IP está autorizada
        if (!in_array($ip, $authorizedIps)) {
            return response()->json([
                'status' => 'error',
                'message' => 'IP no autorizada para realizar esta petición.'
            ], 403);
        }
        return $next($request);
    }
}
