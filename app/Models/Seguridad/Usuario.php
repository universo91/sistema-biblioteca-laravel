<?php

namespace App\Models\Seguridad;

use App\Models\Admin\Rol;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;

class Usuario extends AuthenticaTable
{
    /** como no estamos usando el remember token lo ponemos en falso */
    protected $remember_token = false;
    protected $table = 'usuario';
    protected $fillable = ['usuario', 'password', 'nombre'];
    protected $guarded = 'id';

    // Una relacion muchos a muchos entre roles y usuarios
    public function roles () {
        return $this->belongsToMany(Rol::class, 'usuario_rol');
    }

    public function setSession($roles) {
        if( count($roles) == 1 ) {
            // almacenamos los datos del usuario logeado en la session
            Session::put(
                [
                    /** $roles viene a ser los datos del usuario logeado en formato array y que
                     * al menos tiene un rol a cargo
                     */
                    'rol_id' => $roles[0]['id'],
                    'rol_nombre' => $roles[0]['nombre'],
                    // $this hace referencia al Modelo Usuario que retorna los datos
                    // del usuario logueado
                    'usuario' => $this->usuario,
                    'usuario_id' => $this->id,
                    'nombre_usuario' => $this->nombre
                ]
            );
        }
    }
}
