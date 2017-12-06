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
            'rut' => 'required | numeric | unique:institucion,rut,'. $this->rut,
            'nombre' => 'required | max:50',
            'razonSocial' => 'required | max:100',
            'telefono1' => 'required|min:11|numeric',
            'telefono2' => 'required|min:11|numeric',
            'direccion' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg | dimensions:max_width=2250,max_height=2680',
            'correo' => 'required | email | max:80 | unique:institucion,email,'. $this->correo,
            'clave' => 'required | min:6',
            'repeClave' => 'required | min:6 | same:clave',
        ];
    }

    public function messages() {


        return [

                'rut.max' => 'Ingrese un maximo de 9 numeros en el rut',
                'rut.required'=>'No puedes dejar vacio el campo rut',
                'rut.numeric' => 'Solo puedes ingresar numeros en el campo rut',
                'rut.unique' => 'El rut ingresado ya existe en la base de datos',

                'nombre.required' => 'No puedes dejar vacio el campo nombre',
                'nombre.unique' => 'La institucion ingresada ya existe en la base de datos',

                'razonSocial.required' => 'No puedes dejar vacio el campo razon social',               
                'telefono1.required' => 'No puedes dejar vacio el campo telefono 1',
                'telefono1.min' => 'Ingrese un minimo de 11 numeros',
                'telefono1.numeric' => 'Solo puedes ingresar numeros en el campo telefono 1',

                'telefono2.required' => 'No puedes dejar vacio el campo telefono 2',
                'telefono2.min' => 'Ingrese un minimo de 11 numeros',
                'telefono2.numeric' => 'Solo puedes ingresar numeros en el campo telefono 2',

                'logo.required' => 'No puedes dejar vacio el campo logo',
                'logo.image' => 'Debes ingresar una imagen',

                'correo.required' => 'No puedes dejar vacio el campo correo',
                'correo.email' => 'Debes ingresar un formato de correo valido',
                'correo.unique' => 'El correo ingresado ya existe en la base de datos',

                'clave.required' => 'No puedes dejar vacio el campo clave',
                'clave.min' => 'La contraseña debe tener un minimo de 6 caracteres',
                'repeClave.required' => 'No puedes dejar vacio el campo Repita Clave',
                'repeClave.min' => 'La contraseña debe tener un minimo de 6 caracteres',
                'repeClave.same' => 'Las contraseñas no son iguales'
             ];
        
    }
}
