@extends("theme.$theme.layout")

@section("titulo")
    Menu
@endsection

@section('styles')
    <link href="{{ asset("assets/js/jquery-nestable/jquery.nestable.css") }}" rel="stylesheet" type="text/css">
@endsection

@section('scriptsPlugins')
    <script src="{{ asset("assets/js/jquery-nestable/jquery.nestable.js") }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset("assets/pages/scripts/admin/menu/index.js") }}" type="text/javascript"></script>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.mensaje')
            <div class="box box-sucess">
                <div class="box-header with-border">
                    <h3 class="box-title">Menús</h3>
                </div>
                <div class="box-body">
                    @csrf
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach ($menus as $key => $item )
                            <!--
                                Primero hay que tomar en cuenta que la variable $menus es una array, que tiene integrado
                                toda la estructura de nuestros menus y submenus.
                                Es decir aquellos items que son parte del sub_menu de otro items, se encuentran anexados
                                dentro de un una propiedad llamada submenu de tipo array.
                                Si el menu_id del item es diferente de cero eso significa que este item es parte del
                                submenu de otro item, y debe dar salto al siguiente item, puesto que solo pasaran aquellos
                                que tienen menu_id == 0 ya que estos son los padres y a partir de ellos se desencadenan los
                                los demas elementos -->
                                @if ( $item['menu_id'] != 0)
                                    @break
                                @endif
                                @include("admin.menu.menu-item", ["item" => $item])
                            @endforeach

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
