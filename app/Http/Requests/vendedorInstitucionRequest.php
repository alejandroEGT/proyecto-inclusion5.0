<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vendedorInstitucionRequest extends FormRequest
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
            'dia' => 'required',
            'mes' => 'required',
            'anio' => 'required',
            'id_sexo' => 'required',
            'telefono' => 'required',
            'id_area' => 'required',
            //'correo' => 'required|email|unique:users,email'
            'correo' => 'required|email|unique:users,email'
        ];
    }
}
