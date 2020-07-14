<?php

namespace App\Http\Controllers;

use App\Clases\Uso;
use App\titulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulos = DB::table('titulos')->get();
        return view('layouts.titulos',['titulos'=>$titulos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function referencia(Request $request)
    {
        $uso = Uso::find($request->iduso);
        $uso->referencia = $request->referencia;
        $uso->save();

        return view('layouts.uso',['uso'=>$uso]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titulo = new titulo();
        $titulo->codigo = $request->codigo;
        $titulo->contenido = $request->contenido;
        $titulo->resumen = $request->resumen;
        $titulo->save();

        return redirect()->route('titulos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function show(titulo $titulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function edit(titulo $titulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, titulo $titulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(titulo $titulo,Request $request)
    {
        DB::table('titulos')->where('id','=', $request->id)->delete();
        
        return redirect()->route('titulos');
    }
}
