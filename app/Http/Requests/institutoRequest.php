<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class institutoRequest extends FormRequest
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
            'rut' => 'max:9 | required | numeric | unique:institucion,rut',
            'nombre' => 'required | unique:institucion,nombre',
            'razonSocial' => 'required',
            'telefono1' => 'required | numeric',
            'telefono2' => 'required | numeric',
            'direccion' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg | dimensions:max_width=2250,max_height=2680',
            'correo' => 'required',
            'clave' => 'required | min:6',
            'repeClave' => 'required | min:6',


        ];

    }
}
