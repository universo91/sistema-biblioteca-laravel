<?php

namespace App\Http\Requests;

use App\Rules\ValidarCampoUrl;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionMenu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * Retorna true para permitir el uso de la validacion de este Menu
         * Si planea tener lógica de autorización en otra parte de su
         * aplicación, regrese true en el método authorize :
         */
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        // definiendo las reglas de validacin para los campos del formulario de menu
        return [
            /**
             * Coloco una regla de validacion unique que recibe dos parametros: el nombre
             * de la tabla "menu" y el nombre del campo "nombre" respectivamente, y le paso
             * un tercer parametro, el "id", esto para cuendo venga en actualizacion, cuando
             * se trate de actualizacion la regla no me va a validar el campo nombre en ese
             * registro, sino en los demas registros, es decir que me permita editar un menu
             * cuyo nombre va a ser el mismo que se esta editando, pero, que no me lo va a
             * dejar poner el nombre de otros registros que ya estan creados, entonces laravel
             * ya hace todo esto simplementa pasandole el nombre de la tabla y el campo junto con
             * el id de dicho registro.
             *
             * único: tabla ,columna ,excepto ,idColumn
             *
             * Por otro lado el motodo route nos otorga el acceso a los parametros de URI
             * definidos en la ruta que se llama com el parametro {comment} en el ej sig:
             * Route::post('comment/{commnet});
             */
            'nombre' => 'required|max:50|unique:menu,nombre,' . $this->route('id'),
            'url' => ['required','max:100', new ValidarCampoUrl],
            'icono' => 'nullable|max:50'
        ];
    }

    /**
     * Ya no es necesario esta funcion para mostrar los mensajes de error, ´
     * dado que ya tenemos un paquete de mensajes en español que laravel nos proporcinara
     * de forma directa en los request.
     *  */
    /* public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido',
            'url.required' => 'EL campo url es requerido'
        ];
    } */
}
