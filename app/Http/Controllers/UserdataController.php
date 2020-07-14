<?php

namespace App\Http\Controllers;

use App\Clases\Caja\Aprobador;
use App\Clases\Modelosgenerales\Empresa;
use App\User;
use App\Userdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userdata = Userdata::firstWhere('user_id','=',$user->id);
        
        $empresa = Empresa::find($userdata->empresa_id);
        $empresas = DB::table('empresas')->where('id','=',$userdata->user_id)->get();
        $aprobador = Aprobador::find($userdata->aprobador_id);
        $aprobadores = DB::table('aprobadors')->where('id','=',$userdata->user_id)->get();

        return ['empresas'=>$empresas,'aprobadores'=>$aprobadores,'user'=>$user,'userdata'=>$userdata,'aprobador'=>$aprobador,'empresa'=>$empresa];
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
        $userdata = Userdata::firstWhere('user_id','=',$user->id);
        $user = User::find($user->id);
        if($request->input('name') != ''){
            $user->name = $request->input('name');
        }
        if($request->input('correo') != ''){
            $user->mail = $request->input('correo');
        }
        if($request->input('empresa') != ''){
            $userdata->empresa_id = $request->input('empresa');
        }
        if($request->input('aprobador') != ''){
            $userdata->aprobador_id = $request->input('aprobador');
        }
        if($request->input('nombre') != ''){
            $userdata->nombre = $request->input('nombre');
        }
        if($request->input('apellido') != ''){
            $userdata->apellido = $request->input('apellido');
        }
        if($request->input('dni') != ''){
            $userdata->dni = $request->input('dni');
        }
        if($request->input('ruc') != ''){
            $userdata->ruc = $request->input('ruc');
        }
        if($request->input('foto') != ''){
            $ruta = '';
            $filenametostore = '';
            
            if($request->hasfile('foto')){
                $filenamewithext = $request->file('foto')->getClientOriginalName();
                $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
                $ext = $request->file('foto')->getClientOriginalExtension();
                $filenametostore = $filename.'_'.time().'.'.$ext;
                $ruta = $request->file('foto')->move('storage/images', $filenametostore);
            } else {
                $ruta = public_path('/assets/img/noimage.png');
            }

            $userdata->foto = $ruta;
        }

        $user->save();
        $userdata->save();

        $empresa = DB::table('empresas')->firstWhere('id','=',$userdata->empresa_id);
        
        $aprobador = Aprobador::find($userdata->aprobador_id);
        $aprobadores = DB::table('aprobadors')->where('id','=',$userdata->user_id)->get();
        $empresas = DB::table('empresas')->where('user_id','=',$user->id)->get();

        return ['aprobadores'=>$aprobadores,'user'=>$user,'userdata'=>$userdata,'aprobador'=>$aprobador,'empresa'=>$empresa,'empresas'=>$empresas];
    }

    public function perfil(Request $request)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $userdata = Userdata::firstWhere('user_id','=',$user->id);

        if($request->input('name') != ''){
            $user->name = $request->input('name');
        }
        if($request->input('empresa') != ''){
            $userdata->empresa_id = $request->input('empresa');
        }
        if($request->input('aprobador') != ''){
            $userdata->aprobador_id = $request->input('aprobador');
        }
        
        $ruta = '';
        $filenametostore = '';
        
        if($request->hasfile('foto')){
            $filenamewithext = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $ext = $request->file('foto')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$ext;
            $ruta = $request->file('foto')->move('storage/images', $filenametostore);
            $userdata->foto = $ruta;
        } 

        $user->save();
        $userdata->save();

        $empresa = Empresa::find($userdata->empresa_id);
        $empresas = DB::table('empresas')->where('user_id','=',$user->id)->get();
        $aprobador = Aprobador::find($userdata->aprobador_id);
        $aprobadores = DB::table('aprobadors')->where('id','=',$userdata->user_id)->get();
        return view('layouts.perfil',['aprobadores'=>$aprobadores,'empresas'=>$empresas,'user'=>$user,'userdata'=>$userdata,'aprobador'=>$aprobador,'empresa'=>$empresa]);
    }

    public function empresa(Request $request)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $userdata = Userdata::firstWhere('user_id','=',$user->id);

        if($request->input('correo') != ''){
            $user->email = $request->input('correo');
        }
        if($request->input('nombre') != ''){
            $userdata->nombre = $request->input('nombre');
        }
        if($request->input('apellido') != ''){
            $userdata->apellido = $request->input('apellido');
        }
        if($request->input('dni') != ''){
            $userdata->dni = $request->input('dni');
        }
        if($request->input('ruc') != ''){
            $userdata->ruc = $request->input('ruc');
        }

        $user->save();
        $userdata->save();

        $empresa = Empresa::find($userdata->empresa_id);
        $aprobador = DB::table('aprobadors')->where('id','=',$userdata->aprobador_id);

        return view('layouts.empresa',['user'=>$user,'userdata'=>$userdata,'aprobador'=>$aprobador,'empresa'=>$empresa]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function show(Userdata $userdata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function edit(Userdata $userdata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userdata $userdata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userdata $userdata)
    {
        //
    }
}
