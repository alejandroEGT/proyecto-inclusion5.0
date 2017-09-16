<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class institucionRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rut' => 'max:9 | required | numeric | unique:institucion,rut',
            'nombre' => 'required | unique:institucion,nombre',
            'razonSocial' => 'required',
            'telefono1' => 'required|min:11|numeric',
            'telefono2' => 'required|min:11|numeric',
            'direccion' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg | dimensions:max_width=2250,max_height=2680',
            'correo' => 'required | email | unique:users,email',
            'clave' => 'required | min:6',
            'repeClave' => 'required | min:6 | same:clave',
        ];
    }
}
