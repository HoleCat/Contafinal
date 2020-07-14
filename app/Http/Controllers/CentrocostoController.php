<?php

namespace App\Http\Controllers;

use App\clases\modelosgenerales\Centrocosto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CentrocostoController extends Controller
{
    public function index()
    {
        $centrocostos = DB::table('centrocostos')->get();
        return view('layouts.centrocosto',['centrocostos'=>$centrocostos]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $centrocosto = new centrocosto();
        $centrocosto->codigo = $request->contenido;
        $centrocosto->descripcion = $request->resumen;
        $centrocosto->save();

        return redirect()->route('centrocosto');
    }

    public function show(centrocosto $centrocosto)
    {
        //
    }

    public function edit(Centrocosto $centrocosto)
    {
        //
    }

    public function update(Request $request, centrocosto $centrocosto)
    {
        //
    }

    public function destroy(centrocosto $centrocosto, Request $request)
    {
        DB::table('centrocostos')->where('id','=', $request->id)->delete();
        
        return redirect()->route('centrocosto');
    }

    
}
