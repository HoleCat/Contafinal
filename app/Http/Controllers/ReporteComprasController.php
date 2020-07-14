<?php

namespace App\Http\Controllers;

use App\Clases\Almacenamiento;
use App\Clases\Modelosgenerales\Archivo;
use App\Clases\Reporte\Coeficiente;
use App\Clases\Reporte\Credito;
use App\Clases\Reporte\DetraccionCompras;
use App\Clases\Reporte\Prorrata;
use App\Clases\Reporte\Renta;
use App\Clases\Reporte\ReporteCompras;
use App\Clases\Reporte\ResultadoRuc;
use App\Clases\Reporte\ValidacionReporteCompras;
use App\Clases\Reporte\ValidacionReporteVenta;
use App\Clases\Uso;
use App\Formatos\Excelmuestreo;
use App\Formatos\Txtexportaciones;
use App\Formatos\Validacion;
use App\Imports\DetraccionComprasImport;
use App\Imports\RentasImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use ZipArchive;

class ReporteComprasController extends Controller
{

    public function index()
    {
        $tipo = 21;
        $tipocompras = 22;
        if(Auth::check()){
            $idusuario = Auth::user()->id;
            $countreportes = Uso::where('idusuario','=',$idusuario)->where('idtipo','=',$tipo)->count();
            $historico = DB::table('usos')->where('idtipo','=',$tipocompras)->get();
            if($countreportes>0)
            {
                $uso = DB::table('usos')
                ->where('idusuario','=',$idusuario)
                ->where('idtipo','=',$tipo)
                ->latest()
                ->first();
                $countreportescompras = Uso::where('idusuario','=',$idusuario)->where('uso_id','=',$uso->id)->where('idtipo','=',$tipocompras)->count();
                if($countreportescompras>0)
                {
                    $reportecompras = DB::table('usos')
                    ->where('idusuario','=',$idusuario)
                    ->where('uso_id','=',$uso->id)
                    ->where('idtipo','=',$tipocompras)
                    ->latest()
                    ->first();

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
                        $coeficiente->NroTotalIngresosNetos = "0.0";

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
                }
                else
                {
                    $reportecompras = new Uso();
                    $reportecompras->idusuario = $idusuario;
                    $reportecompras->uso_id = $uso->id;
                    $reportecompras->idtipo = $tipocompras;
                    $reportecompras->referencia = 'referencia de ejemplo reporte de compras';
                    $reportecompras->save();

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
                        $coeficiente->NroTotalIngresosNetos = "0.0";

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
                }
            }
            else
            {
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
            }
        }
    }

    
    public function Importar(Request $request)
    {
        if($request->hasFile('myfile'))
        {
            $uso_id = $request->iduso;
            $nombre = $request->nombrearchivo;
            $user_id = Auth::user()->id;
            $tipo = 'registro de compras';

            $archivo = new Archivo();
            $archivo->user_id = $user_id;
            $archivo->uso_id = $uso_id;
            $archivo->ruta = $nombre;
            $archivo->tipo = $tipo;
            
            $archivo->save();

            $id_archivo = $archivo->id;
            
            try
            {
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
                    $registro = new ValidacionReporteCompras([
                        'Liberar'=> 'no',
                        'Status'=> 'no',
                        'IdUso'=>$uso_id,
                        'IdArchivo'=>$id_archivo,
                        'Periodo'=> $row[0],
                        'Correlativo'=> $row[1],
                        'Orden'=> $row[2],
                        'FecEmision'=> $row[3],
                        'FecVenci'=> $row[4],
                        'TipoComp'=> $row[5],
                        'NumSerie'=> $row[6],
                        'AnoDua'=> $row[7],
                        'NumComp'=> Validacion::Completarcomprobante($row[8],7),
                        'NumTicket'=> $row[9],
                        'TipoDoc'=> $row[10],
                        'NroDoc'=> $row[11],
                        'Nombre'=> $row[12],
                        'BIAG1'=> $row[13],
                        'IGVIPM1'=> $row[14],
                        'BIAG2'=> $row[15],
                        'IGVIPM2'=> $row[16],
                        'BIAG3'=> $row[17],
                        'IGVIPM3'=> $row[18],
                        'AdqGrava'=> $row[19],
                        'ISC'=> $row[20],
                        'Otros'=> $row[21],
                        'Total'=> $row[22],
                        'Moneda'=> $row[23],
                        'TipoCam'=> $row[24],
                        'FecOrigenMod'=> $row[25],
                        'TipoCompMod'=> $row[26],
                        'NumSerieMod'=> $row[27],
                        'AnoDuaMod'=> $row[28],
                        'NumSerComOriMod'=> $row[29],
                        'FecConstDetrac'=> $row[30],
                        'NumConstDetrac'=> $row[31],
                        'Retencion'=> $row[32],
                        'ClasifBi'=> $row[33],
                        'Contrato'=> $row[34],
                        'ErrorT1'=> $row[35],
                        'ErrorT2'=> $row[36],
                        'ErrorT3'=> $row[37],
                        'ErrorT4'=> $row[38],
                        'MedioPago'=> $row[39],
                        'Estado'=> $row[40]
                    ]);
                    $registro->save();
                }

                $validacion = DB::table('validacion_reporte_compras')
                ->leftjoin('detraccion_compras', 'detraccion_compras.NumeroComprobante', '=', 'validacion_reporte_compras.Numcomp')
                ->leftjoin('d_t_r_s', 'detraccion_compras.TipoBien', '=', 'd_t_r_s.COD')
                ->select('validacion_reporte_compras.id as IdCool','validacion_reporte_compras.*','detraccion_compras.*','d_t_r_s.*')
                ->where('validacion_reporte_compras.iduso','=',$request->iduso)->get();

                $compras = Archivo::where('uso_id','=',$uso_id)->where('tipo','=','registro de compras')->get();

                $detracciones = Archivo::where('uso_id','=',$uso_id)->where('tipo','=','detraccion')->get();

                return ['detracciones'=>$detracciones,'compras'=>$compras,'validacion'=>$validacion];
            }
            catch(\Throwable $th)
            {
                DB::table('validacion_reporte_compras')->where('IdArchivo','=',$id_archivo)->delete();
                DB::table('archivos')->where('id','=',$id_archivo)->delete();
                return ['errortec'=>$th->getMessage(),'error'=>"Pruebe recargando la pagina, o revisando si su archivo tiene las columnas en el orden que se plantea en las plantillas."];
            }

        } else {
        
            return ['error'=>'Debes enviar un archivo'];
        
        }
    }

    public function ImportarDetraccion(Request $request)
    {
        
        if($request->hasFile('myfile'))
        {
            try
            {
                if($request->csv && $request->excel)
                {
                    return ['error'=>"DEBES SELECCIONAR SOLO UNA OPCION"];
                }
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
                    $archivo->tipo = 'detraccion';
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
                                if($i2 == 12){
                                    $row[$i2] = null;
                                }else{
                                    $row[$i2] = null;
                                }
                            }
                        }
                        
                        if($row[9]!=null)
                        {
                            try {
                                $row[9] = str_replace("-", "/", $row[9]);
                            } catch (\Throwable $th) {
                                try {
                                    $row[9] = $row[9];
                                    $row[9] = str_replace(".", "/", $row[9]);
                                    $row[9] = str_replace("-", "/", $row[9]);
                                } catch (\Throwable $th) {
                                    $row[9] = null;
                                }
                            }
                        }
                        $registro = new DetraccionCompras([
                            'IdUso'=>$uso_id,
                            'IdArchivo'=>$id_archivo,
                            'TipoCuenta'=>$row[0],
                            'NumeroCuenta'=>$row[1],
                            'NumeroConstancia'=>$row[2],
                            'PeriodoTributario'=>$row[3],
                            'RucProveedor'=>$row[4],
                            'NombreProveedor'=>$row[5],
                            'TipoDocumentoAdquiriente'=>$row[6],
                            'NumeroDocumentoAdquiriente'=>$row[7],
                            'RazonSocialAdquiriente'=>$row[8],
                            'FechaPago'=>$row[9],
                            'MontoDeposito'=>$row[10],
                            'TipoBien'=>Validacion::Completarcomprobante($row[11],3),
                            'TipoOperacion'=>$row[12],
                            'TipoComprobante'=>$row[13],
                            'SerieComprobante'=>$row[14],
                            'NumeroComprobante'=>Validacion::Completarcomprobante($row[15],7),
                            'NumeroPagoDetraciones'=>$row[16],
                            'ValidacionPorcentual'=>$row[17],
                            'Base'=>"",
                            'ValidacionBase'=>"",
                            'TipoServicio'=>"",
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
                    $archivo->tipo = 'detraccion';
                    $archivo->save();

                    $id_archivo = $archivo->id;
                    
                    $ruta = Almacenamiento::guardartemporalmente($username,$request->file('myfile'));
                    
                    Excelmuestreo::aumentarcolumnasdefault($ruta,$uso_id,$id_archivo);
                    
                    Excel::import(new DetraccionComprasImport, $ruta);

                    //$spreadsheet = IOFactory::load($ruta);

                    Storage::deleteDirectory('public/'.$useremail.'/temporal', true);
                    // sleep 1 second because of race condition with HD
                    sleep(1);
                    // actually delete the folder itself
                    Storage::deleteDirectory('public/'.$useremail.'/temporal');
                }

                $compras = Archivo::where('uso_id','=',$uso_id)->where('tipo','=','detraccion')->get();
                $detracciones = Archivo::where('uso_id','=',$uso_id)->where('tipo','=','detraccion')->get();

                $dtr = DB::table('detraccion_compras')
                ->leftjoin('d_t_r_s', 'detraccion_compras.TipoBien', '=', 'd_t_r_s.COD')
                ->select('detraccion_compras.*', 'd_t_r_s.*')
                ->where('iduso','=',$request->iduso)->get();

                if(count($dtr)>0)
                {
                    return ['detracciones'=>$detracciones,'compras'=>$compras,'dtr'=>$dtr];
                }
                else 
                {
                    $dtr = DB::table('detraccion_compras')
                    ->leftjoin('d_t_r_s', 'detraccion_compras.TipoBien', '=', 'd_t_r_s.MCOD')
                    ->select('detraccion_compras.*', 'd_t_r_s.*')
                    ->where('iduso','=',$request->iduso)->get();

                    return ['detracciones'=>$detracciones,'compras'=>$compras,'dtr'=>$dtr];
                }      
            }
            catch
            (\Throwable $th)
            {
                DB::table('detraccion_compras')->where('IdArchivo','=',$id_archivo)->delete();
                DB::table('archivos')->where('id','=',$id_archivo)->delete();
                return ["errortec"=>$th->getMessage(),'error'=>"Revise sus campos, verifique que su delimitador, recargue la pagina si a pasado tiempo sin usar el app, su session puede haber terminado, se elimino el archivo con id ".$id_archivo.""]; 
            }
            
        }
        else 
        {
            return ['error'=>"DEBES ENVIAR UN ARCHIVO"];
        }

    }

    public function Liberar(Request $request)
    {
        try
        {
            $registro = ValidacionReporteCompras::find($request->id);
        
            if($registro->Liberar == 'no'){
                $registro = DB::table('validacion_reporte_compras')
                ->where('id', $request->id)
                ->update(['Liberar' => 'si']);
                return $registro;
            }
            else
            {
                $registro = DB::table('validacion_reporte_compras')
                ->where('id', $request->id)
                ->update(['Liberar' => 'no']);
                return $registro;
            }
        }
        catch(\Throwable $th)
        {
            return ["errortec"=>$th->getMessage(),'error'=>"Su session puede haber terminado, recargue la pagina, si el error persiste comunicar a soporte."]; 
        }
        
    }

    public function Status(Request $request)
    {
        try
        {
            $registro = ValidacionReporteCompras::find($request->id);
            if($registro->Status == 'no'){
                $registro = DB::table('validacion_reporte_compras')
                ->where('id', $request->id)
                ->update(['Status' => 'si']);
                return $registro;
            }
            else
            {
                $registro = DB::table('validacion_reporte_compras')
                ->where('id', $request->id)
                ->update(['Status' => 'no']);
                return $registro;
            }
        }catch(\Throwable $th)
        {
            return ["errortec"=>$th->getMessage(),'error'=>"Revise sus campos, y que tenga data con esas variables, recargue la pagina si a pasado tiempo sin usar el app, su session puede haber terminado"]; 
        }
        
    }
   
    public function Data(Request $request)
    {
        try{
            $compras = DB::table('archivos')->where('uso_id','=',$request->iduso)->where('tipo','=','registro de compras')->get();
            $detracciones = Archivo::where('uso_id','=',$request->iduso)->where('tipo','=','detraccion')->get();
            $resultadoruc = ResultadoRuc::where('IdUso','=',$request->iduso)->get();
            $archivosruc = DB::table('archivos')->where('uso_id','=',$request->iduso)->where('tipo','=','resultado ruc')->get();
            $dtr = DB::table('detraccion_compras')
            ->leftjoin('d_t_r_s', 'detraccion_compras.TipoBien', '=', 'd_t_r_s.COD')
            ->select('detraccion_compras.*', 'd_t_r_s.*')
            ->where('iduso','=',$request->iduso)->get();
            $archivosrentas = Archivo::where('uso_id','=',$request->iduso)->where('tipo','=','reporte venta')->get();
            $rentas = DB::table('rentas')
            ->where('iduso','=',$request->iduso)->get();
            $archivosventas = Archivo::where('uso_id','=',$request->iduso)->where('tipo','=','reporte ventas')->get();
            $ventas = DB::table('validacion_reporte_ventas')
            ->where('iduso','=',$request->iduso)->get();
            $coeficiente = DB::table('coeficientes')
                ->where('IdUso','=',$request->iduso)
                ->latest()
                ->first();
            $prorratas = DB::table('prorratas')->where('IdUso','=',$request->iduso)->get();
            $creditos = DB::table('creditos')->where('IdUso','=',$request->iduso)->get();
            
            $validacion = DB::table('validacion_reporte_compras')
            ->leftjoin('detraccion_compras', 'detraccion_compras.NumeroComprobante', '=', 'validacion_reporte_compras.Numcomp')
            ->leftjoin('d_t_r_s', 'detraccion_compras.TipoBien', '=', 'd_t_r_s.COD')
            ->select('validacion_reporte_compras.id as IdCool','validacion_reporte_compras.*','detraccion_compras.*','d_t_r_s.*')
            ->where('validacion_reporte_compras.iduso','=',$request->iduso)->get();
            return ['creditos'=>$creditos,'prorratas'=>$prorratas,'coeficiente'=>$coeficiente,'ventas'=>$ventas,'archivosventas'=>$archivosventas,'archivosrentas'=>$archivosrentas,'rentas'=>$rentas,'archivosruc'=>$archivosruc,'resultadoruc'=>$resultadoruc,'detracciones'=>$detracciones,'compras'=>$compras,'dtr'=>$dtr,'validacion'=>$validacion];      

        }
        catch(\Throwable $th)
        {
            return ["errortec"=>$th->getMessage(),'error'=>"Revise sus campos, y que tenga data con esas variables, recargue la pagina si a pasado tiempo sin usar el app, su session puede haber terminado"]; 
        }
       
    }

    public function Txtconsultaruc(Request $request)
    {
        //1. CONTENIDO
        $user = Auth::user();
        
        if($request->tipo == 'ventas'){
            $data = DB::table('validacion_reporte_ventas')
            ->leftjoin('detraccion_compras', 'detraccion_compras.NumeroComprobante', '=', 'validacion_reporte_ventas.Numcomp')
            ->leftjoin('d_t_r_s', 'detraccion_compras.TipoBien', '=', 'd_t_r_s.COD')
            ->select('validacion_reporte_ventas.id as IdCool','validacion_reporte_ventas.*','detraccion_compras.*','d_t_r_s.*')
            ->where('validacion_reporte_ventas.iduso','=',$request->iduso)
            ->get();
        }
        else
        {
            $data = DB::table('validacion_reporte_compras')
            ->leftjoin('detraccion_compras', 'detraccion_compras.NumeroComprobante', '=', 'validacion_reporte_compras.Numcomp')
            ->leftjoin('d_t_r_s', 'detraccion_compras.TipoBien', '=', 'd_t_r_s.COD')
            ->select('validacion_reporte_compras.id as IdCool','validacion_reporte_compras.*','detraccion_compras.*','d_t_r_s.*')
            ->where('validacion_reporte_compras.iduso','=',$request->iduso)
            ->get();
        }
        

        $content = "";
        
        //2. ESPACIO

        $path = public_path('storage\\ZIP\\'.$user->email.'\\temporal\\');

        if(!File::isDirectory($path)){

            File::makeDirectory($path, 0777, true, true);

        } else 
        {
            File::deleteDirectory($path);
            File::makeDirectory($path, 0777, true, true);
        }

        //3. ARCHIVOS
        $guia = 0;
        $guiazip = 0;
        $archivos = [];
        $cantidad = count($data);
        
        foreach ($data as $element) {
            $guia = $guia + 1;
            if($guia%100==0)
            {
                $content = $content.$element->NroDoc."|".$element->TipoComp."|".$element->NumSerie."|".$element->NumComp."|".$element->FecEmision."|".$element->Total."\n";
                array_push($archivos,$content);
                $content = "";
            }
            else if($cantidad==$guia)
            {
                if($guia<100)
                {
                    $content = $content.$element->NroDoc."|".$element->TipoComp."|".$element->NumSerie."|".$element->NumComp."|".$element->FecEmision."|".$element->Total."\n";
                    array_push($archivos,$content);
                    $content = "";
                }
                if($guia>100)
                {
                    $content = $content.$element->NroDoc."|".$element->TipoComp."|".$element->NumSerie."|".$element->NumComp."|".$element->FecEmision."|".$element->Total."\n";
                    array_push($archivos,$content);
                    $content = "";
                }
            }
            else
            {
                $content = $content.$element->NroDoc."|".$element->TipoComp."|".$element->NumSerie."|".$element->NumComp."|".$element->FecEmision."|".$element->Total."\n";
            }
        }
        
        $rutas = [];
        for ($i=0; $i < count($archivos); $i++) { 
            $guiazip = $guiazip + 1;
            $content = $archivos[$i];
            File::makeDirectory($path."zip".$guiazip."\\", 0777, true, true);
            File::put($path."zip".$guiazip."\\zip".$guiazip.".txt", $content);
            $ruta = $path."zip".$guiazip."\\";
            array_push($rutas,$ruta);
        }
        
        //return $rutas;
        //3. ZIPEO
        $pathzip = public_path("storage\\ZIP\\".$user->email."\\zips\\");

        if(!File::isDirectory($pathzip)){

            File::makeDirectory($pathzip, 0777, true, true);

        } else 
        {
            File::deleteDirectory($pathzip);
            File::makeDirectory($pathzip, 0777, true, true);
        }

        $resultado = [];
        
        for ($i=0; $i < count($rutas); $i++) { 
            $pathdir = $rutas[$i];  
            $zipcreated = public_path("storage\\ZIP\\".$user->email."\\zips\\zipruc".$i.".zip"); 
            $ziptoken = Storage::url("ZIP/".$user->email."\\zips\\zipruc".$i.".zip");
            $zip = new ZipArchive; 

            if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) { 
        
                // Store the path into the variable 
                $dir = opendir($pathdir); 
                
                while($file = readdir($dir)) { 
                    if(is_file($pathdir.$file)) { 
                        $zip -> addFile($pathdir.$file, $file); 
                    } 
                } 
                $zip ->close(); 
            }
            $ruta = (object) array("ruta" => $ziptoken);
            array_push($resultado,$ruta);
        }
        return view('herramientas.mantenedores.descargables',['resultados'=>$resultado]);
        //return $resultado;
    }

    public function Resultadoconsultaruc(Request $request) {
        try
        {
            $user = Auth::user();
            $path = public_path('storage\\ZIP\\'.$user->email.'\\ructemporal\\');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            else {
                File::deleteDirectory($path);
                File::makeDirectory($path, 0777, true, true);
            }

            $file = $request->file('myfile');
            
            $ruta = $file->move('storage/ZIP/'.$user->email.'/ructemporal/',$file->getClientOriginalName());
            //return $ruta;
            //$zipcreated = public_path('storage\\ZIP\\'.$user->email.'\\ructemporal\\'.$file->getClientOriginalName()); 
        
            $zip = new ZipArchive; 
            $zip->open($ruta); 
            $zip->extractTo($path); 
            $zip->close();

            $files = File::allFiles($path);
            foreach ($files as $file) {
                
                if($file->getExtension()=="txt")
                {
                    try
                    {
                        $archivo = new Archivo();
                    $archivo->user_id = $user->id;
                    $archivo->uso_id = $request->iduso;
                    $archivo->ruta = $request->nombrearchivo;
                    $archivo->tipo = 'resultado ruc';
                    $archivo->save();

                    $id_archivo = $archivo->id;

                    if($request->delimitador == null)
                    {
                        return ["error"=>"Olvido decirnos que delimitador esta usando"];
                    }
                    else
                    {
                        $data = Txtexportaciones::csv_to_array($file,$request->delimitador);
                    }
                    
                    for ($i=0; $i < count($data); $i++) { 
                        $row = $data[$i];
                        $registro = new ResultadoRuc([
                            'IdUso'=>$request->iduso,
                            'IdArchivo'=>$id_archivo,
                            'NumeroRuc'=>$row[0],
                            'RazonSocial'=>$row[1],
                            'TipoContribuyente'=>$row[2],
                            'ProfesionOficio'=>$row[3],
                            'NombreComercial'=>$row[4],
                            'CondicionContribuyente'=>$row[5],
                            'EstadoContribuyente'=>$row[6],
                            'FechaInscripcion'=>$row[7],
                            'FechaInicioActividades'=>$row[8],
                            'Departamento'=>$row[9],
                            'Provincia'=>$row[10],
                            'Distrito'=>$row[11],
                            'Direccion'=>$row[12],
                            'Telefono'=>$row[13],
                            'Fax'=>$row[14],
                            'ActividadComercioExterior'=>$row[15],
                            'PrincipalCIIU'=>$row[16],
                            'CIIU1'=>$row[17],
                            'CIIU2'=>$row[18],
                            'RUS'=>$row[19],
                            'BuenContribuyente'=>$row[20],
                            'AgenteRetencion'=>$row[21],
                            'AgentePercepcionVtaInt'=>$row[22],
                            'AgentePercepcionComLiq'=>$row[23]
                        ]);
                        $registro->save();
                    }
                    }
                    catch(\Throwable $th)
                    {
                        DB::table('resultado_rucs')->where('IdArchivo','=',$id_archivo)->delete();
                        DB::table('archivos')->where('id','=',$id_archivo)->delete();
                        return ["errortec"=>$th->getMessage(),'error'=>"Revise sus campos, debe entregar el zip que adquirio de la sunat, verifique que su delimitador, recargue la pagina si a pasado tiempo sin usar el app, su session puede haber terminado, se elimino el archivo con id ".$id_archivo.""]; 
                    }
                    
                }
            }
            $resultado = ResultadoRuc::where('IdUso','=',$request->iduso)->get();
            $archivos = DB::table('archivos')->where('uso_id','=',$request->iduso)->where('tipo','=','resultado ruc')->get();
            return ['resultado'=>$resultado,'archivos'=>$archivos];
        }
        catch(\Throwable $th)
        {
            return ["errortec"=>$th->getMessage(),'error'=>"Revise sus campos, debe entregar el zip que adquirio de la sunat, verifique que su delimitador, recargue la pagina si a pasado tiempo sin usar el app, su session puede haber terminado"]; 
        }
    }
    
    public function Txtcomprobantes(Request $request)
    {
        //config
        $user = Auth::user();
        $path = public_path('storage\\ZIP\\'.$user->email.'\\comprobantes\\');
        if($request->tipo == "ventas"){
            $data = ValidacionReporteVenta::where('IdUso','=',$request->iduso)->get();
        }else{
            $data = ValidacionReporteCompras::where('IdUso','=',$request->iduso)->get();
        }
        
        if(!File::isDirectory($path)){

            File::makeDirectory($path, 0777, true, true);

        } else 
        {
            File::deleteDirectory($path);
            File::makeDirectory($path, 0777, true, true);
        }

        $content = "";
        $guia = 0;
        $guiazip = 0;
        $archivos = [];
        $cantidad = count($data);
        
        foreach ($data as $element) {
            $guia = $guia + 1;
            if($guia%100==0)
            {
                $content = $content.$element->NroDoc."|"."\n";
                array_push($archivos,$content);
                $content = "";
            }
            else if($cantidad==$guia)
            {
                if($guia<100)
                {
                    $content = $content.$element->NroDoc."|"."\n";
                    array_push($archivos,$content);
                    $content = "";
                }
                if($guia>100)
                {
                    $content = $content.$element->NroDoc."|"."\n";
                    array_push($archivos,$content);
                    $content = "";
                }
            }
            else
            {
                $content = $content.$element->NroDoc."|"."\n";
            }
        }

        $resultado = [];
        for ($i=0; $i < count($archivos); $i++) { 
            $guiazip = $guiazip + 1;
            $content = $archivos[$i];
            //File::makeDirectory($path."zip".$guiazip."\\", 0777, true, true);
            File::put($path."\\zip".$guiazip.".txt", $content);
            $filetoken = Storage::url("ZIP/".$user->email."\\comprobantes\\zip".$guiazip.".txt");
            $ruta = (object) array("ruta" => $filetoken);
            array_push($resultado,$ruta);
        }

        return view('herramientas.mantenedores.descargables',['resultados'=>$resultado]);

    }
    
    public function GuardarProrrata(Request $request)
    {
        $count = DB::table('prorratas')->where('IdUso','=',$request->iduso)->count();
        if($count > 0)
        {
            DB::table('prorratas')->where('IdUso','=',$request->iduso)->delete();
            $prorratas = json_decode($request->data);
            //return $prorratas;
            for ($i=0; $i < count($prorratas); $i++) { 
                $row = $prorratas[$i];
                $prorrata = new Prorrata();
                $prorrata->IdUso = $request->iduso;
                $prorrata->Orden = $row->Orden;
                $prorrata->Periodo = $row->Periodo;
                $prorrata->VentasNacionalesGravadas = $row->VentasNacionalesGravadas;
                $prorrata->Exportaciones = $row->Exportaciones;
                $prorrata->VentasNoGravadas = $row->VentasNoGravadas;
                $prorrata->boletasexoneradas = $row->boletasexoneradas;
                $prorrata->NCBOLETASEXONE = $row->NCBOLETASEXONE;
                $prorrata->TotalVtasNoGrav = $row->TotalVtasNoGrav;
                $prorrata->save();
            }
        }
        else
        {
            $prorratas = json_decode($request->data);
        
            for ($i=0; $i < count($prorratas); $i++) { 
                $row = $prorratas[$i];
                $prorrata = new Prorrata();
                $prorrata->IdUso = $request->iduso;
                $prorrata->Orden = $row->Orden;
                $prorrata->Periodo = $row->Periodo;
                $prorrata->VentasNacionalesGravadas = $row->VentasNacionalesGravadas;
                $prorrata->Exportaciones = $row->Exportaciones;
                $prorrata->VentasNoGravadas = $row->VentasNoGravadas;
                $prorrata->boletasexoneradas = $row->boletasexoneradas;
                $prorrata->NCBOLETASEXONE = $row->NCBOLETASEXONE;
                $prorrata->TotalVtasNoGrav = $row->TotalVtasNoGrav;
                $prorrata->save();
            }
        }

        return DB::table('prorratas')->where('IdUso','=',$request->iduso)->get();
    }

    public function GuardarCredito(Request $request)
    {
        $count = DB::table('creditos')->where('IdUso','=',$request->iduso)->count();
        if($count > 0)
        {
            DB::table('creditos')->where('IdUso','=',$request->iduso)->delete();
            $creditos = json_decode($request->data);
        
            for ($i=0; $i < count($creditos); $i++) { 
                $row = $creditos[$i];
                $credito = new Credito();
                $credito->IdUso = $request->iduso;
                $credito->Orden = $row->Orden;
                $credito->Mes = $row->Mes;
                $credito->Ir = $row->Ir;
                $credito->Credito = $row->Credito;
                $credito->Saldo = $row->Saldo;
                $credito->Itan = $row->Itan;
                $credito->save();
            }
        }
        else
        {
            $creditos = json_decode($request->data);
            
            for ($i=0; $i < count($creditos); $i++) { 
                $row = $creditos[$i];
                $credito = new Credito();
                $credito->IdUso = $request->iduso;
                $credito->Mes = $row->Mes;
                $credito->Ir = $row->Ir;
                $credito->Credito = $row->Credito;
                $credito->Saldo = $row->Saldo;
                $credito->Itan = $row->Itan;
                $credito->save();
            }
        }

        return DB::table('creditos')->where('IdUso','=',$request->iduso)->get();
    }

    public function ExportarReporte(Request $request) {

        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        
        $ruta = public_path('/assets/files/reporte.xlsx');
        
        $spreadsheet = IOFactory::load($ruta);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', $request->empresa);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B2', $request->ruc);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B3', $request->periodo);
        
        $cell_order_compras = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
        "AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ",
        "BA","BB","BC","BD","BE","BF","BG","BH");
        
        $columnas_compras = [
            '','Liberar','','Status','Periodo','Correlativo','Orden','FecEmision','FecVenci','TipoComp','NumSerie','AnoDua','NumComp',
            'NumTicket','TipoDoc','NroDoc','Nombre','BIAG1','IGVIPM1','BIAG2','IGVIPM2','BIAG3','IGVIPM3',
            'AdqGrava','ISC','Otros','Total','Moneda','TipoCam','FecOrigenMod','TipoCompMod','NumSerieMod',
            'AnoDuaMod','NumSerComOriMod','FecConstDetrac','NumConstDetrac','Retencion','ClasifBi','Contrato',
            'ErrorT1','ErrorT2','ErrorT3','ErrorT4','MedioPago','Estado','','NumeroConstancia','FechaPago','Comentario','',"BuenContribuyente","AgenteRetencion","AgentePercepcionVtaInt","AgentePercepcionComLiq","ActividadComercioExterior",
            "EstadoContribuyente","CondicionContribuyente","","IGVRES","IGVFLAG"];
        
        $array_data_compras = DB::table('validacion_reporte_compras')
        ->rightjoin('detraccion_compras', 'detraccion_compras.NumeroComprobante', '=', 'validacion_reporte_compras.Numcomp')
        ->select('validacion_reporte_compras.*','detraccion_compras.*')
        ->where('validacion_reporte_compras.IdUso','=',$request->iduso)->get();
        
        $cont_compras = 6;
        $min = 0.5;
        Excelmuestreo::poner_data_1($min,$request->iduso,$cont_compras,$spreadsheet,$array_data_compras,$columnas_compras,$cell_order_compras);
        
        $spreadsheet->getActiveSheet()->setTitle('Registro de compras');

        $cell_order_ventas = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
        "AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN");
        $ruc = array("AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ",
        "BA","BB","BC","BD","BE","BF","BG","BH");
        //,"BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"

        $columnas_ventas = [
            '','Periodo','Correlativo','Ordenado','FecEmision','FecVenci',
			'TipoComp','NumSerie','NumComp','NumTicket','TipoDoc','NroDoc','Nombre','Export',
			'BI','Desci','IGVIPMBI','IGVIPMDesc','ImporteExo','ImporteIna','ISC','BIIGVAP',
			'IGVAP','Otros','Total','Moneda','TipoCam','FecOrigenMod','TipoCompMod','NumSerieMod',
			'NumDocMod','Contrato','ErrorT1','MedioPago','Estado',"","Validacion","ObservacionValidacion","","Conteo"
        ];
        
        $array_data_ventas = DB::table('validacion_reporte_ventas')
        ->where('IdUso','=',$request->iduso)
        ->orderBy('NumSerie', 'asc')
        ->orderBy('NumComp', 'asc')
        ->get();

        $spreadsheet->setActiveSheetIndex(1);

        $ventasmin = 0.5; 
        $cont_ventas = 6;
        Excelmuestreo::poner_data_2($ventasmin,$request->iduso,$cont_ventas,$spreadsheet,$array_data_ventas,$columnas_ventas,$cell_order_ventas);

        $spreadsheet->getActiveSheet()->setTitle('Registro De Ventas');

        $cell_order_detraccion = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W");
        
        $columnas_detraccion = [
            '','Cuo','TipoCuenta','NumeroCuenta','NumeroConstancia','PeriodoTributario','RucProveedor',
            'NombreProveedor','TipoDocumentoAdquiriente','NumeroDocumentoAdquiriente','RazonSocialAdquiriente','FechaPago',
            'MontoDeposito','TipoBien','TipoOperacion','TipoComprobante','SerieComprobante','NumeroComprobante','NumeroPagoDetraciones',
            'Porcentaje','Base','ValidacionBase','Denominacion'
        ];
        
        $array_data_detraccion = DB::table('detraccion_Compras')
        ->rightjoin('d_t_r_s', 'd_t_r_s.COD', '=', 'detraccion_Compras.TipoBien')
        ->select('detraccion_compras.*','d_t_r_s.*')
        ->where('IdUso','=',$request->iduso)
        ->get();

        //return print_r($array_data_detraccion);

        $spreadsheet->setActiveSheetIndex(2);

        $detraccionmin = 0.5; 
        $cont_detraccion = 6;
        Excelmuestreo::poner_data_3(2,$cont_detraccion,$spreadsheet,$array_data_detraccion,$columnas_detraccion,$cell_order_detraccion);

        $spreadsheet->getActiveSheet()->setTitle('Detraccion');

        $cell_order_renta = array("A","B","C","D","E");
        
        $columnas_renta = ['','Numero','Nombrecuenta','Acumulado'];
        
        $array_data_renta = DB::table('rentas')
        ->where('IdUso','=',$request->iduso)
        ->get();

        /*$years_renta = DB::table('rentas')
        ->select('año as year')
        ->distinct('año')
        ->orderBy('año','asc')
        ->where('IdUso','=',$request->iduso)
        ->get();*/

        //return $years_renta;

        $spreadsheet->setActiveSheetIndex(3);

        $rentamin = 0.5; 
        $cont_renta = 6;
       //Excelmuestreo::poner_data_4($years_renta,3,$cont_renta,$spreadsheet,$array_data_renta,$columnas_renta,$cell_order_renta);
       Excelmuestreo::poner_data_4(3,$cont_renta,$spreadsheet,$array_data_renta,$columnas_renta,$cell_order_renta);

        $spreadsheet->getActiveSheet()->setTitle('Rentas');

        ////////////////////////////////////////////////////////////////////////////
        
        $array_data_coeficiente = DB::table('coeficientes')
        ->where('IdUso','=',$request->iduso)
        ->get();

        //return $years_renta;

        $spreadsheet->setActiveSheetIndex(4);

        Excelmuestreo::poner_data_5($spreadsheet,$array_data_coeficiente);

        $spreadsheet->getActiveSheet()->setTitle('coeficiente');


        /////////////////////////////////////////////////////////////////////
        
        
        $cell_order_prorrata = array("A","B","C","D","E","F","G","H");
        
        $columnas_prorrata = [
            '','Periodo','VentasNacionalesGravadas','Exportaciones','VentasNoGravadas','boletasexoneradas','NCBOLETASEXONE','TotalVtasNoGrav'
        ];
        
        $array_data_prorrata = DB::table('prorratas')
        ->where('IdUso','=',$request->iduso)
        ->get();

        $spreadsheet->setActiveSheetIndex(5);

         
        $cont_prorrata = 6;
        Excelmuestreo::poner_data_6(5,$cont_prorrata,$spreadsheet,$array_data_prorrata,$columnas_prorrata,$cell_order_prorrata);

        $spreadsheet->getActiveSheet()->setTitle('Prorrata');

        /////////////////////////////////////////////////////////////////////

        $cell_order_credito = array("A","B","C","D","E","F");
        
        $columnas_credito = [
            '','Mes','Ir','Credito','Saldo','Itan'
        ];
        
        $array_data_credito = DB::table('creditos')
        ->where('IdUso','=',$request->iduso)
        ->get();

        $spreadsheet->setActiveSheetIndex(6);

         
        $cont_credito = 6;
        Excelmuestreo::poner_data_6(6,$cont_credito,$spreadsheet,$array_data_credito,$columnas_credito,$cell_order_credito);

        $spreadsheet->getActiveSheet()->setTitle('Creditos');

        /////////////////////////////////////////////////////////////////////
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reportecompras.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}