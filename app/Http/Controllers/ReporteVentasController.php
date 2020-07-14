<?php

namespace App\Http\Controllers;

use App\Clases\Almacenamiento;
use App\Clases\Modelosgenerales\Archivo;
use App\Clases\Reporte\Coeficiente;
use App\Clases\Reporte\Renta;
use App\Clases\Reporte\ValidacionReporteVenta;
use App\Formatos\Dates;
use App\Formatos\Excelmuestreo;
use App\Formatos\Txtexportaciones;
use App\Imports\RentasImport;
use App\Imports\ValidacionReporteVentasImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ReporteVentasController extends Controller
{
    public function ImportarRentas(Request $request)
    {
        if($request->hasFile('myfile'))
        {
            if($request->csv && $request->excel)
            {
                return ['error'=>"DEBES SELECCIONAR SOLO UNA OPCION"];
            }
            try
            {
                if($request->csv)
                {
                    $uso_id = $request->iduso;
                    $nombre = $request->nombrearchivo;
                    $user = Auth::user();
                    $user_id = $user->id;
                    $username = $user->name;
                    $useremail = $user->email;

                    $archivo = new Archivo();
                    $archivo->user_id = $user_id;
                    $archivo->uso_id = $uso_id;
                    $archivo->ruta = $nombre;
                    $archivo->tipo = 'rentas';
                    $archivo->save();

                    $id_archivo = $archivo->id;

                    if($request->delimitador == null)
                    {
                        return ["error"=>"Olvido decirnos que delimitador esta usando"];
                    }
                    else
                    {
                        $data = Txtexportaciones::csv_to_array($request->file('myfile'),$request->delimitador);
                    }
                    
                    for ($i=0; $i < count($data); $i++) { 
                        $row = $data[$i];
                        //$pieces = Dates::regular_date_to_array($row[2],"/");
                        $registro = new Renta([
                            'IdUso'=>$uso_id,
                            'IdArchivo'=>$id_archivo,
                            'Numero'=>$row[0],
                            'Nombrecuenta'=>$row[1],
                            'Acumulado'=>$row[2]
                        ]);
                        $registro->save();
                    }
                }

                if($request->excel)
                {
                    $uso_id = $request->iduso;
                    $nombre = $request->nombrearchivo;
                    $user = Auth::user();
                    $user_id = $user->id;
                    $username = $user->name;
                    $useremail = $user->email;

                    $archivo = new Archivo();
                    $archivo->user_id = $user_id;
                    $archivo->uso_id = $uso_id;
                    $archivo->ruta = $nombre;
                    $archivo->tipo = 'rentas';
                    $archivo->save();

                    $id_archivo = $archivo->id;
                    
                    $ruta = Almacenamiento::guardartemporalmente($username,$request->file('myfile'));
                    
                    Excelmuestreo::aumentarcolumnasdefault($ruta,$uso_id,$id_archivo);
                    
                    Excel::import(new RentasImport, $ruta);

                    $spreadsheet = IOFactory::load($ruta);

                    Storage::deleteDirectory('public/'.$useremail.'/temporal', true);
                    // sleep 1 second because of race condition with HD
                    sleep(1);
                    // actually delete the folder itself
                    Storage::deleteDirectory('public/'.$useremail.'/temporal');
                }
                $archivos = Archivo::where('uso_id','=',$request->iduso)->where('tipo','=','rentas')->get();

                $rentas = DB::table('rentas')
                ->where('iduso','=',$request->iduso)->get();


                return ['rentas'=>$rentas,'archivos'=>$archivos];
            }
            catch(\Throwable $th)
            {
                DB::table('rentas')->where('IdArchivo','=',$id_archivo)->delete();
                DB::table('archivos')->where('id','=',$id_archivo)->delete();
                return ["errortec"=>$th->getMessage(),'error'=>"Revise sus campos, verifique que su delimitador, recargue la pagina si a pasado tiempo sin usar el app, su sesion puede haber terminado, se elimino el archivo con id ".$id_archivo.""]; 
            }

        }
        else 
        {
            return ['error'=>"DEBES ENVIAR UN ARCHIVO"];
        }
    }

    public function ImportarVentas(Request $request)
    {
        if($request->hasFile('myfile'))
        {
            if($request->csv && $request->excel)
            {
                return ['error'=>"DEBES SELECCIONAR SOLO UNA OPCION"];
            }
            try
            {
                if($request->csv)
                {
                    $uso_id = $request->iduso;
                    $nombre = $request->nombrearchivo;
                    $user = Auth::user();
                    $user_id = $user->id;
                    $username = $user->name;
                    $useremail = $user->email;

                    $archivo = new Archivo();
                    $archivo->user_id = $user_id;
                    $archivo->uso_id = $uso_id;
                    $archivo->ruta = $nombre;
                    $archivo->tipo = 'reporte ventas';
                    $archivo->save();

                    $id_archivo = $archivo->id;

                    if($request->delimitador == null)
                    {
                        return ["error"=>"Olvido decirnos que delimitador esta usando"];
                    }
                    else
                    {
                        $data = Txtexportaciones::csv_to_array($request->file('myfile'),$request->delimitador);
                    }


                    
                    for ($i=0; $i < count($data); $i++) {
                        
                        $row = $data[$i];

                        for ($i2=0; $i2 < count($row); $i2++) {
                            $row[$i2] = str_replace(',','',$row[$i2]);
                            if($row[$i2] == "")
                            {
                                if($i2 == 3 || $i2 == 4 || $i2 == 26){
                                    $row[$i2] = null;
                                }else{
                                    $row[$i2] = null;
                                }
                            }
                        }

                        if($row[3]!=null)
                        {
                            
                                try {
                                    $row[3] = $row[3];
                                    $row[3] = str_replace(".", "/", $row[3]);
                                    $row[3] = str_replace("-", "/", $row[3]);
                                } catch (\Throwable $th) {
                                    $row[3] = null;
                                }
                            
                        }
                        
                        if($row[4]!=null)
                        {
                            
                                try {
                                    $row[4] = $row[4];
                                    $row[4] = str_replace(".", "/", $row[4]);
                                    $row[4] = str_replace("-", "/", $row[4]);
                                } catch (\Throwable $th) {
                                    $row[4] = null;
                                }
                            
                        }
                        
                        if($row[26]!=null)
                        {
                            
                                try {
                                    $row[26] = $row[26];
                                    $row[26] = str_replace(".", "/", $row[26]);
                                    $row[26] = str_replace("-", "/", $row[26]);
                                } catch (\Throwable $th) {
                                    $row[26] = null;
                                }
                            
                        }
                        
                        $registro = new ValidacionReporteVenta([
                            'flag1'=>'no',
                            'flag2'=>'no',
                            'IdUso'=>$uso_id,
                            'IdArchivo'=>$id_archivo,
                            'Periodo'=>$row[0],
                            'Correlativo'=>$row[1],
                            'Ordenado'=>$row[2],
                            'FecEmision'=>$row[3],
                            'FecVenci'=>$row[4],
                            'TipoComp'=>$row[5],
                            'NumSerie'=>$row[6],
                            'NumComp'=>$row[7],
                            'NumTicket'=>$row[8],
                            'TipoDoc'=>$row[9],
                            'NroDoc'=>$row[10],
                            'Nombre'=>$row[11],
                            'Export'=>$row[12],
                            'BI'=>$row[13],
                            'Desci'=>$row[14],
                            'IGVIPMBI'=>$row[15],
                            'IGVIPMDesc'=>$row[16],
                            'ImporteExo'=>$row[17],
                            'ImporteIna'=>$row[18],
                            'ISC'=>$row[19],
                            'BIIGVAP'=>$row[20],
                            'IGVAP'=>$row[21],
                            'Otros'=>$row[22],
                            'Total'=>$row[23],
                            'Moneda'=>$row[24],
                            'TipoCam'=>$row[25],
                            'FecOrigenMod'=>$row[26],
                            'TipoCompMod'=>$row[27],
                            'NumSerieMod'=>$row[28],
                            'NumDocMod'=>$row[29],
                            'Contrato'=>$row[30],
                            'ErrorT1'=>$row[31],
                            'MedioPago'=>$row[32],
                            'Estado'=>$row[33]
                        ]);
                        $registro->save();
                    }
                }

                if($request->excel)
                {
                    $uso_id = $request->iduso;
                    $nombre = $request->nombrearchivo;
                    $user = Auth::user();
                    $user_id = $user->id;
                    $username = $user->name;
                    $useremail = $user->email;

                    $archivo = new Archivo();
                    $archivo->user_id = $user_id;
                    $archivo->uso_id = $uso_id;
                    $archivo->ruta = $nombre;
                    $archivo->tipo = 'reporte ventas';
                    $archivo->save();

                    $id_archivo = $archivo->id;
                    
                    $ruta = Almacenamiento::guardartemporalmente($username,$request->file('myfile'));
                    
                    Excelmuestreo::aumentarcolumnasdefault($ruta,$uso_id,$id_archivo);
                    Excel::import(new ValidacionReporteVentasImport, $ruta);

                    $spreadsheet = IOFactory::load($ruta);

                    Storage::deleteDirectory('public/'.$useremail.'/temporal', true);
                    // sleep 1 second because of race condition with HD
                    sleep(1);
                    // actually delete the folder itself
                    Storage::deleteDirectory('public/'.$useremail.'/temporal');
                }

                $archivos = Archivo::where('uso_id','=',$uso_id)->where('tipo','=','reporte ventas')->get();

                $ventas = DB::table('validacion_reporte_ventas')
                ->where('iduso','=',$request->iduso)->get();


                return ['ventas'=>$ventas,'archivos'=>$archivos];
            }
            catch(\Throwable $th)
            {
                DB::table('validacion_reporte_ventas')->where('IdArchivo','=',$id_archivo)->delete();
                DB::table('archivos')->where('id','=',$id_archivo)->delete();
                return ['errortec'=>$th->getMessage(),'error'=>"Pruebe recargando la pagina, o revisando si su archivo tiene las columnas en el orden que se plantea en las plantillas."];
            }
        }
        else 
        {
            return ['error'=>"DEBES ENVIAR UN ARCHIVO"];
        }
    }

    public function Coeficiente(Request $request)
    {
        $user = Auth::user();
        $uso = DB::table('usos')
        ->where('id','=',$request->uso_id)
        ->latest()
        ->first();
        
        $count = DB::table('coeficientes')->where('IdUso','=',$request->uso_id)->count();
        if($count>0)
        {
            $coeficiente = DB::table('coeficientes')
            ->where('IdUso','=',$request->uso_id)
            ->latest()
            ->first();

            $coeficiente = Coeficiente::find($coeficiente->id);
            
            $coeficiente->IdUso = $request->uso_id;
            $coeficiente->VentasNetas = $request->ventaneta;
            $coeficiente->NroVentasNetas = $request->nroventaneta;

            $coeficiente->IngresosFinancierosGravados = $request->ingresosfiancierosgravados;
            $coeficiente->NroIngresosFinancierosGravados = $request->nroingresosfiancierosgravados;

            $coeficiente->OtrosIngresosGravados = $request->ingresosgravados;
            $coeficiente->NroOtrosIngresosGravados = $request->nroingresosgravados;

            $coeficiente->OtrosIngresosNoGravados = $request->ingresosnogravados;
            $coeficiente->NroOtrosIngresosNoGravados = $request->nroingresosnogravados;

            $coeficiente->EnajenaciónValoresBienesAF = $request->enajenacion;
            $coeficiente->NroEnajenaciónValoresBienesAF = $request->nroenajenacion;

            $coeficiente->REI = $request->rei;
            $coeficiente->NroREI = $request->nrorei;

            $coeficiente->TotalIngresosNetos = $request->totalneto;
            $coeficiente->NroTotalIngresosNetos = "0.0";

            $coeficiente->IngresoDiferenciaCambio = $request->ingresosdiferenciacambio;
            $coeficiente->NroIngresoDiferenciaCambio = "0.0";

            $coeficiente->IngresosNetos = $request->ingresosnetos;
            $coeficiente->NroIngresosNetos = "0.0";

            $coeficiente->ImpuestoCalculado = $request->impuestocalculado;
            $coeficiente->NroImpuestoCalculado = $request->nroimpuestocalculado;

            $coeficiente->Coeficiente = $request->coeficiente;
            $coeficiente->NroCoeficiente = "0.0";

            $coeficiente->CoeficienteFinal = $request->coeficientefinal;
            $coeficiente->NroCoeficienteFinal = "0.0";

            $coeficiente->CoeficienteSUNAT = $request->coeficientesunat;
            $coeficiente->NroCoeficienteSUNAT = "0.0";

            $coeficiente->CoeficientePDT = $request->coeficientepdt;
            $coeficiente->NroCoeficientePDT = "0.0";

            $coeficiente->CoeficienteDefinitivo = $request->coeficientedefinitivo;
            $coeficiente->NroCoeficienteDefinitivo = "0.0";

            $coeficiente->save();
            
        }
        else
        {
            $coeficiente = new Coeficiente();
            $coeficiente->IdUso = $request->uso_id;
            $coeficiente->VentasNetas = $request->ventaneta;
            $coeficiente->NroVentasNetas = $request->nroventaneta;

            $coeficiente->IngresosFinancierosGravados = $request->ingresosfiancierosgravados;
            $coeficiente->NroIngresosFinancierosGravados = $request->nroingresosfiancierosgravados;

            $coeficiente->OtrosIngresosGravados = $request->ingresosgravados;
            $coeficiente->NroOtrosIngresosGravados = $request->nroingresosgravados;

            $coeficiente->OtrosIngresosNoGravados = $request->ingresosnogravados;
            $coeficiente->NroOtrosIngresosNoGravados = $request->nroingresosnogravados;

            $coeficiente->EnajenaciónValoresBienesAF = $request->enajenacion;
            $coeficiente->NroEnajenaciónValoresBienesAF = $request->nroenajenacion;

            $coeficiente->REI = $request->rei;
            $coeficiente->NroREI = $request->nrorei;
            
            $coeficiente->TotalIngresosNetos = $request->totalneto;
            $coeficiente->NroTotalIngresosNetos = "0.0";

            $coeficiente->IngresoDiferenciaCambio = $request->ingresosdiferenciacambio;
            $coeficiente->NroIngresoDiferenciaCambio = "0.0";

            $coeficiente->IngresosNetos = $request->ingresosnetos;
            $coeficiente->NroIngresosNetos = "0.0";

            $coeficiente->ImpuestoCalculado = $request->impuestocalculado;
            $coeficiente->NroImpuestoCalculado = $request->nroimpuestocalculado;

            $coeficiente->Coeficiente = $request->coeficiente;
            $coeficiente->NroCoeficiente = "0.0";

            $coeficiente->CoeficienteFinal = $request->coeficientefinal;
            $coeficiente->NroCoeficienteFinal = "0.0";

            $coeficiente->CoeficienteSUNAT = $request->coeficientesunat;
            $coeficiente->NroCoeficienteSUNAT = "0.0";

            $coeficiente->CoeficientePDT = $request->coeficientepdt;
            $coeficiente->NroCoeficientePDT = "0.0";

            $coeficiente->CoeficienteDefinitivo = $request->coeficientedefinitivo;
            $coeficiente->NroCoeficienteDefinitivo = "0.0";

            $coeficiente->save();
            
        }
        return view('modules.reporte.coeficiente',['uso'=>$uso,'coeficiente'=>$coeficiente]);
    }

}
