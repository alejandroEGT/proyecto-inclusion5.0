<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productoInstiRequest extends FormRequest
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
            'nombre' => 'required|max:50 | min:3',
            'descripcion' => 'required | max:191 | min:3',
            'foto' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',
            'valor' => 'required| numeric | min:10',
            'categoria' => 'required',
            'cantidad' => 'required | numeric | min:1',
            'area' => 'required',
        ];
    }

    public function messages()
    {
        return [


        ];
    }
}
