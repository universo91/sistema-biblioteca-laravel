<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seguridad\Usuario;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    /**
     * La propiedad $redirectTo lo que nos permite es configurar que va a pasar una vez
     * que se haga login, para el caso una vez que se haga login lo redireccionaremos
     * a la raiz
     */
    protected $redirectTo = '/';

    public function __construct() {
        /**
         * Quienes podran acceder a todo este controlador seran los usarios que sean
         * guest(invitados) es decir no logueados, excepto la ruta logout o metodo logout
         */
        $this->middleware('guest')->except('logout');
    }

    /** @override de username: esta funcion es parte de AuthenticatesUsers, esta fucion retorna "email"
     * y lo usa para el login, pero nosotros usaremos "usuario" para el logeo, por tanto, lo que
     * hacemos es sobreescribir ese metodo y retornar "usuario" y de esa forma lo adapatamos a nuestra
     * necesidad, sin cambiar la implementacion original de AuthenticatesUsers, como si se tratatese de
     * un override en java
     */
    public  function username()
    {
        return 'usuario';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seguridad.index');
    }
    /**
     * @param $user es una instancia implicita del modelo Usuario
     */
    protected function authenticated(Request $request, Usuario $user) {
        /** Si el usuario que se logea tiene un rol activo, entonces dejamos que ingrese al sistema */
        $roles = $user->roles()->where('estado', 1)->get();
        if( $roles->isNotEmpty() ) {
            /** Si roles es diferente de vacio entonces  */
            $user->setSession( $roles->toArray() );
        } else {
            /** Pero si el usuario no tiene un rol activo simplemente, no permitimos que ingrese al sistema
             * y le enviamos a login
             */
            $this->guard()->logOut();
            $request->session()->invalidate();
            return redirect('seguridad/login')->withErrors(['error' => 'Este usuario no tiene un rol acivo']);
        }
    }
}
