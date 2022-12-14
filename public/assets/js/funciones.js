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
                         * El m??todo attr () establece o devuelve atributos y valores de los elementos
                         * seleccionados.
                         * Cuando se utiliza este m??todo para devolver el valor del atributo, devuelve
                         * el valor del PRIMER elemento coincidente.
                         * Cuando este m??todo se utiliza para establecer valores de atributo, establece
                         * uno o m??s pares de atributo / valor para el conjunto de elementos
                         * coincidentes.
                         *
                         */
                    } else if (element.attr('data-error-container') ) {
                        /**
                         * El m??todo appendTo () inserta elementos HTML al final de los elementos
                         * seleccionados.
                         * $(content).appendTo(selector)
                         * content: Especifica el contenido a insertar (debe contener etiquetas HTML).
                         * Nota -> Si el contenido es un elemento existente, se mover?? de su posici??n actual y se insertar?? al final de los elementos seleccionados.
                         * selector: Obligatorio. Especifica en qu?? elementos se va a a??adir el contenido
                         * El m??todo appendTo () inserta elementos HTML al final de los elementos
                         * seleccionados.
                         * */
                        error.appendTo(element.attr('data-error-container'))
                    } else {
                        // default placement for everithing else
                        /**
                         * $(content).insertAfter(selector)
                         * El m??todo insertAfter () inserta elementos HTML despu??s de los elementos seleccionados.                         *
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
                // habilitando un bot??n de cierre
                closeButton: true,
                // con el valor true nos mostrara las alertas en la parte superior
                newestOnTop: true,
                
                positionClass: 'toast-top-right',
                // En lugar de tener una pila de tostadas id??ntica, establezca la 
                // propiedad preventDuplicates en true.
                preventDuplicates: true,
                // Cu??nto tiempo se mostrar?? el brindis sin la interacci??n del usuario
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
