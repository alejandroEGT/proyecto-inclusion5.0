<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class agregaralumnoRequest extends FormRequest
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
            'nombres' => 'required',
            'apellidos' => 'required',
            'dia' => 'required | numeric',
            'mes' => 'required | numeric',
            'anio' => 'required | numeric',
            'id_sexo' => 'required',
            'telefono' => 'required|min:11|numeric',
            //'id_area' => 'required',    
            'correo' => 'required | email | unique:users,email'
        ];
    }
}
