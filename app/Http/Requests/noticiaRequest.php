<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class noticiaRequest extends FormRequest
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
            'titulo' => 'required',
            'texto' => 'required',
            'estado' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg | dimensions:max_width=2250,max_height=2680'
        ];
    }

    public function messages()
    {
       return [
          
       ];
    }
}
