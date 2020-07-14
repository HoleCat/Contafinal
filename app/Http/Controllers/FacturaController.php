<?php

namespace App\Http\Controllers;

use App\Clase\Modelosgenerales\Sistemacontable;
use App\Clases\Caja\Aprobador;
use App\Clases\Modelosgenerales\Archivo;
use App\Clases\Uso;
use App\Clases\Xml\Factura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Nuevo() {
        $user = Auth::user();
        $user_id = $user->id;
        $tipo = 19;
        
        $uso = new Uso([
            'idusuario' => $user_id,
            'uso_id' => 0,
            'referencia' => 'Ejemplo de referencia compras',
            'idtipo' => $tipo,
        ]);
        $uso->save();

        return view("modules.xml.xml",['uso'=>$uso]);
    }

    public function Index() {
        $user = Auth::user();
        $user_id = $user->id;
        $tipo = 19;
        
        $conteousos = Uso::where('idusuario','=',$user_id)->where('idtipo','=',$tipo)->count();
        $historico = DB::table('usos')->where('idtipo','=',$tipo)->get();
        if($conteousos > 0)
        {
            $uso = DB::table('usos')
            ->where('idusuario','=',$user_id)
            ->where('idtipo','=',$tipo)
            ->latest()
            ->first();

            return view("modules.xml.xml",['historico'=>$historico,'uso'=>$uso]);
        } else {
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

    public function eliminar(Request $request) {
        DB::delete('delete from facturas where id = ?', [$request->id]);
        return Factura::get()->where('uso_id','=',$request->uso_id);
    }

    public function GetData(Request $request) {
        

        $files = $request->file('myfile');
        $nro = count($files);
        $unique_id = uniqid().time();
        for ($i=0; $i < $nro; $i++) { 
            $filenamewithext = $files[$i]->getClientOriginalName();
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $ext = $files[$i]->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$ext;
            $ruta = $files[$i]->move('storage/xml/', $filenametostore);
            $ruta = public_path($ruta);
            $xml = simplexml_load_file($ruta);
            $ns = $xml->getNamespaces(true);
            $xml->registerXPathNamespace('cac',$ns['cac']);
            $xml->registerXPathNamespace('cbc',$ns['cbc']);
            
            $ids = array();

            $uso_id                    =    $request->uso_id;
            $usuario_id                =    Auth::user()->id;
            $codigo_doc                =    (string)$xml->xpath('//cbc:InvoiceTypeCode')[0];
            $emision_doc               =    (string)$xml->xpath('//cbc:IssueDate')[0];
            $moneda                    =    (string)$xml->xpath('//cbc:DocumentCurrencyCode')[0];
            try {
                $ruc_cliente               =    (string)$xml->xpath('//cac:AccountingCustomerParty//cac:Party//cac:PartyIdentification//cbc:ID')[0];
                
            } catch (\Exception $e) {
                $ruc_cliente               =    (string)$xml->xpath('//cac:AccountingCustomerParty//cbc:CustomerAssignedAccountID')[0];
            }

            try {
                $direccion_cli             =    (string)$xml->xpath('//cac:AccountingCustomerParty//cac:Party//cac:PartyLegalEntity//cac:RegistrationAddress//cac:AddressLine//cbc:Line')[0];
            } catch (\Throwable $th) {
                $direccion_cli             =    "";
            }

            $razon_social_cliente          =    (string)$xml->xpath('//cac:AccountingCustomerParty//cac:Party//cac:PartyLegalEntity//cbc:RegistrationName')[0];

            try {
                $ruc_proveedor             =    (string)$xml->xpath('//cac:AccountingSupplierParty//cac:Party//cac:PartyIdentification//cbc:ID')[0];
            } catch (\Throwable $th) {
                $ruc_proveedor             =    (string)$xml->xpath('//cac:AccountingSupplierParty//cbc:CustomerAssignedAccountID')[0];
            }
                                            
            $razon_social_proveedor        =    (string)$xml->xpath('//cac:AccountingSupplierParty//cac:Party//cac:PartyLegalEntity//cbc:RegistrationName')[0];

            try {
                $ubigeo                    =    (string)$xml->xpath('//cac:AccountingCustomerParty//cac:Party//cac:PartyLegalEntity//cac:RegistrationAddress//cbc:ID')[0];
            } catch (\Throwable $th) {
                $ubigeo                    =    "";
            }
            
            $igv                           =    $xml->xpath('//cac:TaxTotal//cac:TaxSubtotal//cbc:TaxAmount')[0];

            $total                         =    $xml->xpath('//cac:LegalMonetaryTotal//cbc:PayableAmount')[0];

            try {
                $valor_venta               =    $xml->xpath('//cac:TaxTotal//cac:TaxSubtotal//cbc:TaxableAmount')[0];
            } catch (\Throwable $th) {
                $valor_venta               =   $total - $igv;
            }

            $descripcion                   =    (string)$xml->xpath('//cac:InvoiceLine//cac:Item//cbc:Description')[0];

            $array_ids                     =  $xml->xpath('//cbc:ID');
            
            foreach ($array_ids as $key => $value) {
                if (strpos((string)$value, "-", 1) > 0 && strpos((string)$value, "F") == 0 && strpos((string)$value, "B") == 0) {
                    $pos = strpos((string)$value, "-", 1);
                    $serie = substr($value, 0, $pos);
                    $numero = substr($value, $pos + 1);
                    break;
                    //return $value;
                }
            }
            
            //return 'No se encontró Coincidencias';
            
            //initializar read xml
            $factura = new Factura();
            $factura->uso_id = $uso_id;
            $factura->key = $unique_id;
            $factura->usuario_id = $usuario_id;
            $factura->ruc_proveedor = $ruc_proveedor;
            $factura->razon_social_proveedor = $razon_social_proveedor;
            $factura->fecha_emision = $emision_doc;
            $factura->codigo_doc = $codigo_doc;
            $factura->serie = $serie;
            $factura->numero = $numero;
            $factura->moneda = $moneda;
            $factura->direccion_entrega = $direccion_cli;
            $factura->ruc_cliente = $ruc_cliente;
            $factura->razon_social_cliente = $razon_social_cliente;
            $factura->ubigeo = $ubigeo;
            $factura->igv = $igv;
            $factura->valor_venta = $valor_venta;
            $factura->total = $total;
            $factura->descripcion = $descripcion;
            $factura->save();
        }

        $db = DB::table("facturas")->where('usuario_id','=',$usuario_id)->where('uso_id','=',$request->uso_id)->where('key','=',$unique_id)->get();
        return $db;
    }

    public function Exportar(Request $request) {
        
        $xml = Uso::firstWhere('id','=',$request->uso_id);
        
        $correo = $request->correo;
        $asunto = $request->asunto;
        
        $user = Auth::user();
        $date = Carbon::now()->format('d-m-Y');
        
        $numeracion = $request->codigo;

        //$data = DB::table('facturas')->where('uso_id','=',$xml->id)->get();
        $data = json_decode(session('xmldataforexportation'));

        $template_path = public_path('/assets/files/xmltemplate.xlsx');
        $spreadsheet = IOFactory::load($template_path);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', $request->empresa);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B2', $request->ruc);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B3', $request->periodo);

        $i = 6;

        foreach ($data as $reg) {
            
                $cellA = 'A'.$i;
                $cellB = 'B'.$i;
                $cellC = 'C'.$i;
                $cellD = 'D'.$i;
                $cellE = 'E'.$i;
                $cellF = 'F'.$i;
                $cellG = 'G'.$i;
                $cellH = 'H'.$i;
                $cellI = 'I'.$i;
                $cellJ = 'J'.$i;
                $cellK = 'K'.$i;
                $cellL = 'L'.$i;
                $cellM = 'M'.$i;
                $cellN = 'N'.$i;
                $cellO = 'O'.$i;
                $cellP = 'P'.$i;
                $cellQ = 'Q'.$i;
                $cellR = 'R'.$i;

                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellA, $reg->dato1);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellB, $reg->dato2);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellC, $reg->dato3);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellD, $reg->dato4);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellE, $reg->dato5);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellF, $reg->dato6);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellG, $reg->dato7);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellH, $reg->dato8);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellI, $reg->dato9);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellJ, $reg->dato10);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellK, $reg->dato11);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellL, $reg->dato12);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellM, $reg->dato13);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellN, $reg->dato14);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellO, $reg->dato15);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellP, $reg->dato16);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cellQ, $reg->dato17);

            $i++;
        }
        
        if($request->mail)
        {
            //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //header('Content-Disposition: attachment;filename="REPORTE.xlsx"');
            //header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            //header('Cache-Control: max-age=1');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            ob_start();
            $writer->save('php://output');
            $content = ob_get_contents();
            ob_end_clean();
            $filename = 'report';
            $exe = '.xlsx';
            $unique_name = $filename.time().$exe;
            $ruta = Storage::put('public/Xml/'.$user->name.'/'.$unique_name,$content);

            $ruta = public_path('Storage/Xml/'.$user->name.'/');
            
            $ruta = $ruta.$unique_name;

            $archivo = new Archivo();
            $archivo->user_id = $user->id;
            $archivo->uso_id = $xml->id;
            $archivo->ruta = $ruta;
            $archivo->save();
            $id_archivo = $archivo->id;

            $info = array(
                'nombre' => $user->name,
                'telefono' => $user->telefono,
                'correo' => $user->mail,
                'fecha' => $date,
                'ruta' => $ruta
            );

            Mail::send('modules.caja.mail',$info,function($message){
                $message->from('201602035x@gmail.com','Contadorapp');
                $message->to('jorge.hospinal@yahoo.com')->subject(request()->input('asunto'));
                $message->to(request()->input('correo'))->subject(request()->input('asunto'));
            });

        } else {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="REPORTE.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            
            $writer->save('php://output');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->documentos;
        session(['xmldataforexportation' => $data]);
        return $data;
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
     * @param  \App\Clases\Xml\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura, Request $request)
    {
        $db = DB::table("facturas")->where('uso_id','=',$request->uso_id)->get();
        return $db;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clases\Xml\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clases\Xml\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clases\Xml\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
