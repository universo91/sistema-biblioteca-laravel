window.onload = function () {
    Biblioteca.validacionGeneral('form-general');
    /**
     * El evento blur es para cuando el elemento #icono pierde el foco, removemos
     * la clases del elemento #mostar-icono y le agregamos la clase " fa fa-fw"
     * mas lo que se haya escrito en el input del elemento #icono que no es mas que
     * la identificacion de un icono
     */
    $('#icono').on('blur', function() {
        $('#mostrar-icono').removeClass().addClass('fa fa-fw ' + $(this).val() );
    });
}
