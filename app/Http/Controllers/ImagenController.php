<?php

namespace App\Http\Controllers;

use App\Clases\Almacenamiento;
use App\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagenes = DB::table('imagens')->get();
        return view('layouts.imagenes',['imagenes'=>$imagenes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $imagen = new Imagen();
            $ruta = Almacenamiento::guardar($request->file('myfile'));
            $imagen->nombre = $request->nombre;
            $imagen->ruta = $ruta;
            $imagen->save();

            $imagenes = DB::table('imagens')->get();
            return  $imagenes; 

        }
        catch(\Throwable $th)
        {
            return ['error'=>$th->getMessage(),'$imagen'=>$imagen];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function show(Imagen $imagen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagen $imagen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imagen $imagen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('imagens')->where('id','=',$request->id)->delete();
        return redirect('imagen/index');
    }
}
