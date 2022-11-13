{{-- La variable errors es una variable de laravel que se compila drectamente en la vista
cuando hay algun error, y si hay algun erro mostrar un mensaje de alerte --}}
@if ( $errors-> any() )
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> El formulario contiene errores</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
 @endif
