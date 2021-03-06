<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUsuarioRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombres' => 'required | string',
            'apellidos' => 'required',
            /*'dia' => 'required | numeric',
            'mes' => 'required | numeric',
            'anio' => 'required | numeric',*/
            'fecha' => 'date | required',
            'id_sexo' => 'required',
            'telefono' => 'required | numeric ', 
            'correo' => 'required | email | unique:users,email',
            'clave' => 'required | min:6 | max:16',
            'rClave' => 'required | min:6 | max:16 | same:clave',   
        ];
     }

    public function messages() {

            return [
                'nombres.required' => 'No puedes dejar vacio el campo nombres',
                'nombres.string' => 'Solo puedes ingresar letras en el campo nombres',
                'apellidos.required' => 'No puedes dejar vacio el campo apellidos',
                'dia.required' => 'No puedes dejar vacio el campo dia',
                'mes.required' => 'No puedes dejar vacio el campo mes',
                'anio.required' => 'No puedes dejar vacio el campo año',
                'dia.numeric' => 'Solo puedes ingresar numeros en el campo dia',
                'mes.numeric' => 'Solo puedes ingresar numeros en el campo mes',
                'anio.numeric' => 'Solo puedes ingresar numeros en el campo año',
                'id_sexo.required' => 'Debes seleccion una opcion del campo sexo',
                'telefono.required' => 'No puedes dejar vacio el campo telefono',
                'telefono.numeric' => 'Solo puedes ingresar numeros en el campo telefono',
                'correo.required' => 'No puedes dejar vacio el campo correo',
                'correo.email' => 'Debes ingresar un formato de correo valido',
                'correo.unique' => 'El correo ingresado ya existe en la base de datos',
                'clave.required' => 'No puedes dejar vacio el campo clave',
                'clave.min' => 'La contraseña debe tener un minimo de 6 caracteres',
                'rClave.required' => 'No puedes dejar vacio el campo Repita Clave',
                'rClave.min' => 'La contraseña debe tener un minimo de 6 caracteres',
                'rClave.max' => 'El campo repetir contraseña debe tener un maximo de 16 caracteres',
                'clave.max' => 'La contraseña debe tener un maximo de 16 caracteres',
                'rClave.same' => 'Las contraseñas no coinciden',
                'fecha.required' => 'El campo fecha de nacimiento es necesario',
                'fecha.date' => 'El campo fecha de nacimiento tiene formato invalido'

 
            ]; 
        }
} 
