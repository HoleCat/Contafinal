<?php

namespace App\Http\Controllers;

use App\Clases\Caja\Cajachica;
use App\Clases\Caja\LiquidacionDetalle;
use App\Clases\Caja\Rendirpago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrashController extends Controller
{
    ////////////////////
    public function trash_archivo_compras(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('mayorcompras')->where('IdArchivo','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_compras(Request $request){
        $msg = "";
        
        $flag = DB::table('mayorcompras')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////////
    public function trash_archivo_ventas(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('mayorventas')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_ventas(Request $request){
        $msg = "";
        
        $flag = DB::table('mayorventas')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////////
    public function trash_archivo_gastos(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('mayorgastos')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_gastos(Request $request){
        $msg = "";
        
        $flag = DB::table('mayorgastos')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////////
    public function trash_archivo_activos(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('activofijos')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_activos(Request $request){
        $msg = "";
        
        $flag = DB::table('activofijos')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////////
    public function trash_caja_chica(Request $request){
        $msg = "";
        
        $reg = Cajachica::find($request->id);

        $flag = DB::table('cajachicas')->where('id','=',$request->id)->delete();

        $total = DB::table('cajachicas')->where('liquidacion_id','=',$reg->liquidacion_id)->sum('monto');
        $liqui = LiquidacionDetalle::find($reg->liquidacion_id);
        
        $monto = $liqui->monto;
        $liqui->liquidacion = $total;
        $liqui->neto = $monto - $total;
        $liqui->save();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////////
    public function trash_rendir_pago(Request $request){
        $msg = "";
        
        $reg = Rendirpago::find($request->id);

        $flag = DB::table('rendirpagos')->where('id','=',$request->id)->delete();

        $total = DB::table('rendirpagos')->where('liquidacion_id','=',$reg->liquidacion_id)->sum('monto');
        $liqui = LiquidacionDetalle::find($reg->liquidacion_id);
        
        $monto = $liqui->monto;
        $liqui->liquidacion = $total;
        $liqui->neto = $monto - $total;
        $liqui->save();

        return print_r($liqui);
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////////
    public function trash_xml(Request $request){
        $msg = "";
        
        $flag = DB::table('facturas')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    //////////USOS////////////

    ///////////VERIFICAR//////////////
    public function trash_uso_liquidacion(Request $request)
    {
        $msg = "";

        $detalle = DB::table('liquidacion_detalles')->where('uso_id','=',$request->iduso)->latest()->first();
            
        DB::table('cajachicas')->where('liquidacion_id','=',$detalle->id)->delete();
        DB::table('rendirpagos')->where('liquidacion_id','=',$detalle->id)->delete();

        $flag = DB::table('liquidacion_detalles')->where('uso_id','=',$request->iduso)->delete();
        $flag = DB::table('usos')->where('id','=',$request->iduso)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return redirect('home');
        }
    }
    public function trash_uso_caja(Request $request)
    {
        try{
            $msg = "";

            $detalle = DB::table('liquidacion_detalles')->where('uso_id','=',$request->iduso)->latest()->first();
            
            DB::table('cajachicas')->where('liquidacion_id','=',$detalle->id)->delete();
            DB::table('rendirpagos')->where('liquidacion_id','=',$detalle->id)->delete();

            DB::table('liquidacion_detalles')
              ->where('id','=', $detalle->id)
              ->update(['liquidacion'=>0,'neto'=>$detalle->monto]);
            
            $msg = "todo gud";
            return redirect('home');
        }catch(\Throwable $th)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg, 'errortec' => $th->getMessage() ];
        }
        
    }
    public function trash_uso_muestreo(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('mayorcompras')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('mayorventas')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('mayorgastos')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('archivos')->where('uso_id','=',$request->iduso)->delete();
        $flag = DB::table('usos')->where('id','=',$request->iduso)->delete();

        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return redirect('home');
        }

    }
    public function trash_uso_activos(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('activofijos')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('archivos')->where('uso_id','=',$request->iduso)->delete();
        $flag = DB::table('usos')->where('id','=',$request->iduso)->delete();

        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return redirect('home');
        }

        
    }
    public function trash_uso_xml(Request $request)
    {
        $msg = "";
        
        
        $flag = DB::table('facturas')->where('uso_id','=',$request->iduso)->delete();
        $flag = DB::table('archivos')->where('uso_id','=',$request->iduso)->delete();
        $flag = DB::table('usos')->where('id','=',$request->iduso)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return redirect('home');
        }
    }
    public function trash_uso_reporte(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('validacion_reporte_compras')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('validacion_reporte_ventas')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('detraccion_compras')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('rentas')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('resultado_rucs')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('coeficientes')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('prorratas')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('creditos')->where('IdUso','=',$request->iduso)->delete();
        $flag = DB::table('usos')->where('id','=',$request->iduso)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return redirect('home');
        }

    }
    public function trash_detraccion(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('detraccion_compras')->where('IdArchivo','=',$request->id_archivo)->delete();
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $archivos = DB::table('archivos')->where('tipo','=','detraccion')->where('uso_id','=',$request->iduso)->get();
            return ['mensaje'=>"todo bien perrooo",'archivos' => $archivos];
        }

    }
    public function trash_r_compras(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('validacion_reporte_compras')->where('IdArchivo','=',$request->id_archivo)->delete();
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $archivos = DB::table('archivos')->where('tipo','=','registro de compras')->where('uso_id','=',$request->iduso)->get();
            return ['mensaje'=>"todo bien perrooo",'archivos' => $archivos];
        }
    }
    public function trash_r_ventas(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('validacion_reporte_ventas')->where('IdArchivo','=',$request->id_archivo)->delete();
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $archivos = DB::table('archivos')->where('tipo','=','reporte ventas')->where('uso_id','=',$request->iduso)->get();
            return ['mensaje'=>"todo bien perrooo",'archivos' => $archivos];
        }
    }
    public function trash_r_ruc(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('resultado_rucs')->where('IdArchivo','=',$request->id_archivo)->delete();
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $archivos = DB::table('archivos')->where('tipo','=','resultado ruc')->where('uso_id','=',$request->iduso)->get();
            return ['mensaje'=>"todo bien perrooo",'archivos' => $archivos];
        }
    }
    public function trash_r_rentas(Request $request)
    {
        $msg = "";
        
        $flag = DB::table('rentas')->where('IdArchivo','=',$request->id_archivo)->delete();
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $archivos = DB::table('archivos')->where('tipo','=','rentas')->where('uso_id','=',$request->iduso)->get();
            return ['mensaje'=>"todo bien perrooo",'archivos' => $archivos];
        }
    }


    ////////////////////
    public function trash_reporte_compras(Request $request){
        $msg = "";
        
        $flag = DB::table('validacion_reporte_compras')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    public function trash_archivo_reporte_compras(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('validacion_reporte_compras')->where('IdArchivo','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    ////////////////////
    public function trash_archivo_reporte_ventas(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('validacion_reporte_ventas')->where('IdArchivo','=',$request->id_archivo)->delete();
        
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_reporte_ventas(Request $request){
        $msg = "";
        
        $flag = DB::table('validacion_reporte_ventas')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    //////////////
    public function trash_archivo_detraccion_compras(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('detraccion_compras')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_detraccion_compras(Request $request){
        $msg = "";
        
        $flag = DB::table('detraccion_compras')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////
    public function trash_archivo_rentas(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('rentas')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_rentas(Request $request){
        $msg = "";
        
        $flag = DB::table('rentas')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    //////////////
    public function trash_archivo_resultadorucs(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('resultadorucs')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_resultadorucs(Request $request){
        $msg = "";
        
        $flag = DB::table('resultadorucs')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ////////////////
    public function trash_archivo_coeficientes(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('coeficientes')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_coeficientes(Request $request){
        $msg = "";
        
        $flag = DB::table('coeficientes')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    ///////////////
    public function trash_archivo_prorratas(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('prorratas')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_prorratas(Request $request){
        $msg = "";
        
        $flag = DB::table('prorratas')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    //////////////
    public function trash_archivo_creditos(Request $request){
        $msg = "";
        
        $flag = DB::table('archivos')->where('id','=',$request->id_archivo)->delete();
        $flag = DB::table('creditos')->where('IdArchivo','=',$request->id_archivo)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->get();
            return [ 'data' => $msg,'archivos'=>$archivos ];
        }
        return $flag;
    }
    public function trash_creditos(Request $request){
        $msg = "";
        
        $flag = DB::table('creditos')->where('id','=',$request->id)->delete();
        if($flag == 0)
        {
            $msg = "error posiblemente se alla eliminado ya el registro, de no ser asi recargar e intentar nuevamente, si el error persiste comunicarse con el proveedor.";
            return ['error' => $msg ];
        }
        else
        {
            $msg = "todo gud";
            return [ 'data' => $msg ];
        }
        return $flag;
    }
    //////////////
    

}
