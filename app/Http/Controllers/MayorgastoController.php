<?php

namespace App\Http\Controllers;

use App\Clases\Almacenamiento;
use App\Clases\Modelosgenerales\Archivo;
use App\Clases\Uso;
use App\Formatos\Excelmuestreo;
use App\Formatos\Txtexportaciones;
use App\Imports\MayorgastosImport;
use App\Mayorgasto;
use App\Mayorventa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MayorgastoController extends Controller
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
            $tiposubuso = 12;
            $uso_id = 0;
            $idusuario = Auth::user()->id;
            $contadorusomuestreo = DB::table('usos')->where('idusuario','=',$idusuario)->where('idtipo','=',$tipo)->count();
            $contadorarchivos = DB::table('archivos')->where('user_id','=',$idusuario)->count();
            $comprobantes = DB::table('comprobantes')->orderBy('codigo','asc')->get();
            $historico = DB::table('usos')->where('idtipo','=',$tiposubuso)->get();
            if($contadorusomuestreo > 0)
            {
                $uso = DB::table('usos')
                ->where('idusuario','=',$idusuario)
                ->where('idtipo','=',$tipo)
                ->latest()
                ->first();
    
                $uso_id = $uso->id;
                
                $contadorusogastos = DB::table('usos')->where('uso_id','=',$uso_id)->where('idusuario','=',$idusuario)->where('idtipo','=',$tiposubuso)->count();
                
                if($contadorusogastos>0)
                {
                    $usogastos = DB::table('usos')
                    ->where('idusuario','=',$idusuario)
                    ->where('uso_id','=',$uso_id)
                    ->where('idtipo','=',$tiposubuso)
                    ->latest()
                    ->first();
                    $archivos = DB::table('archivos')->where('uso_id','=',$usogastos->id)->get();
                    return view('modules.muestreo.gastos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usogastos,'comprobantes' => $comprobantes]);
                } else {
    
                    $usogastos = new Uso([
                        'idusuario' => $idusuario,
                        'uso_id' => $uso_id,
                        'referencia' => 'Ejemplo de referencia gastos',
                        'idtipo' => $tiposubuso,
                    ]);
                    $usogastos->save();
                    $archivos = DB::table('archivos')->where('uso_id','=',$usogastos->id)->get();    
                    return view('modules.muestreo.gastos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usogastos,'comprobantes' => $comprobantes]);
                }
                
            } else {
                $uso = new Uso();
                $uso->idusuario = $idusuario;
                $uso->uso_id = 0;
                $uso->referencia = 'Ejemplo de referencia';
                $uso->idtipo = $tipo;
                $uso->save();
    
                $usogastos = new Uso([
                    'idusuario' => $idusuario,
                    'uso_id' => $uso->id,
                    'referencia' => 'Ejemplo de referencia gastos sin uso general',
                    'idtipo' => $tiposubuso,
                ]);
                $usogastos->save();
                $archivos = DB::table('archivos')->where('uso_id','=',$usogastos->id)->get();    
                return view('modules.muestreo.gastos',['historico'=>$historico,'archivos'=>$archivos,'uso' => $usogastos,'comprobantes' => $comprobantes]);
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
     * @param  \App\Mayorgasto  $mayorgasto
     * @return \Illuminate\Http\Response
     */
    public function show(Mayorgasto $mayorgasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mayorgasto  $mayorgasto
     * @return \Illuminate\Http\Response
     */
    public function edit(Mayorgasto $mayorgasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mayorgasto  $mayorgasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mayorgasto $mayorgasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mayorgasto  $mayorgasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mayorgasto $mayorgasto)
    {
        //
    }

    public function exportar(Request $request) 
    {
        $json_data = session('datagastos');

        $cell_order_gastos = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V");
        $columnas = [
			'Periodo','CUO','AMC','cuenta','Unid_Econ','CentroCosto',
			'Moneda','TipoDoc1','Numero','TipoDoc2','NumSerie','NumComp',
			'FecEmision','FecVenci','FecOperacion',	'Glosa1','Glosa2',
			'Debe','Haber','RefenciaCompraVenta','IndOP','Diferenciar'
		];

        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        
        $ruta = public_path('/assets/files/templatemayorgasto.xlsx');

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
                $cell_id = $cell_order_gastos[$cont_2].$cont_1;
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
                if($request->csv && $request->excel)
                {
                    return ['error'=>"DEBES SELECCIONAR SOLO UNA OPCION"];
                }
                if($request->excel)
                {
                    $ruta = Almacenamiento::guardartemporalmente($username,$request->file('myfile'));
                    Excelmuestreo::aumentarcolumnasdefault($ruta,$uso_id,$id_archivo);
            
                    Excel::import(new MayorgastosImport, $ruta);
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
                                
                                if($i == 12 || $i == 13){
                                    $row[$i2] = null;
                                }else{
                                    $row[$i2] = null;
                                }
                                
                            }
                        }

                        if($row[13]!=null)
                        {
                            try {
                                $row[13] = $row[13];
                                $row[13] = str_replace(".", "/", $row[13]);
                                $row[13] = str_replace("-", "/", $row[13]);
                            } catch (\Throwable $th) {
                                $row[13] = null;
                            }
                        }
                        
                        if($row[12]!=null)
                        {
                            try {
                                $row[12] = $row[12];
                                $row[12] = str_replace(".", "/", $row[12]);
                                $row[12] = str_replace("-", "/", $row[12]);
                            } catch (\Throwable $th) {
                                $row[12] = null;
                            }
                        }

                        $registro = new Mayorgasto([
                            'IdUso'=>$uso_id,
                            'IdArchivo'=>$id_archivo,
                            'Periodo'=> $row[0],
                            'CUO'=> $row[1],
                            'AMC'=> $row[2],
                            'Cuenta'=> $row[3],
                            'Unid_Econ'=> $row[4],
                            'CentroCosto'=> $row[5],
                            'Moneda'=> $row[6],
                            'TipoDoc1'=> $row[7],
                            'Numero'=> $row[8],
                            'TipoDoc2'=> $row[9],
                            'NumSerie'=> $row[10],
                            'NumComp'=> $row[11],
                            'FecEmision'=> $row[12],
                            'FecVenci'=> $row[13],
                            'FecOperacion'=> $row[14],
                            'Glosa1'=> $row[15],
                            'Glosa2'=> $row[16],
                            'Debe'=> $row[17],
                            'Haber'=> $row[18],
                            'RefenciaCompraVenta'=> $row[19],
                            'IndOP'=> $row[20],
                            'Diferenciar'=> $row[21]
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
                DB::table('mayorgastos')->where('IdArchivo','=',$id_archivo)->delete();
                DB::table('archivos')->where('id','=',$id_archivo)->delete();
                return ['errortec'=>$th->getMessage(),'error'=>"Pruebe recargando la pagina, o revisando si su archivo tiene las columnas en el orden que se plantea en las plantillas."];
            }
        }else
        {
            return ['error'=>"debe seleccionar un archivo"];
        }
    }

    public function filtrar(Request $request)
    {
        try
        {
            $uso_id = $request->input('iduso');
            $id_archivo = $request->input('id_archivo');
            $impMin = $request->input('importeminimo');
            $impMax = $request->input('importemaximo');
            $comparacion = $request->input('comparacion');
            $tipo = $request->input('tipocomprobante');
            $cantidad = $request->input('cantidad');
            $_nroCuenta = $request->input('nrocuenta');
            
            $reporte = DB::select('call report_xl_gastos(?,?, ?, ?, ?, ?, ?)',[$impMin,$impMax,$cantidad,$comparacion,$uso_id,$id_archivo,$_nroCuenta]);
            
            session(['datagastos' => $reporte]);

            return ['gastos'=>$reporte]; 
        }
        catch(\Throwable $th)
        {
            return ['errortec'=>$th,'error'=>"Revise sus campos, y que tenga data con esas variables, recargue la pagina si a pasado tiempo sin usar el app, su session puede haber terminado"]; 
        }
                       
    }
}
