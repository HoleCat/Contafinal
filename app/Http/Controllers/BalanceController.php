<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Formatos\Txtexportaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {

    }

    public function importar(Request $request) {
        $username = Auth::user()->name;
        
        $file = $request->file('myfile');

        $filenamewithext = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$ext;
        $ruta = $file->move('storage/balance/'.$username.'/'.time().'_'.$filenametostore.'/archivo/', $filenametostore);

        if($request->delimitador == null)
        {
            return ["error"=>"Olvido decirnos que delimitador esta usando"];
        }
        else
        {
            $array_data = Txtexportaciones::csv_to_array($ruta, $request->delimitador);
        }

        session(['databalance' => $array_data]);

        return $array_data;
    }

    public function exportar(Request $request)
    {
        $array_data = session('databalance');
        
        $template_path = public_path('/assets/files/balance.xlsx');
        $spreadsheet = IOFactory::load($template_path);

        $homologaciones = DB::table('homologacions')->where('user_id','=',Auth::user()->id)->get();

        $x = 2;
        foreach ($homologaciones as $homologaciones) {
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('A'.$x,$homologaciones->codigo);
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('B'.$x,$homologaciones->descripcion);
            $x++;
        }
        
        // DATA
        $columns = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X");
        
        $years = array();
        $cc = 0;
        
        $cont_1 = 2;

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C1', $request->empresa);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C2', $request->ruc);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C3', $request->periodo);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D9', $request->periodo);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('I9', $request->periodo);

        $spreadsheet->setActiveSheetIndex(1)->setCellValue('C1', $request->empresa);
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('C2', $request->ruc);
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('C3', $request->periodo);
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('E7', $request->periodo);

        foreach ($array_data as $item) {
            $yr = substr($item[0],0,4);
            if(!in_array($yr, $years)) array_push($years, $yr);
            // print_r($item);
            $codigo = substr($item[3],0,3);
            $nombre = Txtexportaciones::getNameHomologacion($codigo);
            array_push($item,$codigo,$nombre);
            $array_data[$cc] = $item;
            $cc++;
            $cont_2 = 0;
            foreach ($item as $cell_value) {
                $cell_id = $columns[$cont_2].$cont_1;
                $spreadsheet->setActiveSheetIndex(2)->setCellValue($cell_id, $cell_value);
                $cont_2++;
            }
            $spreadsheet->setActiveSheetIndex(2)->setCellValue("Y".$cont_1, "=+R".$cont_1."-S".$cont_1);
            $cont_1++;
        }
        $cont_1++;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue("Y".$cont_1, "=+SUM(Y2:Y".($cont_1-2).")");

        // PL
        arsort($years);
        $PL_col_pos = 5;
        $BG_col_pos = 4;
        /*foreach ($years as $yr) {
            $PL_col = Txtexportaciones::columnLetter($PL_col_pos);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue($PL_col."7", $yr);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue($PL_col."8", "S/.");

            $sum_ingresos = Txtexportaciones::sumIf($yr, $array_data, "INGRESOS");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."10", $sum_ingresos)
                ->setCellValue($PL_col."11", "=sum(".$PL_col."10)");

            $sum_costo_venta = Txtexportaciones::sumIf($yr, $array_data, "COSTO DE VENTA");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."13", $sum_costo_venta)
                ->setCellValue($PL_col."14", "=sum(".$PL_col."13)")
                ->setCellValue($PL_col."15", "=+".$PL_col."11+".$PL_col."14");

            $sum_gastos_operativos      = Txtexportaciones::sumIf($yr, $array_data, "GASTOS OPERATIVOS");
            $sum_cargas_personal        = Txtexportaciones::sumIf($yr, $array_data, "CARGAS DE PERSONAL");
            $sum_provisiones_gastos     = Txtexportaciones::sumIf($yr, $array_data, "PROVISIONES-GASTOS");
            $sum_otros_ingresos         = Txtexportaciones::sumIf($yr, $array_data, "OTROS INGRESOS");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."17", $sum_gastos_operativos)
                ->setCellValue($PL_col."18", $sum_cargas_personal)
                ->setCellValue($PL_col."19", $sum_provisiones_gastos)
                ->setCellValue($PL_col."20", $sum_otros_ingresos)
                ->setCellValue($PL_col."21", "=sum(".$PL_col."15:".$PL_col."20)");

            $sum_ingresos_gastos    = Txtexportaciones::sumIf($yr, $array_data, "INGRESOS Y GASTOS FINANCIEROS");
            $sum_diferencia_cambio  = Txtexportaciones::sumIf($yr, $array_data, "DIFERENCIA DE CAMBIO");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."23", $sum_ingresos_gastos)
                ->setCellValue($PL_col."24", $sum_diferencia_cambio)
                ->setCellValue($PL_col."25", "=sum(".$PL_col."21:".$PL_col."24)");

            $PL_col_pos++;
            //$spreadsheet->getActiveSheet()->getColumnDimension(Txtexportaciones::columnLetter($PL_col_pos))->setWidth(3);
            $PL_col_pos++;


            // BG
            $BG_col = Txtexportaciones::columnLetter($BG_col_pos);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($BG_col."9", $yr);

            $sum_efectivo             = Txtexportaciones::sumIf($yr, $array_data, "EFECTIVO Y EQUIVALENTE DE EFECTIVO");
            $sum_cuentas_por_cobrar_1 = Txtexportaciones::sumIf($yr, $array_data, "CUENTAS POR COBRAR COMERCIALES");
            $sum_cuentas_por_cobrar_2 = Txtexportaciones::sumIf($yr, $array_data, "OTRAS CUENTAS POR COBRAR INTERCOMPANY");
            $sum_cuentas_por_cobrar_3 = Txtexportaciones::sumIf($yr, $array_data, "OTRAS CUENTAS POR COBRAR");
            $sum_cuentas_por_cobrar_4 = Txtexportaciones::sumIf($yr, $array_data, "CUENTAS POR COBRAR INTERCOMPANY");
            $sum_gastos_pagados       = Txtexportaciones::sumIf($yr, $array_data, "GASTOS PAGADOS POR ANTICIPADO");
            $sum_existencias          = Txtexportaciones::sumIf($yr, $array_data, "EXISTENCIAS");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."10", $sum_efectivo)
                ->setCellValue($BG_col."11", $sum_cuentas_por_cobrar_1)
                ->setCellValue($BG_col."12", $sum_cuentas_por_cobrar_2)
                ->setCellValue($BG_col."13", $sum_cuentas_por_cobrar_3)
                ->setCellValue($BG_col."14", $sum_cuentas_por_cobrar_4)
                ->setCellValue($BG_col."15", $sum_gastos_pagados)
                ->setCellValue($BG_col."16", $sum_existencias)
                ->setCellValue($BG_col."18", "=sum(".$BG_col."10:".$BG_col."16)");

            $sum_propiedad = Txtexportaciones::sumIf($yr, $array_data, "PROPIEDAD, PLANTA Y EQUIPO");
            $sum_intangibles = Txtexportaciones::sumIf($yr, $array_data, "INTANGIBLES");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."24", $sum_efectivo)
                ->setCellValue($BG_col."26", $sum_cuentas_por_cobrar_1)
                ->setCellValue($BG_col."27", "=sum(".$BG_col."24:".$BG_col."26)")
                ->setCellValue($BG_col."36", "=+".$BG_col."27+".$BG_col."18");

            $sum_otras_cuentas = Txtexportaciones::sumIf($yr, $array_data, "OTRAS CUENTAS POR PAGAR");
            $sum_revisar = Txtexportaciones::sumIf($yr, $array_data, "REVISAR");
            $sum_cuentas_por_pagar = Txtexportaciones::sumIf($yr, $array_data, "CUENTAS POR PAGAR COMERCIALES");
            $sum_intercompany_por_pagar = Txtexportaciones::sumIf($yr, $array_data, "INTERCOMPANY POR PAGAR");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."45", $sum_otras_cuentas)
                ->setCellValue($BG_col."46", $sum_revisar)
                ->setCellValue($BG_col."47", $sum_cuentas_por_pagar)
                ->setCellValue($BG_col."49", $sum_intercompany_por_pagar)
                ->setCellValue($BG_col."53", "=sum(".$BG_col."45:".$BG_col."49)");

            $sum_obligaciones_financieras = Txtexportaciones::sumIf($yr, $array_data, "OBLIGACIONES FINANCIERAS");
            $sum_activo_diferido = Txtexportaciones::sumIf($yr, $array_data, "ACTIVO DIFERIDO");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."59", $sum_otras_cuentas)
                ->setCellValue($BG_col."60", $sum_revisar)
                ->setCellValue($BG_col."62", "=sum(".$BG_col."59:".$BG_col."60)");

            $sum_patrimonio = Txtexportaciones::sumIf($yr, $array_data, "PATRIMONIO");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."66", $sum_patrimonio);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."67", "=-PL!".$PL_col."25")
                ->setCellValue($BG_col."68", "=sum(".$BG_col."66:".$BG_col."67)")
                ->setCellValue($BG_col."71", "=+".$BG_col."53+".$BG_col."62+".$BG_col."68");

            $BG_col_pos++;
            //$spreadsheet->getActiveSheet()->getColumnDimension(Txtexportaciones::columnLetter($BG_col_pos))->setWidth(3);
            $BG_col_pos++;
        }*/
        foreach ($years as $yr) {
            $PL_col = Txtexportaciones::columnLetter($PL_col_pos);
            //$spreadsheet->setActiveSheetIndex(1)->setCellValue($PL_col."7", $yr);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue($PL_col."8", "S/.");
    
            $sum_ingresos = Txtexportaciones::sumIf($yr, $array_data, "INGRESOS");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."10", -1*$sum_ingresos)
                ->setCellValue($PL_col."11", "=sum(".$PL_col."10)");
    
            $sum_costo_venta = Txtexportaciones::sumIf($yr, $array_data, "COSTO DE VENTA");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."13", -1*$sum_costo_venta)
                ->setCellValue($PL_col."14", "=sum(".$PL_col."13)")
                ->setCellValue($PL_col."15", "=+".$PL_col."11+".$PL_col."14");
    
            $sum_gastos_operativos      = Txtexportaciones::sumIf($yr, $array_data, "GASTOS OPERATIVOS");
            $sum_cargas_personal        = Txtexportaciones::sumIf($yr, $array_data, "CARGAS DE PERSONAL");
            $sum_provisiones_gastos     = Txtexportaciones::sumIf($yr, $array_data, "PROVISIONES-GASTOS");
            $sum_otros_ingresos         = Txtexportaciones::sumIf($yr, $array_data, "OTROS INGRESOS");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."17", -1*$sum_gastos_operativos)
                ->setCellValue($PL_col."18", -1*$sum_cargas_personal)
                ->setCellValue($PL_col."19", -1*$sum_provisiones_gastos)
                ->setCellValue($PL_col."20", -1*$sum_otros_ingresos)
                ->setCellValue($PL_col."21", "=sum(".$PL_col."15:".$PL_col."20)");
    
            $sum_ingresos_gastos    = Txtexportaciones::sumIf($yr, $array_data, "INGRESOS Y GASTOS FINANCIEROS");
            $sum_diferencia_cambio  = Txtexportaciones::sumIf($yr, $array_data, "DIFERENCIA DE CAMBIO");
            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue($PL_col."23", -1*$sum_ingresos_gastos)
                ->setCellValue($PL_col."24", -1*$sum_diferencia_cambio)
                ->setCellValue($PL_col."25", "=sum(".$PL_col."21:".$PL_col."24)");
    
            $PL_col_pos++;
            $spreadsheet->getActiveSheet()->getColumnDimension(Txtexportaciones::columnLetter($PL_col_pos))->setWidth(3);
            $PL_col_pos++;
    
    
            // BG
            $BG_col = Txtexportaciones::columnLetter($BG_col_pos);
            //$spreadsheet->setActiveSheetIndex(0)->setCellValue($BG_col."9", $yr);
    
            $sum_efectivo             = Txtexportaciones::sumIf($yr, $array_data, "EFECTIVO Y EQUIVALENTE DE EFECTIVO");
            $sum_cuentas_por_cobrar_1 = Txtexportaciones::sumIf($yr, $array_data, "CUENTAS POR COBRAR COMERCIALES");
            $sum_cuentas_por_cobrar_2 = Txtexportaciones::sumIf($yr, $array_data, "OTRAS CUENTAS POR COBRAR INTERCOMPANY");
            $sum_cuentas_por_cobrar_3 = Txtexportaciones::sumIf($yr, $array_data, "OTRAS CUENTAS POR COBRAR");
            $sum_cuentas_por_cobrar_4 = Txtexportaciones::sumIf($yr, $array_data, "CUENTAS POR COBRAR INTERCOMPANY");
            $sum_gastos_pagados       = Txtexportaciones::sumIf($yr, $array_data, "GASTOS PAGADOS POR ANTICIPADO");
            $sum_existencias          = Txtexportaciones::sumIf($yr, $array_data, "EXISTENCIAS");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."10", $sum_efectivo)
                ->setCellValue($BG_col."11", $sum_cuentas_por_cobrar_1)
                ->setCellValue($BG_col."12", $sum_cuentas_por_cobrar_2)
                ->setCellValue($BG_col."13", $sum_cuentas_por_cobrar_3)
                ->setCellValue($BG_col."14", $sum_cuentas_por_cobrar_4)
                ->setCellValue($BG_col."15", $sum_gastos_pagados)
                ->setCellValue($BG_col."16", $sum_existencias)
                ->setCellValue($BG_col."18", "=sum(".$BG_col."10:".$BG_col."16)");
    
            $sum_propiedad = Txtexportaciones::sumIf($yr, $array_data, "PROPIEDAD, PLANTA Y EQUIPO");
            $sum_intangibles = Txtexportaciones::sumIf($yr, $array_data, "INTANGIBLES");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col."24", $sum_propiedad)
                ->setCellValue($BG_col."26", $sum_intangibles)
                ->setCellValue($BG_col."27", "=sum(".$BG_col."24:".$BG_col."26)")
                ->setCellValue($BG_col."36", "=+".$BG_col."27+".$BG_col."18");
    
            $BG_col_2 = Txtexportaciones::columnLetter($BG_col_pos + 5);
    
            $sum_otras_cuentas = Txtexportaciones::sumIf($yr, $array_data, "OTRAS CUENTAS POR PAGAR");
            $sum_revisar = Txtexportaciones::sumIf($yr, $array_data, "REVISAR");
            $sum_cuentas_por_pagar = Txtexportaciones::sumIf($yr, $array_data, "CUENTAS POR PAGAR COMERCIALES");
            $sum_intercompany_por_pagar = Txtexportaciones::sumIf($yr, $array_data, "INTERCOMPANY POR PAGAR");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col_2."10", $sum_otras_cuentas*-1)
                ->setCellValue($BG_col_2."11", $sum_revisar*-1)
                ->setCellValue($BG_col_2."12", $sum_cuentas_por_pagar*-1)
                ->setCellValue($BG_col_2."14", $sum_intercompany_por_pagar*-1)
                ->setCellValue($BG_col_2."18", "=sum(".$BG_col_2."10:".$BG_col_2."14)");
    
            $sum_obligaciones_financieras = Txtexportaciones::sumIf($yr, $array_data, "OBLIGACIONES FINANCIERAS");
            $sum_activo_diferido = Txtexportaciones::sumIf($yr, $array_data, "ACTIVO DIFERIDO");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col_2."24", $sum_obligaciones_financieras*-1)
                ->setCellValue($BG_col_2."25", $sum_activo_diferido*-1)
                ->setCellValue($BG_col_2."27", "=sum(".$BG_col_2."24:".$BG_col_2."25)");
    
            $sum_patrimonio = Txtexportaciones::sumIf($yr, $array_data, "PATRIMONIO");
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col_2."31", $sum_patrimonio);
    
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($BG_col_2."32", "=PL!".$PL_col."25")
                ->setCellValue($BG_col_2."33", "=sum(".$BG_col_2."31:".$BG_col_2."32)")
                ->setCellValue($BG_col_2."36", "=+".$BG_col_2."18+".$BG_col_2."27+".$BG_col_2."33");
    
            $BG_col_pos++;
            $spreadsheet->getActiveSheet()->getColumnDimension(Txtexportaciones::columnLetter($BG_col_pos))->setWidth(3);
            $BG_col_pos++;
        }

        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REPORTE.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
