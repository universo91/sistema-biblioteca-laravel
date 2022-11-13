<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Admin\Rol;

class MenuRolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * pluck(): Usamos este método cuando solo necesitamos los valores de una columna
         * determinada como un arreglo (o como un arreglo asociativo en base a otra columna,
         * como puede ser el id).
         */
        $rols = Rol::orderBy('id')->pluck('nombre', 'id')->toArray();

        $menus = Menu::getMenu();
        /**
         * menu-rol es una  tabla puente => necesitamos decirle a eloquent o laravel que esta relacion
         * entre menu y rol es muchos a muchos.
         * Con with le estamos diciendo que nos traiga los menus con sus respectivos roles
         *  */
        $menusRols = Menu::with('roles')->get()->pluck('roles','id')->toArray();
        //dd( array_column( $menusRols[7], 'id'));
        //dd( $menusRols[7][0]['id']);

        //dd( $menusRols );
        return view('admin.menu-rol.index', compact('rols', 'menus', 'menusRols') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        if ( $request -> ajax() ) {
            $menus = new Menu();
            if ( $request->input('estado') == 1 ) {
                $menus->find( $request->input('menu_id') )->roles()->attach($request->input('rol_id'));
                return response()->json( ['respuesta' => 'El rol se registro correctamente'] );
            } else {
                $menus->find( $request->input('menu_id') )->roles()->detach($request->input('rol_id'));
                return response()->json( ['respuesta' => 'El rol se elimino correctamente'] );
            }
        } else {
            abort( 404 );
        }
    }


}
