<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionRol;
use App\Models\Admin\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rol::orderBy('id')->get();
        // compact es un helper ojito con eso
        return view('admin.rol.index', compact('data') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('admin.rol.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionRol $request)
    {
        Rol::create( $request->all() );
        return redirect('admin/rol')->with('mensaje','Rol creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listar($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Rol::findOrFail($id);
        return view('admin.rol.editar', compact('data') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionRol $request, $id)
    {
        // con findOrFail busca el id, si lo encuentra actualiza el registro, de lo contrario
        // retorna 404
        Rol::findOrFail($id)->update( $request->all() );
        return redirect('admin/rol')->with('mensaje', 'Rol actualizdo con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar( Request $request, $id)
    {
        if( $request->ajax() ) {
            if( Rol::destroy($id) ) {
                return response()->json([ 'mensaje' => 'ok' ]);
            } else {
                return response()->json([ 'mensaje' =>  'ng' ]);
            }
        }
        else {
            abort(404);
        }
    }
}
