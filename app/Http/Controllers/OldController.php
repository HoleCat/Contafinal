<?php

namespace App\Http\Controllers;

use App\Clases\Caja\LiquidacionDetalle;
use App\Clases\Reporte\Coeficiente;
use App\Clases\Uso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OldController extends Controller
{
    public function old_reporte(Request $request)
    {
        if(Auth::check()){
            $idusuario = Auth::user()->id;
            $tipo = 21;
            $tipocompras = 22;

            $historico = DB::table('usos')->where('idtipo','=',$tipocompras)->get();
            $reportecompras = Uso::find($request->historico);
            $count = DB::table('coeficientes')->where('IdUso','=',$reportecompras->id)->count();
            if($count>0){
                $coeficiente = DB::table('coeficientes')
                ->where('IdUso','=',$reportecompras->id)
                ->latest()
                ->first();
            }
            else
            {
                $coeficiente = new Coeficiente();
                $coeficiente->IdUso = $reportecompras->id;
                $coeficiente->VentasNetas = "0.0";
                $coeficiente->NroVentasNetas = "0.0";

                $coeficiente->IngresosFinancierosGravados = "0.0";
                $coeficiente->NroIngresosFinancierosGravados = "0.0";

                $coeficiente->OtrosIngresosGravados = "0.0";
                $coeficiente->NroOtrosIngresosGravados = "0.0";

                $coeficiente->OtrosIngresosNoGravados = "0.0";
                $coeficiente->NroOtrosIngresosNoGravados = "0.0";

                $coeficiente->EnajenaciónValoresBienesAF = "0.0";
                $coeficiente->NroEnajenaciónValoresBienesAF = "0.0";

                $coeficiente->REI = "0.0";
                $coeficiente->NroREI = "0.0";

                $coeficiente->TotalIngresosNetos = "0.0";
                $coeficiente->NroTotalIngresosNetos = "";

                $coeficiente->IngresoDiferenciaCambio = "0.0";
                $coeficiente->NroIngresoDiferenciaCambio = "0.0";

                $coeficiente->IngresosNetos = "0.0";
                $coeficiente->NroIngresosNetos = "0.0";

                $coeficiente->ImpuestoCalculado = "0.0";
                $coeficiente->NroImpuestoCalculado = "0.0";

                $coeficiente->Coeficiente = "0.0";
                $coeficiente->NroCoeficiente = "0.0";

                $coeficiente->CoeficienteFinal = "0.0";
                $coeficiente->NroCoeficienteFinal = "0.0";

                $coeficiente->CoeficienteSUNAT = "0.0";
                $coeficiente->NroCoeficienteSUNAT = "0.0";

                $coeficiente->CoeficientePDT = "0.0";
                $coeficiente->NroCoeficientePDT = "0.0";

                $coeficiente->CoeficienteDefinitivo = "0.0";
                $coeficiente->NroCoeficienteDefinitivo = "0.0";

                $coeficiente->save();
            }

            return view('modules.reporte.reportecompras',['historico'=>$historico,'coeficiente'=>$coeficiente,'uso'=>$reportecompras]);
            
        } else {
            return view('login');
        }
    }
    public function old_ventas(Request $request)
    {
        if(Auth::check()){
            $tipo = 9;
            $tiposubuso = 11;
            
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $usoventas = Uso::find($request->historico);
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            
            $archivos = DB::table('archivos')->where('uso_id','=',$request->historico)->get();
            return view('modules.muestreo.ventas',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usoventas,'comprobantes' => $comprobantes]);
            
        } else {
            return view('login');
        }
    }
    public function old_compras(Request $request)
    {
        if(Auth::check()){
            $tipo = 9;
            $tiposubuso = 10;
            
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $usocompras = Uso::find($request->historico);
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            
            $archivos = DB::table('archivos')->where('uso_id','=',$request->historico)->get();
            return view('modules.muestreo.compras',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usocompras,'comprobantes' => $comprobantes]);
            
        } else {
            return view('login');
        }
    }
    public function old_gastos(Request $request)
    {
        if(Auth::check()){
            $tipo = 9;
            $tiposubuso = 12;
            
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $usogastos = Uso::find($request->historico);
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            
            $archivos = DB::table('archivos')->where('uso_id','=',$request->historico)->get();
            return view('modules.muestreo.gastos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usogastos,'comprobantes' => $comprobantes]);
            
        } else {
            return view('login');
        }
    }
    public function old_caja(Request $request)
    {
        if(Auth::check()){
            $tipo = 13;
            $tiposubuso = 14;
            $uso_id = 0;
            $idusuario = Auth::user()->id;
            $contadorusocaja = DB::table('usos')->where('idusuario','=',$idusuario)->where('idtipo','=',$tipo)->count();
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $aprobadores = DB::table('aprobadors')->where('user_id','=',Auth::user()->id)->get();
            $sistemas = DB::table('sistemacontables')->get();
            if($contadorusocaja > 0)
            {
                $uso = DB::table('usos')
                ->where('idusuario','=',$idusuario)
                ->where('idtipo','=',$tipo)
                ->latest()
                ->first();
    
                $uso_id = $uso->id;

                $usoliquidacion = Uso::find($request->historico);

                $contadorusoliquidaciondetalle = DB::table('liquidacion_detalles')->where('uso_id','=',$usoliquidacion->id)->count();
                if($contadorusoliquidaciondetalle > 0) {
                    $liquidacion = LiquidacionDetalle::where('uso_id', $usoliquidacion->id)->first();
                    
                    $tiposdocumento = DB::table('comprobantes')->get();
                    $codigocontable = DB::table('codigocontables')->get();
                    $monedas = DB::table('monedas')->get();
                    $centrocostos = DB::table('centrocostos')->get();
                    
                    if($liquidacion->servicio == 'cajachica'){
                        return view('modules.caja.cajachica',['historico'=> $historico,'sistemas'=>$sistemas,'centrocostos'=>$centrocostos,'monedas'=>$monedas,'uso'=>$usoliquidacion,'liquidacion'=>$liquidacion,'documentos'=>$tiposdocumento,'codigocontable'=>$codigocontable]);
                    }
                    if($liquidacion->servicio == 'rendirpago'){
                        return view('modules.caja.rendirpago',['historico'=> $historico,'sistemas'=>$sistemas,'centrocostos'=>$centrocostos,'monedas'=>$monedas,'uso'=>$usoliquidacion,'liquidacion'=>$liquidacion,'documentos'=>$tiposdocumento,'codigocontable'=>$codigocontable]);
                    }
                    
                    
                } else {
                    return view('modules.caja.liquidacion',['historico'=> $historico,'uso' => $usoliquidacion,'aprobadores' => $aprobadores]);
                }
                
            }
        }
    }
    public function old_activos(Request $request)
    {
        $tipo = 17;
        $idusuario = Auth::user()->id;
        
        $aprobadores = DB::table('aprobadors')->where('user_id','=',Auth::user()->id)->get();
        
        $historico = DB::table('usos')->where('idtipo','=',$tipo)->get();
        $uso = Uso::find($request->historico);
        
        $archivos = DB::table('archivos')->where('uso_id','=',$request->historico)->get();
        return view('modules.activos.activos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $uso,'aprobadores' => $aprobadores]);
    }
    public function old_xml(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $tipo = 19;
        
        $historico = DB::table('usos')->where('idtipo','=',$tipo)->get();
        $uso = Uso::find($request->historico);

        return view("modules.xml.xml",['historico'=>$historico,'uso'=>$uso]);
    }
}
