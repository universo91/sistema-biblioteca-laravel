<?php

/**
 * Le inidicamos a laravel que mediante composer.json, dentro de autload cargue el archivo
 * biblioteca.php para que pueda estar diponible en toda nuestra aplicacion.
 */
if ( ! function_exists('getMenuActivo') ) {

    function getMenuActivo( $ruta ) {

        if( request()->is($ruta) || request()->is($ruta . '/*') ) {
            return 'active';
        } else {
            return '';
        }
    }
}
