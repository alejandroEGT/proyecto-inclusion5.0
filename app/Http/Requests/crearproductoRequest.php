<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class crearproductoRequest extends FormRequest
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
            'nombre' => 'required|max:50',
            'descripcion' => 'required'
            'fotoP1' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=2500,max_height=2850',
            'valor' => 'required|max:20',
            'categoria' => 'required',
            'cantidad' => 'required',
        ];
    }
}
