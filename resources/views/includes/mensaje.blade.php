{{--  la variable de session mensaje fue creado con el metodo with al momento
    de retornar una respuesta desde el controlador MenuController
--}}
@if ( session('mensaje') )
    <div class="alert alert-success alert-dismissible" data-auto-dismiss="3000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Mensaje de sistema biblioteca</h4>
        <ul>
            <li>{{ session('mensaje') }}</li>
        </ul>
    </div>
@endif
