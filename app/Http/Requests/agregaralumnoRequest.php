<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class agregaralumnoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
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
            'telefono' => 'required | numeric ',
            'id_area' => 'required',    
            'correo' => 'required | email | unique:users,email'
        ];
    }
}
