<?php

namespace App\Http\Controllers;

use App\noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = DB::table('noticias')->get();
        return view('layouts.noticias',['noticias'=>$noticias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noticia = new Noticia();
        $noticia->contenido = $request->contenido;
        $noticia->resumen = $request->resumen;
        $noticia->status = $request->status;
        $noticia->save();

        return redirect()->route('noticia');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show(noticia $noticia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit(noticia $noticia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, noticia $noticia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(noticia $noticia, Request $request)
    {
        DB::table('noticias')->where('id','=', $request->id)->delete();
        
        return redirect()->route('noticia');
    }
}
