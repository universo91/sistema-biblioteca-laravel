<!-- Si la propiedad submenu del item es un array vacio significa que este es un menu padre
si submenus-->
@if( $item['submenu'] == [] )

    <li class="dd-item dd3-item" data-id="{{ $item["id"] }}">
        <div class="dd-handle dd3-handle"></div>
        <!-- Cuando es padre la url es javascript, en lugar de javascript:; podria ponerse #, es
        otra aleternativa -->
        <div class="dd3-content {{ $item["url"] == "javascript:;" ? "font-weight-bold" : "" }}">
            <a href="{{ url("admin/menu/" . $item["id"] . "/editar") }}">
                {{ $item["nombre"] . " | Url -> " . $item["url"] }} Icon ->
                <i style="font-size:20px;" class="fa fa-fw {{ isset( $item["icono"] ) ? $item["icono"] : "" }}"></i>
            </a>
        </div>
    </li>

    @else

    <!-- pero si la propiedad submenu de item es un array no vacio significa que este tiene submenu
    y se prosigue a renderizarlo de forma que se visualice el menu principal y su submenu -->
    <li class="dd-item dd3-item" data-id="{{ $item["id"] }}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content {{ $item["url"] == "#" ? "font-weight-bold" : ""}} ">
            <a href="{{ url("admin/menu/" . $item["id"] . "/editar") }}">
                {{ $item["nombre"] . " | Url -> " . $item["url"] }} Icon ->
                <i style="font-size:20px;" class="fa fa-fw {{ isset( $item["icono"] ) ? $item["icono"] : "" }} "></i>
            </a>
        </div>
        <ol class="dd-list">
            @foreach ( $item["submenu"] as $submenu )
                @include('admin.menu.menu-item', ["item" => $submenu ])
            @endforeach
        </ol>
    </li>
@endif

