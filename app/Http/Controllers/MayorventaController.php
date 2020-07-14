<?php

namespace App\Http\Controllers;

use App\Clases\Almacenamiento;
use App\Clases\Modelosgenerales\Archivo;
use App\Clases\Uso;
use App\Formatos\Excelmuestreo;
use App\Formatos\Txtexportaciones;
use App\Imports\MayorventasImport;
use App\Mayorventa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MayorventaController extends Controller
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
            $tiposubuso = 11;
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
    
                $contadorusoventas = DB::table('usos')->where('uso_id','=',$uso_id)->where('idusuario','=',$idusuario)->where('idtipo','=',$tiposubuso)->count();
    
                if($contadorusoventas>0)
                {
                    $usoventas = DB::table('usos')
                    ->where('idusuario','=',$idusuario)
                    ->where('uso_id','=',$uso_id)
                    ->where('idtipo','=',$tiposubuso)
                    ->latest()
                    ->first();
                    $archivos = DB::table('archivos')->where('uso_id','=',$usoventas->id)->get();
                    return view('modules.muestreo.ventas',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usoventas,'comprobantes' => $comprobantes]);
                } else {
    
                    $usoventas = new Uso([
                        'idusuario' => $idusuario,
                        'uso_id' => $uso_id,
                        'referencia' => 'Ejemplo de referencia ventas',
                        'idtipo' => $tiposubuso,
                    ]);
                    $usoventas->save();
                    $archivos = DB::table('archivos')->where('uso_id','=',$usoventas->id)->get();
                    return view('modules.muestreo.ventas',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usoventas,'comprobantes' => $comprobantes]);
                }
                
            } else {
                $uso = new Uso();
                $uso->idusuario = $idusuario;
                $uso->uso_id = 0;
                $uso->referencia = 'Ejemplo de referencia';
                $uso->idtipo = $tipo;
                $uso->save();
    
                $usoventas = new Uso([
                    'idusuario' => $idusuario,
                    'uso_id' => $uso->id,
                    'referencia' => 'Ejemplo de referencia ventas sin uso general',
                    'idtipo' => $tiposubuso,
                ]);
                $usoventas->save();
                $archivos = DB::table('archivos')->where('uso_id','=',$usoventas->id)->get();
                return view('modules.muestreo.ventas',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usoventas,'comprobantes' => $comprobantes]);
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
     * @param  \App\Mayorventa  $mayorventa
     * @return \Illuminate\Http\Response
     */
    public function show(Mayorventa $mayorventa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mayorventa  $mayorventa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mayorventa $mayorventa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mayorventa  $mayorventa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mayorventa $mayorventa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mayorventa  $mayorventa
     * @return \Illuminate\Http\Response
     */
    public function Destroy(Request $request)
    {
        $id = $request->id_archivo;
        DB::table('mayorventas')->where('IdArchivo','=',$id)->delete();
        DB::table('archivos')->where('id','=',$id)->delete();

        $iduso = $request->iduso;
        $archivos = DB::table('archivos')->where('id','=',$iduso)->get();
        
        return $archivos;
    }

    public function exportar(Request $request) 
    {
        $json_data = session('dataventas');

        $cell_order_ventas = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH");
        $columnas = 
		['Periodo','Correlativo','Ordenado',
		'FecEmision','FecVenci','TipoComp','NumSerie','NumComp','NumTicket','TipoDoc',
		'NroDoc','cliente','Export','BI','Desci','IGVIPMBI','IGVIPMDesc','ImporteExo',
		'ImporteIna','ISC','BIIGVAP','IGVAP','Otros','Total','Moneda','TipoCam',
		'FecOrigenMod','TipoCompMod','NumSerieMod','NumDocMod','Contrato','ErrorT1',
		'MedioPago','Estado'];

        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        
        $ruta = public_path('/assets/files/templatemayorventa.xlsx');

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
                $cell_id = $cell_order_ventas[$cont_2].$cont_1;
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
            'myfile' => 'mimes:xls,xlsx,txt,csv'
        ]);

        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        $uso_id = $request->input('iduso');

        $nombre = $request->nombrearchivo;
        
        if($request->hasfile('myfile')){
            
            $archivo = new Archivo();
            $archivo->user_id = $user_id;
            $archivo->uso_id = $uso_id;
            $archivo->ruta = $nombre;
            $archivo->save();
            $id_archivo = $archivo->id;

            try {
                if(!$request->csv && !$request->excel)
                {
                    DB::table('mayorventas')->where('IdArchivo','=',$id_archivo)->get();
                    DB::table('archivos')->where('id','=',$id_archivo)->get();
                    return ['error'=>"DEBES SELECCIONAR UNA OPCION"];
                }
                if($request->csv && $request->excel)
                {
                    DB::table('mayorventas')->where('IdArchivo','=',$id_archivo)->get();
                    DB::table('archivos')->where('id','=',$id_archivo)->get();
                    return ['error'=>"DEBES SELECCIONAR SOLO UNA OPCION"];
                }
                if($request->excel)
                {
                    $ruta = Almacenamiento::guardartemporalmente("",$request->file('myfile'));
                    Excelmuestreo::aumentarcolumnasdefault($ruta,$uso_id,$id_archivo);
            
                    Excel::import(new MayorventasImport, $ruta);
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

                        $registro = new Mayorventa([
                            'IdUso'=>$uso_id,
                            'IdArchivo'=>$id_archivo,
                            'Periodo'=> $row[0],
                            'Correlativo'=> $row[1],
                            'Ordenado'=> $row[2],
                            'FecEmision'=> $row[3],
                            'FecVenci'=> $row[4],
                            'TipoComp'=> $row[5],
                            'NumSerie'=> $row[6],
                            'NumComp'=> $row[7],
                            'NumTicket'=> $row[8],
                            'TipoDoc'=> $row[9],
                            'NroDoc'=> $row[10],
                            'Nombre'=> $row[11],
                            'Export'=> $row[12],
                            'BI'=> $row[13],
                            'Desci'=> $row[14],
                            'IGVIPMBI'=> $row[15],
                            'IGVIPMDesc'=> $row[16],
                            'ImporteExo'=> $row[17],
                            'ImporteIna'=> $row[18],
                            'ISC'=> $row[19],
                            'BIIGVAP'=> $row[20],
                            'IGVAP'=> $row[21],
                            'Otros'=> $row[22],
                            'Total'=> $row[23],
                            'Moneda'=> $row[24],
                            'TipoCam'=> $row[25],
                            'FecOrigenMod'=> $row[26],
                            'TipoCompMod'=> $row[27],
                            'NumSerieMod'=> $row[28],
                            'NumDocMod'=> $row[29],
                            'Contrato'=> $row[30],
                            'ErrorT1'=> $row[31],
                            'MedioPago'=> $row[32],
                            'Estado'=> $row[33],
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
            } catch (\Throwable $th) {
                return
                [
                    'error'=>"Pruebe recargando la pagina, o revisando si su archivo tiene las columnas en el orden que se plantea en las plantillas. Pista Tecnica : " . $th->getMessage(),
                    'trace'=>$th->getMessage()
                ];
            }
        }else
        {
            return ['error'=>"debe seleccionar un archivo"];
        }
    }

    public function filtrar(Request $request) {
        try
        {
            $uso_id = $request->input('iduso');
            $id_archivo = $request->input('id_archivo');
            $impMin = $request->input('importeminimo');
            $impMax = $request->input('importemaximo');
            $comparacion = $request->input('comparacion');
            $tipo = $request->input('tipocomprobante');
            $cantidad = $request->input('cantidad');
            
            $reporte = DB::select('call report_xl_ventas(?, ?, ?,?, ?, ?, ?)',[$impMin,$impMax,$cantidad,$comparacion,$tipo,$uso_id,$id_archivo]);
            
            session(['dataventas' => $reporte]);

            return ['ventas'=>$reporte];
        }
        catch(\Throwable $th)
        {
            return ["error"=>"Error al filtrar, posible data corrupta, pista tecnica : " . $th->getMessage()];
        }
        
    }
}
