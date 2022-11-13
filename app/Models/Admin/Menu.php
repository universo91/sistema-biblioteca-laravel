<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    /**
     * Todos los modelos protegen contra la asignacion masiva de forma predeterminada.
     * La asinacion masiva .
     * La asignación masiva es cuando envía una matriz a la creación del modelo,
     * básicamente configurando un grupo de campos en el modelo de una sola vez,
     * en lugar de uno por uno, algo así como:
     * $user = new User(request()->all());
     * Fillable me permite especificar que campos son asignables en masa en el modelo
     *
     */
    protected $fillable = ['nombre', 'url', 'icono'];
    /**
     * guarded especifica que campos no son asignables en masa, en este caso
     * no quiero que el id sea modificado.
     */
    protected $guarded = ['id'];
    /**
     * Por defecto eloquent espera que las columnas created_at y updated_at existan
     * en las tablas. Como no quiero que eloquent administre de forma automatica
     * esta columnas, entonces configuro la propiedad timestamps del este modelo
     * en false
     */
    public $timestamps = false;

    public function roles() {
        /**
         * Estamos indicando que Menu se relaciona con Roles a traves de la tabla menu_rol
         * belongsToMany nos indica una relacion de muchos a muchos
         * Ahora podemos decirle a eloquent que nos llame a los menus con sus respectivos roles.
         * Lo que va a pasar es que Menus va hacer una consulta directamente a menu_rol, pero
         * se va a relacionar a Rol::class.
         * Algo importante por aclarar es que 'menu_rol' se debe colocar necesariamente, porque
         * en realidad este argumento es opcional, pero en este caso sino lo pusieramos
         * laravel sigue unas conveciones y buscaria un nombre de esa tabla en plural algo asi
         * 'menu_roles' y como no tenemos esa tabla se produciria un error.
         */
        return $this->belongsToMany(Rol::class, 'menu_rol');
    }

    /**
     * @param array $padres es un parametro de tipo arreglo que contiene todos los registros de la
     * tabla menu
     * @param array $line biene a ser un registro especifico del conjunto de registros del arreglo
     * $padre
     * @return array $children, retorna el conjunto de aquellos registros dentro del array $padres cuyas
     * referencias coincidan con el id del @param $line, lo que significa que son sub_menus del registro $line
     */
    public function getHijos($padres, $line) {
        $children = [];
        foreach( $padres as $line1) {
            if( $line['id'] == $line1['menu_id'] ) {
                $children = array_merge( $children, [array_merge( $line1, ['submenu' => $this->getHijos($padres, $line1)])]);
            }
        }
        return $children;
    }

    public function getPadres($front) {
        if ($front) {
            /**
             * whereHas()
             * El principio del método whereHas() es básicamente el mismo que el método has(),
             * pero le permite agregar condiciones de filtrado para este modelo.
             */
            return $this->whereHas('roles', function ($query) {
                $query->where('rol_id', session()->get('rol_id'))->orderby('menu_id');
            })  -> orderby('menu_id')
                -> orderby('orden')
                -> get()
                -> toArray();
        } else {
            return $this -> orderby('menu_id')
                         -> orderby('orden')
                         -> get()
                         -> toArray();
            /**
             * Es importante saber que con get obtenemos una cantidad inmensa de informacion
             * mas alla de que solo nos retorne los registros de la tabla, pero al aplicarle
             * la coleccion toArray solo nos retorna concretamente los registros de la tabla
             * en formato de array.
             */
        }
    }

    public static function getMenu( $front = false ) {
        // menus simepre tendra una estructura parecida a esta
        // $json = '[{"id":5},{"id":3,"children":[{"id":4,"children":[{"id":6}]}]}]';
        // print_r(json_decode($json) );
        $menus = new Menu();
        $padres = $menus -> getPadres($front);

        //dd($padres);
        $menuAll = [];
        foreach( $padres as $line ) {
            /**
             * si el menu_id es != de cero significa que ya no es un padre, es un hijo,
             * y rompemos el foreach
             *  */
            if( $line['menu_id'] != 0 ) {
                break;
            }
            $item = [ array_merge($line, ['submenu' => $menus->getHijos($padres, $line )])];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }

    public function guardarOrden($menu) {
        /**
         * La función json_decode (strinng, assoc) se utiliza para decodificar o convertir un objeto
         * JSON en un objeto PHP.
         * assoc: Opcional. Especifica un valor booleano. Cuando se establece en verdadero, el
         * objeto devuelto se convertirá en una matriz asociativa. Cuando se establece en falso,
         *  devuelve un objeto. Falso es predeterminado
         */

        $menus = json_decode( $menu);
        //dd($menus);
        foreach( $menus as $key => $value) {
            $this->where('id', $value->id )->update(['menu_id' => 0, 'orden' => $key + 1 ]);
            // para el primer nivel
            if( ! empty($value->children) ) {
                foreach($value->children as $key => $vchild ) {
                    $update_id = $vchild->id;
                    $parent_id = $value->id;
                    $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden'=> $key + 1 ]);
                    // Para el segundo nivel
                    if( ! empty($vchild->children) ) {
                        foreach($vchild->children as $key => $vchild_1) {
                            $update_id = $vchild_1->id;
                            $parent_id = $vchild->id;
                            $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden' => $key + 1 ]);
                            //Para el tercer nivel
                            if( ! empty($vchild_1->children) ) {
                                foreach($vchild_1->children as $key => $vchild_2) {
                                    $update_id = $vchild_2->id;
                                    $parent_id = $vchild_1->id;
                                    $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden' => $key + 1 ]);
                                    // Para el cuarto nivel
                                    if( ! empty($vchild_2->children) ) {
                                        foreach($vchild_2->children as $key => $vchild_3) {
                                            $update_id = $vchild_3->id;
                                            $parent_id = $vchild_2->id;
                                            $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden' => $key + 1]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
