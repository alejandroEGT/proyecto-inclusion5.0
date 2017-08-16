<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class areaController extends Controller
{
    public function vista_area(Request $dato)
    {
    	return "hola mundito lindo i querido : $dato->id";
    }
}
