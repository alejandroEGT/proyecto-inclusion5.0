<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class servicioInstRequest extends FormRequest
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
            'nombre' => 'required | min:3 | max:50',
            'descripcion' => 'required | min:3  ',
            'categoria' => 'required',
            'area' => 'required',
            'fotoP1' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',
        ];
    }
    public function messages(){

        return [
                'fotoP1.required' => 'el campo foto es obligatorio',
                'fotoP1.mimes' => 'Formato de foto desconocido',
                'fotoP1.dimensions' => 'Dimensiones desconocidas de la foto',
                'area.required' => 'El campo área o especialidad es obligatorio, puede que no tengas áreas o especialidades registradas, debes tener registrada alguna'
        ];
    }
}
