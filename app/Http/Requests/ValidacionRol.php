<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionRol extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // nos importa que sea unique porque en la tabla menu solo
        // debe haber un rol con ese nombre
        return [
            'nombre' => 'required|max:50|unique:rol,nombre,' . $this->route('id')
            // 'nombre' => 'required|max:50|unique:rol,nombre' . $this->route('id')
        ];
    }
}
