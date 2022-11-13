document.addEventListener("DOMContentLoaded", function () {
    // Cerrar las alertas automaticamente

    $('.alert[data-auto-dismiss]').each(function(index, element) {

        const $element = $(element);
        const timeout = $element.data('auto-dismiss') || 5000;

        setTimeout( function () {
            $element.alert('close');
        }, timeout);
    });

    //TOOLTIPS
    $('body').tooltip({
        // trigger: desencadenar el tooltip cuando se pase por encima del elemento
        trigger: 'hover',
        selector: '.tooltipsC',
        //placement:colocacion
        placement: 'top',
        // con html=true se podra insertar html, si fuero false solo dejaria text
        html: true,
        // con container= body nos permite colocar informacion en el flujo del
        // documento cerca del elemento de activacion
        container: 'body'
    });

    $('ul.sidebar-menu').find('li.active').parents('li').addClass('active');
});
