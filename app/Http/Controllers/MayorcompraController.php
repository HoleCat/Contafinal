<?php

namespace App\Http\Controllers;

use App\Mayorcompra;
use App\Imports\MayorcomprasImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Formatos\Excelmuestreo;
use App\Clases\Almacenamiento;
use App\Clases\Modelosgenerales\Archivo;
use App\Clases\Uso;
use App\Formatos\Txtexportaciones;
use App\Mayorgasto;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MayorcompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        if(Auth::check()){
            $tipo = 9;
            $tiposubuso = 10;
            $uso_id = 0;
            $idusuario = Auth::user()->id;
            $contadorusomuestreo = DB::table('usos')->where('idusuario','=',$idusuario)->where('idtipo','=',$tipo)->count();
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            $contadorarchivos = DB::table('archivos')->where('user_id','=',$idusuario)->count();
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            if($contadorusomuestreo > 0)
            {
                $uso = DB::table('usos')
                ->where('idusuario','=',$idusuario)
                ->where('idtipo','=',$tipo)
                ->latest()
                ->first();
    
                $uso_id = $uso->id;
    
                $contadorusocompras = DB::table('usos')->where('uso_id','=',$uso_id)->where('idusuario','=',$idusuario)->where('idtipo','=',$tiposubuso)->count();
    
                if($contadorusocompras>0)
                {
                    $usocompras = DB::table('usos')
                    ->where('idusuario','=',$idusuario)
                    ->where('uso_id','=',$uso_id)
                    ->where('idtipo','=',$tiposubuso)
                    ->latest()
                    ->first();
                    $archivos = DB::table('archivos')->where('uso_id','=',$usocompras->id)->get();
                    return view('modules.muestreo.compras',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usocompras,'comprobantes' => $comprobantes]);
                } else {
    
                    $usocompras = new Uso([
                        'idusuario' => $idusuario,
                        'uso_id' => $uso_id,
                        'referencia' => 'Ejemplo de referencia compras',
                        'idtipo' => $tiposubuso,
                    ]);
                    $usocompras->save();
                    $archivos = DB::table('archivos')->where('uso_id','=',$usocompras->id)->get();
                    return view('modules.muestreo.compras',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usocompras,'comprobantes' => $comprobantes]);
                }
            } else {
                $uso = new Uso();
                $uso->idusuario = $idusuario;
                $uso->uso_id = 0;
                $uso->referencia = 'Ejemplo de referencia';
                $uso->idtipo = $tipo;
                $uso->save();
    
                $usocompras = new Uso([
                    'idusuario' => $idusuario,
                    'uso_id' => $uso->id,
                    'referencia' => 'Ejemplo de referencia compras sin uso general',
                    'idtipo' => $tiposubuso,
                ]);
                $usocompras->save();
                $archivos = DB::table('archivos')->where('uso_id','=',$usocompras->id)->get();
                return view('modules.muestreo.compras',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usocompras,'comprobantes' => $comprobantes]);
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
     * @param  \App\Mayorcompra  $mayorcompra
     * @return \Illuminate\Http\Response
     */
    public function show(Mayorcompra $mayorcompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mayorcompra  $mayorcompra
     * @return \Illuminate\Http\Response
     */
    public function edit(Mayorcompra $mayorcompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mayorcompra  $mayorcompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mayorcompra $mayorcompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mayorcompra  $mayorcompra
     * @return \Illuminate\Http\Response
     */
    public function Destroy(Request $request)
    {
        $id = $request->id_archivo;
        DB::table('mayorcompras')->where('IdArchivo','=',$id)->delete();
        DB::table('archivos')->where('id','=',$id)->delete();

        $iduso = $request->iduso;
        $archivos = DB::table('archivos')->where('id','=',$iduso)->get();
        
        return $archivos;
    }

    public function exportar(Request $request) 
    {
        $json_data = session('datacompras');

        $cell_order_compras = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO");
        
        $columnas = ['Periodo','Correlativo','Orden',
        'FecEmision','FecVenci','TipoComp','NumSerie',
        'AnoDua','NumComp','NumTicket','TipoDoc','NroDoc','cliente',
        'BIAG1','IGVIPM1','BIAG2','IGVIPM2','BIAG3','IGVIPM3',
        'AdqGrava','ISC','Otros','Total','Moneda','TipoCam',
        'FecOrigenMod','TipoCompMod','NumSerieMod',
        'AnoDuaMod','NumSerComOriMod','FecConstDetrac',
        'NumConstDetrac','Retencion','ClasifBi','Contrato',
        'ErrorT1','ErrorT2','ErrorT3','ErrorT4','MedioPago',
        'Estado'];

        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        
        $ruta = public_path('/assets/files/templatemayorcompra.xlsx');

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
            $data = json_decode($item->data);
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
        header('Content-Disposition: attachment;filename="reportecompras.xlsx"');
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
            'myfile' => 'mimes:xls,xlsx,csv,txt'
        ]);

        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        $uso_id = $request->input('iduso');
        
        $nombre = $request->nombrearchivo;

        if($request->hasfile('myfile'))
        {
            try
            {
                $archivo = new Archivo();
                $archivo->user_id = $user_id;
                $archivo->uso_id = $uso_id;
                $archivo->ruta = $nombre;
                $archivo->save();
                $id_archivo = $archivo->id;

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
                    $ruta = Almacenamiento::guardartemporalmente("",$request->file('myfile'));
                    Excelmuestreo::aumentarcolumnasdefault($ruta,$uso_id,$id_archivo);
            
                    Excel::import(new MayorcomprasImport, $ruta);
                }
                if($request->csv)
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

                        for ($i2=0; $i2 < count($row); $i2++) { 
                            $row[$i2] = str_replace(',','',$row[$i2]);
                            if($row[$i2] == "")
                            {
                                
                                if($i == 3 || $i == 4 || $i == 25 || $i == 30){
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
                                    $row[4] = str_replace("-", "/", $row[4]);
                                    $row[4] = str_replace(".", "/", $row[4]);
                                } catch (\Throwable $th) {
                                    $row[4] = null;
                                }
                            
                        }
                        
                        if($row[25]!=null)
                        {
                            
                                try {
                                    $row[25] = $row[25];
                                    $row[25] = str_replace(".", "/", $row[25]);
                                    $row[25] = str_replace("-", "/", $row[25]);
                                } catch (\Throwable $th) {
                                    $row[25] = null;
                                }
                            
                        }
                        
                        if($row[30]!=null)
                        {
                            
                                try {
                                    $row[30] = $row[30];
                                    $row[30] = str_replace(".", "/", $row[30]);
                                    $row[30] = str_replace("-", "/", $row[30]);
                                } catch (\Throwable $th) {
                                    $row[30] = null;
                                }
                            
                        }  
                        
                        $registro = new Mayorcompra([
                            'IdUso'=>$uso_id,
                            'IdArchivo'=> $id_archivo,
                            'Periodo'=> $row[0],
                            'Correlativo'=> $row[1],
                            'Orden'=> $row[2],
                            'FecEmision'=> $row[3],
                            'FecVenci'=> $row[4],
                            'TipoComp'=> $row[5],
                            'NumSerie'=> $row[6],
                            'AnoDua'=> $row[7],
                            'NumComp'=> $row[8],
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
                }
                
                $archivos = DB::table('archivos')->where('uso_id','=',$uso_id)->get();

                Storage::deleteDirectory('public/'.$useremail.'/temporal', true);
                // sleep 1 second because of race condition with HD
                sleep(1);
                // actually delete the folder itself
                Storage::deleteDirectory('public/'.$useremail.'/temporal');  
                //return response()->json($reporte,200);
                return ['archivo'=>$archivo,'archivos'=>$archivos];
            }
            catch(\Throwable $th)
            {
                DB::table('mayorcompras')->where('IdArchivo','=',$id_archivo)->delete();
                DB::table('archivos')->where('id','=',$id_archivo)->delete();
                return ["error"=>"Error al subir archivo -> pista tecnica : " . $th->getMessage()];
            }
            
        }
        else
        {
            return ["error"=>"Debe enviar un archivo"];
        }

    }

    public function filtrar(Request $request)
    {
        $uso_id = $request->input('iduso');
        $id_archivo = $request->input('id_archivo');
        $impMin = $request->input('importeminimo');
        $impMax = $request->input('importemaximo');
        $comparacion = $request->input('comparacion');
        $tipo = $request->input('tipocomprobante');
        $cantidad = $request->input('cantidad');
        
        $reporte = DB::select('call report_xl_compras(?, ?, ?, ?, ?, ?, ?)',[$impMin,$impMax,$cantidad,$comparacion,$tipo,$uso_id,$id_archivo]);
        
        session(['datacompras' => $reporte]);

        return ['compras'=>$reporte];                
    }

}
