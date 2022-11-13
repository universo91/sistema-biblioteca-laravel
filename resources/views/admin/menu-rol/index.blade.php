@extends("theme.$theme.layout")

@section('titulo')
    Menu - Rol
@endsection

@section('scripts')
<script src="{{ asset("assets/pages/scripts/admin/menu-rol/index.js") }}" type="text/javascript"></script>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.mensaje')
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Menus - Rol
                    </h3>
                </div>
                <div class="box-body">
                    @csrf
                    <table class="table table-striped table-bordered table-hover" id="tabla-data">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                @foreach ( $rols as $key => $nombre)
                                    <th class="text-center">{{ $nombre }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Porque dejar pasar aquellos menus cyo menu_id es diferente de cero? :
                            la rspta es porque estos

                            $menus es un array de array, lo que significa que
                            $menu es un array
                            --}}
                            @foreach ($menus as $key => $menu)
                                @if ( $menu['menu_id'] != 0)
                                    @break
                                @endif
                               {{--  Solo pasan los que su menu_id es igual a cero --}}
                                <tr>
                                    <td class="font-weight-bold">
                                        <i class="fa fa-arrows-alt"></i>
                                        {{ $menu['nombre'] }}
                                    </td>
                                    @foreach ($rols as $idRol => $nombre )
                                    <!-- in_array( mixed $needle , array $haystack) = Comprueba si un valor existe en un array
                                         Busca la aguja (needle) en el pajar (haystack), devuelve true si el valor se encuentra
                                         en el array, falso de lo contrario.
                                         array_column(array $input , mixed $column_key)= Devuelve los valores de una sola columna del array de entrada
                                    -->
                                        <td class="text-center">
                                            <input
                                                type="checkbox"
                                                name="menu_rol[]"
                                                class="menu_rol"
                                                data-menuid={{ $menu['id'] }}   {{-- data-menuid es un atributo personalizado --}}
                                                value="{{ $idRol }}"
                                                {{ in_array($idRol, array_column($menusRols[ $menu['id'] ], 'id')) ? "checked" : "" }}
                                            >
                                        </td>
                                    @endforeach
                                </tr>
                                @foreach ($menu["submenu"] as $key => $hijo)
                                    <tr>
                                        <td class="pl-20">
                                            <i class="fa fa-arrow-right"></i>
                                            {{ $hijo['nombre'] }}
                                        </td>
                                        @foreach ($rols as $id => $nombre)
                                            <td class="text-center">
                                                <input
                                                    type="checkbox"
                                                    name="menu_rol[]"
                                                    class="menu_rol"
                                                    data-menuid= {{ $hijo["id"] }}
                                                    value="{{ $id }}"
                                                    {{ in_array( $id, array_column( $menusRols[ $hijo["id"] ], "id")) ? "checked" : "" }}
                                                >
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach ($hijo["submenu"] as $key => $hijo_2)
                                        <tr>
                                            <td class="pl-30">
                                                <i class="fa fa-arrow-right"></i>
                                                {{ $hijo_2["nombre"] }}
                                            </td>
                                            @foreach ($rols as $id => $nombre)
                                                <td class="text-center">
                                                    <input
                                                        type="checkbox"
                                                        name="menu_rol[]"
                                                        class="menu_rol"
                                                        data-menuid= {{ $hijo_2["id"] }}
                                                        value={{ $id }}
                                                        {{ in_array( $id, array_column( $menusRols[ $hijo_2["id"] ], "id" )) ? "checked" : "" }}
                                                    >
                                                </td>
                                            @endforeach
                                        </tr>
                                        @foreach ($hijo_2["submenu"] as $key => $hijo_3 )
                                            <tr>
                                                <td class="pl-40">
                                                    <i class="fa fa-arrow-right"></i>
                                                    {{ $hijo_3["nombre"] }}
                                                </td>
                                                @foreach ($rols as $id => $nombre)
                                                    <td class="text-center">
                                                        <input
                                                            type="checkbox"
                                                            name="menu_rol[]"
                                                            class="menu_rol"
                                                            data-menuid={{ $hijo_3["id"] }}
                                                            value={{ $id }}
                                                            {{ in_array( $id, array_column( $menuRols[ $hijo_3["id"] ], "id" )) ? "checked" : "" }}
                                                        >
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection



