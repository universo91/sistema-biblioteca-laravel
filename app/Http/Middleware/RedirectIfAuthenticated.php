<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Este middleware lo ejecuta automaticamente laravel
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /**
         * Si el usuario esta autenticado entonces lo redirecciona al home, pero li diremos
         * que nos redireccione a la raiz
         */
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        // De lo contrario ejecuta esta next
        return $next($request);
    }
}
