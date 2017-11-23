<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userloginRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'correo' => 'required',
            'clave' => 'required'
        ];
    }
}
