<?php

namespace App\Http\Controllers;

use App\homologacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomologacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $homologaciones = DB::table('homologacions')->where('user_id','=', $user->id)->get();
        return view('layouts.homologacion',['homologaciones'=>$homologaciones]);
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
        $user = Auth::user();
        $homologacion = new homologacion();
        $homologacion->user_id = $user->id;
        $homologacion->codigo = $request->codigo;
        $homologacion->descripcion = $request->descripcion;
        $homologacion->save();

        return redirect()->route('homologacion');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\homologacion  $homologacion
     * @return \Illuminate\Http\Response
     */
    public function show(homologacion $homologacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\homologacion  $homologacion
     * @return \Illuminate\Http\Response
     */
    public function edit(homologacion $homologacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\homologacion  $homologacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, homologacion $homologacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\homologacion  $homologacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        DB::table('homologacions')->where('id','=', $request->id)->delete();
        
        return redirect()->route('homologacion');
    }
}
