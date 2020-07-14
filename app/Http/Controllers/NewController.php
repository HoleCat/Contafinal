<?php

namespace App\Http\Controllers;

use App\Clases\Reporte\Coeficiente;
use App\Clases\Uso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    
    public function new_reporte()
    {
        if(Auth::check()){
            $idusuario = Auth::user()->id;
            $tipo = 21;
            $tipocompras = 22;
            $historico = DB::table('usos')->where('idtipo','=',$tipocompras)->get();
            $uso = new Uso();
                $uso->idusuario = $idusuario;
                $uso->uso_id = 0;
                $uso->idtipo = $tipo;
                $uso->referencia = 'referencia de ejemplo reporte';
                $uso->save();

                $reportecompras = new Uso();
                $reportecompras->idusuario = $idusuario;
                $reportecompras->uso_id = $uso->id;
                $reportecompras->idtipo = $tipocompras;
                $reportecompras->referencia = 'referencia de ejemplo reporte de compras';
                $reportecompras->save();

                $count = DB::table('coeficientes')->where('IdUso','=',$reportecompras->uso_id)->count();
                if($count>0){
                    $coeficiente = DB::table('coeficientes')
                    ->where('IdUso','=',$reportecompras->uso_id)
                    ->latest()
                    ->first();
                }
                else
                {
                    $coeficiente = new Coeficiente();
                    $coeficiente->IdUso = $reportecompras->uso_id;
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
    public function new_ventas()
    {
        if(Auth::check()){
            $tipo = 9;
            $tiposubuso = 11;
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $idusuario = Auth::user()->id;
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            
            $uso = DB::table('usos')
            ->where('idusuario','=',$idusuario)
            ->where('idtipo','=',$tipo)
            ->latest()
            ->first();


            $usoventas = new Uso([
                'idusuario' => $idusuario,
                'uso_id' => $uso->id,
                'referencia' => 'Ejemplo de referencia ventas sin uso general',
                'idtipo' => $tiposubuso,
            ]);
            $usoventas->save();
            $archivos = DB::table('archivos')->where('uso_id','=',$usoventas->id)->get();
            return view('modules.muestreo.ventas',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usoventas,'comprobantes' => $comprobantes]);
            
        } else {
            return view('login');
        }
    }
    public function new_compras()
    {
        if(Auth::check()){
            $tipo = 9;
            $tiposubuso = 10;
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $idusuario = Auth::user()->id;
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            
            $uso = DB::table('usos')
            ->where('idusuario','=',$idusuario)
            ->where('idtipo','=',$tipo)
            ->latest()
            ->first();

            $usocompras = new Uso([
                'idusuario' => $idusuario,
                'uso_id' => $uso->id,
                'referencia' => 'Ejemplo de referencia compras sin uso general',
                'idtipo' => $tiposubuso,
            ]);
            $usocompras->save();
            $archivos = DB::table('archivos')->where('uso_id','=',$usocompras->id)->get();
            return view('modules.muestreo.compras',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usocompras,'comprobantes' => $comprobantes]);
            
        } else {
            return view('login');
        }
    }
    public function new_gastos()
    {
        if(Auth::check()){
            $tipo = 9;
            $tiposubuso = 12;
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $idusuario = Auth::user()->id;
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            
            $uso = DB::table('usos')
            ->where('idusuario','=',$idusuario)
            ->where('idtipo','=',$tipo)
            ->latest()
            ->first();

            $usogastos = new Uso([
                'idusuario' => $idusuario,
                'uso_id' => $uso->id,
                'referencia' => 'Ejemplo de referencia gastos sin uso general',
                'idtipo' => $tiposubuso,
            ]);
            $usogastos->save();
            $archivos = DB::table('archivos')->where('uso_id','=',$usogastos->id)->get();    
            return view('modules.muestreo.gastos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usogastos,'comprobantes' => $comprobantes]);
            
        } else {
            return view('login');
        }
    }

    public function new_caja()
    {
        $tipo = 13;
        $tiposubuso = 14;
        $idusuario = Auth::user()->id;
        
        $aprobadores = DB::table('aprobadors')->where('user_id','=',Auth::user()->id)->get();
        $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
        $uso = new Uso();
        $uso->idusuario = $idusuario;
        $uso->uso_id = 0;
        $uso->referencia = 'Ejemplo de referencia';
        $uso->idtipo = $tipo;
        $uso->save();

        $usoliquidacion = new Uso([
            'idusuario' => $idusuario,
            'uso_id' => $uso->id,
            'referencia' => 'Ejemplo de referencia liquidacion sin uso general',
            'idtipo' => $tiposubuso,
        ]);
        $usoliquidacion->save();

        return view('modules.caja.liquidacion',['historico'=>$historico,'uso' => $usoliquidacion,'aprobadores' => $aprobadores]);
    }

    public function new_activos()
    {
        $tipo = 17;
        $idusuario = Auth::user()->id;
        $historico = DB::table('usos')->where('idtipo','=',$tipo)->get();
        $aprobadores = DB::table('aprobadors')->where('user_id','=',Auth::user()->id)->get();
        
        $uso = new Uso();
        $uso->idusuario = $idusuario;
        $uso->uso_id = 0;
        $uso->referencia = 'Ejemplo de referencia activos';
        $uso->idtipo = $tipo;
        $uso->save();
        $archivos = DB::table('archivos')->where('uso_id','=',$uso->id)->get();
        return view('modules.activos.activos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $uso,'aprobadores' => $aprobadores]);
    }

    public function new_xml()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $tipo = 19;
        $historico = DB::table('usos')->where('idtipo','=',$tipo)->get();
        $uso = new Uso([
            'idusuario' => $user_id,
            'uso_id' => 0,
            'referencia' => 'Ejemplo de referencia compras',
            'idtipo' => $tipo,
        ]);
        $uso->save();

        return view("modules.xml.xml",['historico'=>$historico,'uso'=>$uso]);
    }
}
