$('.menu_rol').on('change', function() {
    let data = {
        menu_id: $(this).data('menuid'),
        rol_id: $(this).val(),
        _token: $('input[name=_token]').val()
    };

    const checked = $(this).is(':checked');

    if ( checked )  {
        data.estado = 1
    } else {
        data.estado = 0
    }
    ajaxRequest('/admin/menu-rol/', data );
});

/* const ajaxRequest =  (url, data) => {
    fetch(url, {
        method: 'POST',
        body: data,
        headers: {
            'Content-Type': 'application/json'
        }
    }).then( res => Biblioteca.notificaciones('El rol se asigno correctamente', 'Biblioteca', 'success'));
} */
function ajaxRequest (url, data)  {

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (respuesta) {
            Biblioteca.notificaciones(respuesta.respuesta , 'Biblioteca', 'success');
        }
    });
}


