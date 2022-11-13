<?php

namespace App\Http\Middleware;

use Closure;

class PermisoAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->permiso()) {
            return $next( $request );
        }
        return redirect('/')->with('mensaje', 'No tiene permisos para entrar aqui');
    }

    private function permiso() {
        return session()->get('rol_nombre') == 'administrador';
    }
}
