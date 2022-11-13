let Biblioteca = function () {
    return {
        // validacionGeneral( idFormulario, reglasValidacion, mensajes)
        validacionGeneral: function (id, reglas, mensajes) {
            const formulario = $('#' + id);
            formulario.validate({
                rules: reglas,
                messages: mensajes,
                errorElement: 'span',//default input error message container
                errorClass: 'help-block help-block-error', //default input error message class
                focusInvalid: false, //do not focus the last invalid input
                ignore: '', // validate all fields including form input hidden
                highlight: function (element, errorClass, validClass) { // highlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by highlight
                    $(element).closest('.form-group').removeClass('has-error');//set error to the control group
                },
                success: function (label) {
                    /**
                     * La funcion closest de jquery, sirve para seleccionar un padre de un
                     * elemento que coincida con el selector dado. Est funcion no permite
                     * ir hasta el nivel deseado ya sea por una clase, id o el nombre de
                     * la etiqueta.
                     * closest significa mas cercano
                     **/
                    label.closest('.form-group').removeClass('has-error');// set success clas to the control group
                },
                // errorPlacement significa colocacion de error
                errorPlacement: function (error, element) {
                    // para los select de bootstrap
                    if( $(element).is('select') && element.hasClass('bs-select') ) { // para los select bootstrap
                        error.insertAfter(element);
                    } else if ( $(element).is('select') && element.hasClass('select2-hidden-accessible') ) {
                        /**
                         * el metodo next(selector) obtiene el hermano inmediatamente siguiente de
                         * cada elemento en el conjunto de elementos coincidentes .
                         * resaltamos que los elementos hermanos son elementos que comparten el
                         * mismo padre
                         */
                        element.next().after(error);
                        /**
                         * El método attr () establece o devuelve atributos y valores de los elementos
                         * seleccionados.
                         * Cuando se utiliza este método para devolver el valor del atributo, devuelve
                         * el valor del PRIMER elemento coincidente.
                         * Cuando este método se utiliza para establecer valores de atributo, establece
                         * uno o más pares de atributo / valor para el conjunto de elementos
                         * coincidentes.
                         *
                         */
                    } else if (element.attr('data-error-container') ) {
                        /**
                         * El método appendTo () inserta elementos HTML al final de los elementos
                         * seleccionados.
                         * $(content).appendTo(selector)
                         * content: Especifica el contenido a insertar (debe contener etiquetas HTML).
                         * Nota -> Si el contenido es un elemento existente, se moverá de su posición actual y se insertará al final de los elementos seleccionados.
                         * selector: Obligatorio. Especifica en qué elementos se va a añadir el contenido
                         * El método appendTo () inserta elementos HTML al final de los elementos
                         * seleccionados.
                         * */
                        error.appendTo(element.attr('data-error-container'))
                    } else {
                        // default placement for everithing else
                        /**
                         * $(content).insertAfter(selector)
                         * El método insertAfter () inserta elementos HTML después de los elementos seleccionados.                         *
                         */
                        error.insertAfter( element );
                    }
                },
                invalideHandler: function (event, validator) {//display error alert on form submit

                },
                submitHandler: function (form) {
                    return true;
                }
            });
        },
        notificaciones: function (mensaje, titulo, tipo) {
            toastr.options = {
                // habilitando un botón de cierre
                closeButton: true,
                // con el valor true nos mostrara las alertas en la parte superior
                newestOnTop: true,
                
                positionClass: 'toast-top-right',
                // En lugar de tener una pila de tostadas idéntica, establezca la 
                // propiedad preventDuplicates en true.
                preventDuplicates: true,
                // Cuánto tiempo se mostrará el brindis sin la interacción del usuario
                timeOut: '5000' // 5 segundos || 5000 milisegundos
            };
            if( tipo == 'error') {
                toastr.error(mensaje, titulo);
            } else if ( tipo == 'success' ) {
                toastr.success( mensaje, titulo );
            } else if ( tipo == 'info') {
                toastr.info( mensaje, titulo );
            } else if( tipo == 'warning' ) {
                toastr.warning( mensaje, warning);
            }
        }
    }
}();
