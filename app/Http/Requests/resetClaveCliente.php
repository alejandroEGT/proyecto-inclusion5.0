<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class resetClaveCliente extends FormRequest
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
        return [
            'correo' => 'required | max:80 |email | exists:users,email',
            'codigo' =>'required | max:13',
            'clave' =>'required | max:50 | min:6',
            'rclave' =>'required |max:50 | min:6 | same:clave'
        ];
    }
    public function messages() {

            return [
                
                'clave.required' => 'No puedes dejar vacio el campo contraseña',
                'clave.min' => 'La contraseña debe tener un minimo de 6 caracteres',
                'rclave.required' => 'No puedes dejar vacio el campo repetir contraseña',
                'rclave.min' => 'La contraseña debe tener un minimo de 6 caracteres',
                'rclave.max' => 'El campo repetir contraseña debe tener un maximo de 16 caracteres',
                'clave.max' => 'La contraseña debe tener un maximo de 16 caracteres',
                'rclave.same' => 'Las contraseñas no coinciden',
              
             ]; 
        }
}
