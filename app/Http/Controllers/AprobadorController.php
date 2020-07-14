<?php

namespace App\Http\Controllers;

use App\Clases\Caja\Aprobador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class AprobadorController extends Controller
{
    public function index()
    {
        $aprobadores = DB::table('aprobadors')->where('user_id','=',Auth::user()->id)->get();
        return view('layouts.aprobadores',['aprobadores'=>$aprobadores]);
    }
    public function store(Request $request)
    {
        try{
            $aprobador = new Aprobador();
            $aprobador->nombre = $request->nombre;
            $aprobador->apellido = $request->apellido;
            $aprobador->dni = $request->dni;
            $aprobador->telefono = $request->telefono;
            $aprobador->correo = $request->correo;
            $aprobador->user_id = Auth::user()->id;
            $aprobador->save();
        } catch(Throwable $th) {
            $aprobador = new Aprobador();
            $aprobador->nombre = "ERROR";
            $aprobador->apellido = "CAMPOS";
            $aprobador->dni = "TODOS";
            $aprobador->telefono = "COMPLETE";
            $aprobador->correo = "VACIOS";
            $aprobador->user_id = Auth::user()->id;
            $aprobador->save();
        }
        
        return redirect()->route('aprobador');
    }
    public function destroy(Request $request)
    {
        DB::table('aprobadors')->where('id','=', $request->id)->delete();
        
        return redirect()->route('aprobador');
    }
}
