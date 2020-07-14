<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    public function Index(Request $request)
    {

        $info = array(
            'nombre' => $request->nombre.' '.$request->apellido,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje
        );

        Mail::send('layouts.contactomail',$info,function($message){
            $message->from('201602035x@gmail.com','Contadorapp');
            $message->to('jorge.hospinal@yahoo.com')->subject('Reporte de caja');
            $message->to(request()->input('correo'))->subject('Reporte de caja');
        });

        return redirect('home');
    }
}
