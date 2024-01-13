<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $this->redirectTo($request);
            }
        }

        return $next($request);
    }

    protected function redirectTo($request): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Cek role pengguna dan arahkan sesuai dengan role
        if (Auth::user()->idrole === 1) {
            return redirect('/berandaAdmin');
        } elseif (Auth::user()->idrole === 2) {
            return redirect('/berandaGuru');
        } elseif (Auth::user()->idrole == 3) {
            return redirect('/berandaSiswa');
        }

        // Jika pengguna tidak memiliki role yang sesuai, arahkan ke halaman default
        return redirect()->route('/');
    }
}
