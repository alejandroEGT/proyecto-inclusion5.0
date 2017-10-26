<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reset_password extends Model
{
    protected $table = "password_resets"; 
    public $timestamps = false;

    protected function insertar($dato, $token)
    {
    	$get = reset_password::where('email', $dato->correo)->first();
    	$insert = new reset_password;
    	//dd($get->count()>0);
    	if ($get == true) {
    		
    			$update = \DB::table('password_resets')
    			          ->where('email', $dato->correo)
    					  ->update(['token' => $token]);
    			if($update == true){
    				return true;
    			}		  
    			return false;
    	}

    	$insert->email = $dato->correo;
    	$insert->token = $token;
    	if ($insert->save()) {
    		 return true;
    	}
    	return false;
    }
}
