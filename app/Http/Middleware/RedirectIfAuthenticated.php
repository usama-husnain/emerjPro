<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\isEmpty;

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

//        foreach ($guards as $guard) {
//            if (Auth::guard($guard)->check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Ensure there's an authenticated user
                if (Auth::user()) {
                    // Check user's role and redirect accordingly
                    if (Auth::user()->hasRole('Admin')) {
                        return redirect()->route('admin.home');
                    } elseif (Auth::user()->hasRole('User')) {
                        return redirect()->route('user.home');
                    }
                }
            }


        }

        return $next($request);
    }
}
