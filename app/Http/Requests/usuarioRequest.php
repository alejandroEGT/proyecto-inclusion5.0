<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class usuarioRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombres' => 'required | max:50',
            'apellidos' => 'required | max:50',
            'correo' => 'required | unique:users,email',
            'telefono' => 'required|min:11|numeric',
            'id_sexo' => 'required',
        ];
    }
}
