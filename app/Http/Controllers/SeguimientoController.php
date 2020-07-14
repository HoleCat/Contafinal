<?php

namespace App\Http\Controllers;

use App\Clases\Uso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeguimientoController extends Controller
{
    public function data(Request $request) {
        $id = Auth::user()->id;
        $data = Uso::where('referencia', 'like', '%' . $request->referencia . '%')->where('idusuario','=',$id)->get();
        return $data;
    }
}
