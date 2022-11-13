<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    // Laravel tiene una convencion, el nombre de las tablas en la BD deben ser
    // en plural mientras que el nombre del modelo en singular, y como mi
    // caso el nombre de las tablas en la BD es singular, entonces debo indicarle
    // a laravel el nombre de mi table del sigute modo:
    protected $table = 'permiso';
}
