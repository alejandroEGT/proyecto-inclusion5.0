<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class agregarAlumnoDesdeAreaRequest extends FormRequest
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
            'dia' => 'required',
            'mes' => 'required',
            'anio' => 'required',
            'id_sexo' => 'required',
            'telefono' => 'required|min:11|numeric',
            'correo' => 'required | email | unique:users,email'
        ];
    }

    public function messages(){

        return [
                'nombres.required' => 'No puedes dejar vacio el campo nombres',
                'apellidos.required' => 'No puedes dejar vacio el campo apellidos',

                'dia.required' => 'No puedes dejar vacio el campo dia',
                'mes.required' => 'No puedes dejar vacio el campo mes',
                'anio.required' => 'No puedes dejar vacio el campo año',
                'dia.numeric' => 'Solo puedes ingresar numeros en el campo dia',
                'mes.numeric' => 'Solo puedes ingresar numeros en el campo mes',
                'anio.numeric' => 'Solo puedes ingresar numeros en el campo año',
                'id_sexo.required' => ' Debes seleccion una opcion del campo sexo',

                'telefono.required' => 'No puedes dejar vacio el campo telefono',
                'telefono.numeric' => 'Solo puedes ingresar numeros en el campo telefono',

                'correo.required' => 'No puedes dejar vacio el campo correo',
                'correo.email' => 'Debes ingresar un formato de correo valido',
                'correo.unique' => 'El correo ingresado ya existe en la base de datos',
        ];
    }
}
