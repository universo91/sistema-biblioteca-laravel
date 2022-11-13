window.onload = function () {

    $('#tabla-data').on('submit', '.form-eliminar', function (event) {
        event.preventDefault();
        // $(this) hace referencia al formulario con clase .form-eliminar
        const form = $(this);
        swal({
            title: '¿ Está seguro que desea eliminar el registro ?',
            text: 'Esta acción no se pude deshacer',
            icon: 'warning',
            buttons: {
                cancel: "Cancelar",
                confirm: "Aceptar"
            }
        }).then( result => {
            if ( result ) {
                ajaxRequest( form );
            }
        });

    });

    function ajaxRequest( form ) {
        $.ajax({
            // Coge el valor del atributo action del form que tiene como clase form-eliminar.
            url: form.attr('action'),
            type: 'DELETE', // || type: 'POST'
            /**
                La función serialize de jquery nos sirve para serializar los elementos que se
                encuentra dentro de un formulario en específico, es decir, al aplicar la función
                 obtenemos los elementos preparados para una petición al backend
             */
            data: form.serialize(),
            success: function (respuesta ) {
                if( respuesta.mensaje == 'ok' ) {
                    //borra la fila o registro de la tabla en la vista
                    form.parents('tr').remove();
                    //Biblioteca.notificaciones(mensaje, titulo, tipo)
                    Biblioteca.notificaciones('El registro fue eliminado correctamente', 'Biblioteca', 'success');
                } else {
                    Biblioteca.notificaciones('El regitro no pude ser eliminado, hay recursos utilizandolo', 'Biblioteca', 'error');
                }
            },
            error: function () {

            }
        });
    }

}
