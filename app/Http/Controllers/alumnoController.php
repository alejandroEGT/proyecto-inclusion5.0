<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Usuarioinstitucion;
use App\VendedorInstitucion;
use App\Fotoperfil;
use App\Vendedor;
use App\Passwordcuenta;
use App\Encargado;
use App\Area;
use Illuminate\Support\Facades\Mail;

class alumnoController extends Controller
{
  public function vista_detalleAlumno_inst(request $dato)
  {
        $getId = base64_decode($dato->id);
        $area = Area::traer();
        $alumno = VendedorInstitucion::detalleAlumno($getId);

        //return $alumno;
        return view('institucion.verDetalleAlumno')
        ->with('alumno', $alumno)
        ->with('area', $area);

  }
public function vista_detalleAlumno_enc(request $dato)
{   
    $getId = base64_decode($dato->id);
    $encargado = Encargado::traerDatos();
    $alumno = VendedorInstitucion::detalleAlumno_enc($getId, $encargado[0]->id_area);
    
    return view('encargadoArea.verDetalleAlumno')->with('alumno', $alumno);
}
	public function generarClave(Request $id){

        $genclave = $this->genclave();
        $estadoPass =  \DB::table('password-cuenta')
                        ->where('id_user', $id->id)
                        ->update(['id_estado' => 1]);
                        

        $alumno = User::find($id->id);
        $correo = $alumno->email;

        $alumno->password = bcrypt($genclave);
        if ($alumno->save()) {
        	\Session::put('usuario',$alumno->nombres.' '.$alumno->apellidos);//obtener usuario y enviarlo a clave.blade.php
	        \Session::put('clave',$genclave);//obtener clave y enviarlo a clave.blade.php

	        Mail::send(['html'=>'emails.recuperaClave'],['name','al'],function ($message) use ($correo)
	        {
	            $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
	            $message->to($correo,'to');
	        });

	        return "operacion exitosa"; 
	    }
        
    }

    public function genclave(){
      $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $cadena_base .= '0123456789' ;
      $cadena_base .= 'kkck';
      $password = '';
      $limite = strlen($cadena_base) - 1;
 
      for ($i=0; $i < 13; $i++)
        $password .= $cadena_base[rand(0, $limite)];
        return $password;
    }

    public function eliminar_alumno(Request $dato)
    {
      $vendedor = Vendedor::idVendedor($dato->id_alumno);
      //return $vendedor;

      $fotoalumno = VendedorInstitucion::traerFoto($dato->id_alumno);
      if ("ico/default-avatar.png" === $fotoalumno[0]->foto) {
        
        $eliminarFoto = Fotoperfil::eliminar($dato->id_alumno);
        $eliminarVi = VendedorInstitucion::eliminar($vendedor[0]->id);
        $eliminarvendedor = Vendedor::eliminar($dato->id_alumno);
        $eliminarpasswordcuenta = Passwordcuenta::eliminar($dato->id_alumno);
        $eliminaruser = User::eliminar($dato->id_alumno);
                  
        \Session::flash('correcto', 'Alumno borrado con exito');
        return redirect()->back();

      }
      //return "0";
        $foto = Fotoperfil::where('id_user', $dato->id_alumno)->get();
        //dd($foto[0]->foto);/*CODIGO PENDIENTE PARA BORRAR EN CASO DE QUE SI CAMBIO DE FOTO DEFAULT DE PARTE DEL USUARIO*/
        \File::delete($foto[0]->foto);
        $eliminarFoto = Fotoperfil::eliminar($dato->id_alumno);
        $eliminarVi = VendedorInstitucion::eliminar($vendedor[0]->id);
        $eliminarvendedor = Vendedor::eliminar($dato->id_alumno);
        $eliminarpasswordcuenta = Passwordcuenta::eliminar($dato->id_alumno);
        $eliminaruser = User::eliminar($dato->id_alumno);
                  
        \Session::flash('correcto', 'Alumno borrado con exito');
        return redirect()->back();
    }

    public function actualizar_nombre(Request $dato)
    {
        $user = User::find(\Auth::user()->id);
        $user->nombres = $dato->nombre;
        if ($user->save()) {
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function actualizar_apellido(Request $dato)
    {
        $user = User::find(\Auth::user()->id);
        $user->apellidos =  $dato->apellido;
        if ($user->save()) {
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function actualizar_tel(Request $dato)
    {
        $user = Vendedor::where('id_user', \Auth::user()->id)->first();
        $user->telefono = $dato->teléfono;
        if ($user->save()) {
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function actualizar_direccion(Request $dato)
    {
       //$user = User::find(\Auth::user()->id);
    }
    public function actualizar_correo(Request $dato)
    {
       $user = User::find(\Auth::user()->id);
        $user->email =  $dato->correo;
        if ($user->save()) {
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function actualizar_clave(Request $data)
    {
      $this->validate($data,
            [
            'clave_actual' => 'required',
            'clave_nueva' => 'required',
            'confirm_clave_nueva' => 'required|same:clave_nueva'
        ]);
        $pass = User::find(\Auth::user()->id);
        //dd(\Hash::check($data->clave_actual, $pass->password));
        if (\Hash::check($data->clave_actual, $pass->password)) {
                $clave = User::find(\Auth::user()->id);
                $clave->password = bcrypt($data->clave_nueva);
                if ($clave->save()) {
                  return "cambiada...";
                }
                return redirect()->back()->withErrors(['Errores detectados']);
        }
        return redirect()->back()->withErrors(['Clave actual incorrecta']);
    }

    
}
