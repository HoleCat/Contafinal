<?php

namespace App\Http\Controllers;

use App\Clases\Activos\Activofijo;
use App\Clases\Almacenamiento;
use App\Clases\Modelosgenerales\Archivo;
use App\Clases\Uso;
use App\Formatos\Excelmuestreo;
use App\Formatos\Txtexportaciones;
use App\Imports\ActivofijosImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ActivofijoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        if(Auth::check()){
            $tipo = 17;
            $uso_id = 0;
            $idusuario = Auth::user()->id;
            $contadorusoactivos = DB::table('usos')->where('idusuario','=',$idusuario)->where('idtipo','=',$tipo)->count();
            $historico = DB::table('usos')->where('idtipo','=',$tipo)->get();
            $aprobadores = DB::table('aprobadors')->where('user_id','=',Auth::user()->id)->get();
            
            if($contadorusoactivos > 0)
            {
                $uso = DB::table('usos')
                ->where('idusuario','=',$idusuario)
                ->where('idtipo','=',$tipo)
                ->latest()
                ->first();
                $archivos = DB::table('archivos')->where('uso_id','=',$uso->id)->get();
                return view('modules.activos.activos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $uso,'aprobadores' => $aprobadores]);
                
            } else {
                $uso = new Uso();
                $uso->idusuario = $idusuario;
                $uso->uso_id = 0;
                $uso->referencia = 'Ejemplo de referencia activos';
                $uso->idtipo = $tipo;
                $uso->save();
                $archivos = DB::table('archivos')->where('uso_id','=',$uso->id)->get();
                return view('modules.activos.activos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $uso,'aprobadores' => $aprobadores]);
            }
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activofijo  $activofijo
     * @return \Illuminate\Http\Response
     */
    public function show(Activofijo $activofijo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activofijo  $activofijo
     * @return \Illuminate\Http\Response
     */
    public function edit(Activofijo $activofijo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activofijo  $activofijo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activofijo $activofijo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activofijo  $activofijo
     * @return \Illuminate\Http\Response
     */
    public function Destroy(Request $request)
    {
        $id = $request->id_archivo;
        DB::table('activofijos')->where('IdArchivo','=',$id)->delete();
        DB::table('archivos')->where('id','=',$id)->delete();

        $iduso = $request->iduso;
        $archivos = DB::table('archivos')->where('id','=',$iduso)->get();
        
        return $archivos;
    }

    public function exportar(Request $request) 
    {
        $json_data = session('dataactivos');

        $cell_order_compras = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK");
        
        $columnas = ['Codigo','CuentaContable','Descipcion','Marca','Modelo','NumeroSeriePlaca','CostoFin','Adquisicion','Mejoras'
        ,'RetirosBajas','Otros','ValorHistorico','AjusteInflacion','ValorAjustado'
        ,'CostoNetoIni','FecAdquisicion','FecInicio','Metodo','NroDoc','PorcDepreciacion','DepreAcumulada','DepreEjercicio','DepreRelacionada','DepreOtros'
        ,'DepreHistorico','DepreAjusInflacion','DepreAcuInflacion','CostoHistorico','DepreAcuTributaria','CostoNetoIniTributaria','DepreEjercicioTributaria'
        ,'FecBaja','RATIO','DEPRESIACION','DEPRESIACION_VALIDADA','ANALISISn1','ANALISISn2',];
        //return ['mierda'=>count($columnas),'mierda2'=>count($cell_order_compras)];
        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        
        $ruta = public_path('/assets/files/templateactivos.xlsx');

        //$array_data = json_decode($json_data, true);
        $array_data = $json_data;
        $spreadsheet = IOFactory::load($ruta);
    
        $cont_1 = 6;
        
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', $request->empresa);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B2', $request->ruc);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B3', $request->periodo);
    
        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $item = $array_data[$f];
            $data = $item;
            for ($i=0; $i < count($columnas); $i++) { 
                $cell_id = $cell_order_compras[$cont_2].$cont_1;
                $cell_value = $data->{$columnas[$i]};
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
                $cont_2++;
            }
            //foreach ($item['data'] as $cell_value) {
            //    $cell_id = $cell_order_compras[$cont_2].$cont_1;
            //    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
            //    $cont_2++;
            //}
            $cont_1++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Hoja 1');
    
        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporteactivos.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function importar(Request $request)
    {
        $this->validate($request, [
            'myfile' => 'mimes:xls,xlsx,txt,csv'
        ]);

        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        $uso_id = $request->input('iduso');
        $nombre = $request->input('nombrearchivo');
        
        if($request->hasfile('myfile')){
            $ruta = Almacenamiento::guardartemporalmente($username,$request->file('myfile'));
            $archivo = new Archivo();
            $archivo->user_id = $user_id;
            $archivo->uso_id = $uso_id;
            $archivo->ruta = $nombre;
            $archivo->save();
            $id_archivo = $archivo->id;

            $archivos = DB::table('archivos')->where('uso_id','=',$uso_id)->get();

            try{
                    
                if(!$request->csv && !$request->excel)
                {
                    DB::table('mayorcompras')->where('IdArchivo','=',$id_archivo)->delete();
                    DB::table('archivos')->where('id','=',$id_archivo)->delete();
                    return ['error'=>"DEBES SELECCIONAR UNA OPCION"];
                }
                if($request->csv && $request->excel)
                {
                    DB::table('mayorcompras')->where('IdArchivo','=',$id_archivo)->delete();
                    DB::table('archivos')->where('id','=',$id_archivo)->delete();
                    return ['error'=>"DEBES SELECCIONAR SOLO UNA OPCION"];
                }
                if($request->excel)
                {
                    try
                    {
                        Excelmuestreo::aumentarcolumnasdefault($ruta,$uso_id,$id_archivo);
                
                        Excel::import(new ActivofijosImport, $ruta);

                        //$spreadsheet = IOFactory::load($ruta);

                        Storage::deleteDirectory('public/'.$useremail.'/temporal', true);
                        // sleep 1 second because of race condition with HD
                        sleep(1);
                        // actually delete the folder itself
                        Storage::deleteDirectory('public/'.$useremail.'/temporal');  

                        return ["archivos"=>$archivos,"archivo"=>$archivo];
                    }
                    catch(\Throwable $th)
                    {
                        DB::table('archivos')->where('id','=',$id_archivo)->delete();
                        DB::table('activofijos')->where('IdArchivo','=',$id_archivo)->delete();
                        return ['error'=>"error al importar, compruebe que su archivo tenga el formato de las plantillas","errortec"=>$th->getMessage()];
                    }
                    
                }
                if($request->csv)
                {
                    try{
                        if($request->delimitador == null)
                        {
                            return ["error"=>"Olvido decirnos que delimitador esta usando"];
                        }
                        else
                        {
                            $data = Txtexportaciones::csv_to_array($ruta,$request->delimitador);
                        }
                        
                        
                        for ($i=0; $i < count($data); $i++) { 
                            $row = $data[$i];

                            for ($i2=0; $i2 < count($row); $i2++) { 
                                $row[$i2] = str_replace(',','',$row[$i2]);
                                if($row[$i2] == "")
                                {
                                    
                                    if($i2 == 15 || $i2 == 16 || $i2 == 31){
                                        $row[$i2] = null;
                                    }else{
                                        $row[$i2] = null;
                                    }
                                    
                                }
                            }
                            
                            if($row[15]!=null)
                            {
                                
                                    try {
                                        $row[15] = $row[15];
                                        $row[15] = str_replace("-", "/", $row[15]);
                                        $row[15] = str_replace(".", "/", $row[15]);
                                    } catch (\Throwable $th) {
                                        $row[15] = null;
                                    }

                            }
                    
                            if($row[16]!=null)
                            {
                                
                                    try {
                                        $row[16] = $row[16];
                                        $row[16] = str_replace("-", "/", $row[16]);
                                        $row[16] = str_replace(".", "/", $row[16]);
                                    } catch (\Throwable $th) {
                                        $row[16] = null;
                                    }
                                
                            }
                            if($row[31]!=null)
                            {
                                
                                    try {
                                        $row[31] = $row[31];
                                        $row[31] = str_replace("-", "/", $row[31]);
                                        $row[31] = str_replace(".", "/", $row[31]);
                                    } catch (\Throwable $th) {
                                        $row[31] = null;
                                    }

                            }
                            
                            $registro = new ActivoFijo([
                                    'IdUso'=> $uso_id,
                                    'IdArchivo'=> $id_archivo,
                                    'Codigo'=> $row[0],
                                    'CuentaContable'=> $row[1],
                                    'Descipcion'=> $row[2],
                                    'Marca'=> $row[3],
                                    'Modelo'=> $row[4],
                                    'NumeroSeriePlaca'=> $row[5],
                                    'CostoFin'=> $row[6],
                                    'Adquisicion'=> $row[7],
                                    'Mejoras'=> $row[8],
                                    'RetirosBajas'=> $row[9],
                                    'Otros'=> $row[10],
                                    'ValorHistorico'=> $row[11],
                                    'AjusteInflacion'=> $row[12],
                                    'ValorAjustado'=> $row[13],
                                    'CostoNetoIni'=> $row[14],
                                    'FecAdquisicion'=> $row[15],
                                    'FecInicio'=> $row[16],
                                    'Metodo'=> $row[17],
                                    'NroDoc'=> $row[18],
                                    'PorcDepreciacion'=> $row[19],
                                    'DepreAcumulada'=> $row[20],
                                    'DepreEjercicio'=> $row[21],
                                    'DepreRelacionada'=> $row[22],
                                    'DepreOtros'=> $row[23],
                                    'DepreHistorico'=> $row[24],
                                    'DepreAjusInflacion'=> $row[25],
                                    'DepreAcuInflacion'=> $row[26],
                                    'CostoHistorico'=> $row[27],
                                    'DepreAcuTributaria'=> $row[28],
                                    'CostoNetoIniTributaria'=> $row[29],
                                    'DepreEjercicioTributaria'=> $row[30],
                                    'FecBaja'=> $row[31],
                                ]);
                            $registro->save();
                        }

                        Storage::deleteDirectory('public/'.$useremail.'/temporal', true);
                        // sleep 1 second because of race condition with HD
                        sleep(1);
                        // actually delete the folder itself
                        Storage::deleteDirectory('public/'.$useremail.'/temporal');  
                        
                        return ["archivos"=>$archivos,"archivo"=>$archivo];
                        
                    }
                    catch(\Throwable $th)
                    {
                        DB::table('archivos')->where('id','=',$id_archivo)->delete();
                        DB::table('activofijos')->where('IdArchivo','=',$id_archivo)->delete();
                        return ['error'=>"error al importar, compruebe que su archivo tenga el formato de las plantillas y este separado por | ","errortec"=>$th->getMessage()];
                    }
                    
                }

                
            }
            catch(\Throwable $th)
            {
                DB::table('archivos')->where('id','=',$id_archivo)->delete();
                DB::table('activofijos')->where('IdArchivo','=',$id_archivo)->delete();
                return ["error"=>"Error al subir data pista tecnica : " . $th];
            }
        }    
        else
        {
            return ["error"=>"Debe enviar un archivo Excel valido, consulte plantillas"];
        }
    }

    public function filtrar(Request $request)
    {
        try
        {
            $uso_id = $request->input('iduso');
            $id_archivo = $request->input('id_archivo');
            $vchk = $request->input('check');
            $vcant = $request->input('cantidad');
            $vdateEnd = $request->input('fechafin');
            
            $reporte = DB::select('call calculos_activofijo(?, ?, ?, ? ,?)',[$vchk,$vcant,$vdateEnd,$uso_id,$id_archivo]);
            
            session(['dataactivos' => $reporte]);

            return $reporte; 
        }
        catch(\Throwable $th)
        {
            return ["error"=>"Error al filtrar data, preocura enviar todos los parametros y que tu data no este corrupta con datos ejenos a los aceptados, puedes consultar las platillas para guiarte en los formatos, y borrar los archivos fallidos con el boton rojo de arrirba"];
        }
    }
    
}
