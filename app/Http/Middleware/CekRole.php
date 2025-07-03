<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        /** @var User|null $user */
        $user = auth()->user();

        if (!$user || $user->role !== $role) {
            abort(403, 'ANDA TIDAK PUNYA AKSES.');
        }

        return $next($request);
    }
}
