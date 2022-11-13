window.onload = function () {
    $('#nestable').nestable().on('change', function () {
        console.log( window.JSON.stringify($('#nestable').nestable('serialize') ) );
        const data = {
            menu: window.JSON.stringify($('#nestable').nestable('serialize') ),
            /**
             * Toda peticion via ajax siempre debe llevar un token, este token lo pusimos dentro
             * de admin.menu.index.blade.php con el comando @csrf y es ese al que accedemos y retornamos
             * su valor
             */
            _token: $('input[name=_token]').val()
        };
        $.ajax({
            url: '/admin/menu/guardar-orden',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function( respuesta ) {

            }
        });
    });
    // nos muestra los menus expandidos
    $('#nestable').nestable('expandAll');
    // Nos muestra los menus achicados o no expandidos
    // $('#nestable').nestable('collapseAll');
}
