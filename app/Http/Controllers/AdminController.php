<?php

namespace App\Http\Controllers;

use App\Clase\Modelosgenerales\Sistemacontable;
use App\Clases\Modelosgenerales\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function empresa(Request $request) {

        $empresa                = new Empresa();
        $empresa->user_id       = $request->input('user');
        $empresa->nombre        = $request->input('nombre');
        $empresa->razonsocial   = $request->input('razonsocial');
        $empresa->ruc           = $request->input('ruc');
        $empresa->codigo        = $request->input('codigo');
        $empresa->telefono      = $request->input('telefono');
        $empresa->direccion     = $request->input('direccion');
        $empresa->pagina        = $request->input('pagina');

        $nombre = $empresa->ruc;

        
        $ruta = '';
        $filenametostore = '';
        
        if($request->hasfile('foto')){
            $filenamewithext = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $ext = $request->file('foto')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$ext;
            $ruta = $request->file('foto')->move('storage/empresas/'.$nombre.'/', $filenametostore);
        } else {
            $ruta = public_path('/assets/img/noimage.png');
        }

        $empresa->foto = $ruta;
        
        $empresa->save();
        $users = DB::table('users')
        ->join('userdatas', 'userdatas.user_id', '=', 'users.id')
        ->get();
        $empresas = DB::table('empresas')
        ->select('empresas.*','users.*','empresas.id as idcool')
        ->join('users', 'users.id', '=', 'empresas.user_id')
        ->get();
        return view('herramientas.mantenedores.empresa', ['users'=>$users,'empresa'=>$empresa,'empresas'=>$empresas]);
    }

    public function sistemacontable(Request $request) {
        $sistemacontable = new Sistemacontable();
        $sistemacontable->codigo = $request->input('codigo');
        $sistemacontable->user_id = Auth::user()->id;
        $sistemacontable->MANDANTE = $request->input('MANDANTE');
        $sistemacontable->INTERFAZ = $request->input('INTERFAZ');
        $sistemacontable->CORRELAT = $request->input('CORRELAT');
        $sistemacontable->NITEM = $request->input('NITEM');
        $sistemacontable->BUKRS = $request->input('BUKRS');
        $sistemacontable->BUPLA = $request->input('BUPLA');
        $sistemacontable->NEWBS_ORIGEN = $request->input('NEWBSORIGEN');
        $sistemacontable->NEWBS_PROV = $request->input('NEWBSPROVEEDOR');
        $sistemacontable->NEWUM = $request->input('NEWUM');
        $sistemacontable->NEWBK = $request->input('NEWBK');
        $sistemacontable->FWBAS = $request->input('FWBAS');
        $sistemacontable->MWSKZ = $request->input('MWSKZ');
        $sistemacontable->GSBER = $request->input('GSBER');
        $sistemacontable->AUFNR = $request->input('AUFNR');
        $sistemacontable->ZTERM = $request->input('ZTERM');
        $sistemacontable->VBUND = $request->input('VBUND');
        $sistemacontable->XREF1 = $request->input('XREF1');
        $sistemacontable->XREF2 = $request->input('XREF2');
        $sistemacontable->XREF3 = $request->input('XREF3');
        $sistemacontable->VALUT = $request->input('VALUT');
        $sistemacontable->XMWST = $request->input('XMWST');
        $sistemacontable->ZLSPR = $request->input('ZLSPR');
        $sistemacontable->ZFBDT = $request->input('ZFBDT');
        $sistemacontable->save();

        return view('herramientas.mantenedores.sistemacontable', ['empresa'=>$sistemacontable]);
    }

    public function deleteempresa(Request $request)
    {
        DB::table('empresas')->where('id','=',$request->id)->delete();
        $users = DB::table('users')
        ->join('userdatas', 'userdatas.user_id', '=', 'users.id')
        ->get();
        $empresas = DB::table('empresas')
        ->select('empresas.*','users.*','empresas.id as idcool')
        ->join('users', 'users.id', '=', 'empresas.user_id')
        ->get();
        return view('herramientas.mantenedores.empresa', ['users'=>$users,'empresas'=>$empresas]);
    }

}
