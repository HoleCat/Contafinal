<?php

namespace App\Formatos;

use App\Clases\Almacenamiento;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excelmuestreo extends Model
{
    static function aumentarcolumnasdefault($ruta,$id_muestreo,$id_archivo) {
        $spreadsheet = IOFactory::load($ruta);

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->insertNewColumnBefore('A',2);

        $init = 2;
        $empty_cell = 0;
        $res = true;
        while(1) {
            $aux = $spreadsheet->getActiveSheet()->getCell('C'.$init)->getValue();
            $aux = trim($aux);

            if($empty_cell == 1){
                if ($aux == "" || $aux == null) {
                    break;
                }else{
                    $res = false;
                }
            }

            if($aux == "" || $aux == null) {
                $empty_cell++;
            }

            if($empty_cell == 0) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$init, $id_muestreo);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$init, $id_archivo);
            }
            $init++;
        }
        if($res){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'IdMuestreo');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', 'IdArchivo');
            
            $writer = new Xlsx($spreadsheet);
            $writer->save($ruta);
        }else{
            echo "ERROR.";
        }
    }

    static function obtener_1($array_data,$columna1,$columna2)
    {
        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $data = $array_data[$f];
            $cell_value = $data->{$columna1};
            if($cell_value = $columna2){
                return $data;
            }
        }
    }

    static function poner_data_1($min,$iduso,$cont_1,$spreadsheet,$array_data,$columnas,$cell_order)
    {
        $spreadsheet->setActiveSheetIndex(0);
        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $data = $array_data[$f];
            $ruc_res = DB::table('resultado_rucs')->where('NumeroRuc','=',$data->NroDoc)->where('IdUso','=',$iduso)->get();
           
            foreach ($ruc_res as $res) {
                $data->BuenContribuyente = $res->BuenContribuyente;
                $data->AgenteRetencion = $res->AgenteRetencion;
                $data->AgentePercepcionVtaInt = $res->AgentePercepcionVtaInt;
                $data->AgentePercepcionComLiq = $res->AgentePercepcionComLiq;
                $data->ActividadComercioExterior = $res->ActividadComercioExterior;
                $data->EstadoContribuyente = $res->EstadoContribuyente;
                $data->CondicionContribuyente = $res->CondicionContribuyente;
            }
            $igv_real = $data->BIAG1*0.18;
            $igv_var = $data->IGVIPM1;

            $def = $igv_real - $igv_var;
            if($def>$min)
            {
                $data->IGVRES = $def;
                $data->IGVFLAG = "ERROR";
            }else{
                $data->IGVRES = $def;
                $data->IGVFLAG = "PASS";
            }
            $flag1 = true;
            for ($i=0; $i < count($columnas); $i++) { 
                $cell_id = $cell_order[$cont_2].$cont_1;
                $cell_value = "";
                if($columnas[$i]!=''){
                    if($columnas[$i]=="Comentario"){
                        
                    }else
                    {
                        $cell_value = $data->{$columnas[$i]};
                    }
                }
                if($columnas[$i]=="Status")
                {
                    if($cell_value=="no"){
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);   
                    }
                }
                else if($columnas[$i]=="Liberar")
                {
                    if($cell_value=="no"){
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);   
                    }
                }
                else if($columnas[$i]=="FechaPago")
                {
                    if($cell_value==""){
                        $flag1 = false;
                    } else {
                        $flag1 = true;
                    }
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
                }
                else if($columnas[$i]=="NumeroConstancia")
                {
                    if($cell_value==""){
                        $flag1 = false;
                    } else {
                        $flag1 = true;
                    }
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
                }
                else if($columnas[$i]=="Comentario") {
                    if($flag1 == true)
                    {
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, "Si presenta retraccion");
                    }
                    else{
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, "No presenta retraccion");
                    }
                }
                else if($columnas[$i]!="")
                {
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
                }
                else
                {
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, "");
                }

                $cont_2++;
            }
            $cont_1++;
        }
    }

    static function poner_data_2($min,$iduso,$cont_1,$spreadsheet,$array_data,$columnas,$cell_order)
    {
        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $data = $array_data[$f];
            
            $BI_var = $data->BI;
            $Desci_var = $data->Desci;

            $IGVIPMBI = $data->IGVIPMBI;
            $IGVIPMDesc = $data->IGVIPMDesc;

            $BI_var = $data->BI;
            $Desci_var = $data->Desci;

            $data->Validacion = 0.0;
            $data->ObservacionValidacion = "Sin sentido";
            $data->Conteo = "";

            $NumSerie = $data->NumSerie;
            $NumComp = $data->NumComp;

            if($f != 0)
            {
                $dataanterior = $array_data[$f-1];
                $NumSerieanterior = $dataanterior->NumSerie;
                $NumCompanterior = $dataanterior->NumComp;
                if($NumSerieanterior == $NumSerie)
                {
                    if($NumCompanterior == ($NumComp-1))
                    {
                        $data->Conteo = "SIGUE CORRELATIVO";
                    }
                    else
                    {
                        $data->Conteo = "NO SIGUE CORRELATIVO";
                    }
                }
                else
                {
                    $data->Conteo = "NUEVO INICIO";
                }
            }

            if($Desci_var == "" && $BI_var == "")
            {
                $data->Validacion = 0.0;
                $data->ObservacionValidacion = "Presenta error, ambos campos vacios";
            }
            if($Desci_var == "0" && $BI_var == "0")
            {
                $data->Validacion = 0.0;
                $data->ObservacionValidacion = "Presenta error, ambos campos en cero";
            }
            else if ($Desci_var != "0" && $BI_var != "0")
            {
                $data->Validacion = 0.0;
                $data->ObservacionValidacion = "PRESENTA AMBOS CASOS LOS DATOS NO PUEDEN DETERMINARSE";
            }
            else if ($data->TipoComp == "7" || $data->TipoComp == "8")
            {
                //IGVIPMBI
                if ($Desci_var != "")
                {
                    if($IGVIPMDesc != "")
                    {
                        $p_var = $Desci_var;
                        $p_var = $p_var * 0.18;
                        $p_var = $IGVIPMDesc - $p_var;
                        $data->Validacion = $p_var;
                        if($data->Validacion > $min)
                        {
                            $data->ObservacionValidacion = "Supera limite propocionado (".$min.")";
                        }
                        else
                        {
                            $data->ObservacionValidacion = "Dentro de lo aceptable -> menor a (".$min.")";
                        }
                    }
                    else 
                    {
                        $data->Validacion = 0.0;
                        $data->ObservacionValidacion = "CAMPO IGV Y/O IPM DEL DESCUENTO FALTANTE";
                    }
                }
                if($BI_var != "")
                {
                    $p_var = $BI_var;
                    $p_var = $p_var * 0.18;
                    $p_var = $IGVIPMBI - $p_var;
                    $data->Validacion = $p_var;
                    if($data->Validacion > $min)
                    {
                        $data->ObservacionValidacion = "Supera limite propocionado (".$min.")";
                    }
                    else
                    {
                        $data->ObservacionValidacion = "Dentro de lo aceptable -> menor a (".$min.")";
                    }
                }
                else 
                {
                    $data->Validacion = 0.0;
                    $data->ObservacionValidacion = "CAMPO IGV Y/O IPM DE LA BASE IMPONIBLE FALTANTE";
                }
            }
            else if ($data->TipoComp != "7" || $data->TipoComp != "8")
            {
                if($BI_var != "")
                {
                    $p_var = $BI_var;
                    $p_var = $p_var * 0.18;
                    $p_var = $IGVIPMBI - $p_var;
                    $data->Validacion = $p_var;
                    if($data->Validacion > $min)
                    {
                        $data->ObservacionValidacion = "Supera limite propocionado (".$min.")";
                    }
                    else
                    {
                        $data->ObservacionValidacion = "Dentro de lo aceptable -> menor a (".$min.")";
                    }
                }
                else 
                {
                    $data->Validacion = 0.0;
                    $data->ObservacionValidacion = "CAMPO IGV Y/O IPM DE LA BASE IMPONIBLE FALTANTE";
                }
            }
            
            for ($i=0; $i < count($columnas); $i++) { 
                $cell_id = $cell_order[$cont_2].$cont_1;
                $cell_value = "";
                if($columnas[$i]!=''){
                    $cell_value = $data->{$columnas[$i]};
                    $spreadsheet->setActiveSheetIndex(1)->setCellValue($cell_id, $cell_value);
                }
                else
                {
                    $spreadsheet->setActiveSheetIndex(1)->setCellValue($cell_id, "");
                }

                $cont_2++;
            }
            $cont_1++;
        }
    }

    static function poner_data_3($sheet,$cont_1,$spreadsheet,$array_data,$columnas,$cell_order)
    {
        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $data = $array_data[$f];
            for ($i=0; $i < count($columnas); $i++) { 
                $cell_id = $cell_order[$cont_2].$cont_1;
                $cell_value = "";
                if($columnas[$i]!=''){
                    $cell_value = $data->{$columnas[$i]};
                    $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_id, $cell_value);
                }
                else
                {
                    $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_id, "");
                }

                $cont_2++;
            }
            $cont_1++;
        }
    }

    static function poner_data_4($sheet,$cont_1,$spreadsheet,$array_data,$columnas,$cell_order)
    {
        $total = 0.0;

        $letras = array("F","G","H","I","J","K","L","P","Q");

        /*for ($t = 0; $t < count($years); $t++) {
            $years[$t]->Total = 0.0;
            $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($letras[$t].($cont_1-1), $years[$t]->year);
        }*/
        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $data = $array_data[$f];
            $str = str_split($data->Numero);
            $data_old = "";
            $data_new = "";
            if($str[0] == 7)
            {                
                for ($i=0; $i < count($columnas); $i++) { 
                    $cell_id = $cell_order[$cont_2].$cont_1;
                    $cell_value = "";
                    /*
                    if($columnas[$i]=='Acumulado'){
                        for ($o=0; $o < count($years); $o++) { 
                            $cell_looped = $letras[$o].$cont_1;
                            if($years[$o]->year == $data->Año)
                            {
                                $cell_value = $data->{$columnas[$i]};
                                $years[$o]->Total = $years[$o]->Total + $cell_value;
                                $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_looped, $cell_value);
                            }
                            else
                            {
                                $cell_value = "-";
                                $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_looped, $cell_value);
                            }
                        }
                    }
                    */
                    if($columnas[$i]!=''){
                        
                        $cell_value = $data->{$columnas[$i]};
                        $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_id, $cell_value);
                    
                    }
                    else
                    {
                        $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_id, "");
                    }
    
                    $cont_2++;
                }
                $cont_1++;
            }
        }
        /*for ($p = 0; $p < count($years); $p++) {
            $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($letras[$p].($cont_1+1), $years[$p]->Total);
        }*/
    }

    static function poner_data_5($spreadsheet,$array_data)
    {
        for ($t = 0; $t < count($array_data); $t++) {
                        
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E10", $array_data[$t]->VentasNetas);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D10", $array_data[$t]->NroVentasNetas);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E11", $array_data[$t]->IngresosFinancierosGravados);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D11", $array_data[$t]->NroIngresosFinancierosGravados);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E12", $array_data[$t]->OtrosIngresosGravados);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D12", $array_data[$t]->NroOtrosIngresosGravados);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E13", $array_data[$t]->OtrosIngresosNoGravados);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D13", $array_data[$t]->NroOtrosIngresosNoGravados);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E14", $array_data[$t]->EnajenaciónValoresBienesAF);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D14", $array_data[$t]->NroEnajenaciónValoresBienesAF);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E15", $array_data[$t]->REI);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D15", $array_data[$t]->NroREI);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D16", $array_data[$t]->NroTotalIngresosNetos);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E16", $array_data[$t]->TotalIngresosNetos);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D18", $array_data[$t]->NroIngresoDiferenciaCambio);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E18", $array_data[$t]->IngresoDiferenciaCambio);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E19", $array_data[$t]->IngresosNetos);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D19", $array_data[$t]->NroIngresosNetos);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E21", $array_data[$t]->ImpuestoCalculado);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D21", $array_data[$t]->NroImpuestoCalculado);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E22", $array_data[$t]->Coeficiente);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D22", $array_data[$t]->NroCoeficiente);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E23", $array_data[$t]->CoeficienteFinal);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D23", $array_data[$t]->NroCoeficienteFinal);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E26", $array_data[$t]->CoeficienteSUNAT);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D26", $array_data[$t]->NroCoeficienteSUNAT);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E27", $array_data[$t]->CoeficientePDT);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D27", $array_data[$t]->NroCoeficientePDT);

            $spreadsheet->setActiveSheetIndex(4)->setCellValue("E29", $array_data[$t]->CoeficienteDefinitivo);
            $spreadsheet->setActiveSheetIndex(4)->setCellValue("D29", $array_data[$t]->NroCoeficienteDefinitivo);

        }
    }

    static function poner_data_6($sheet,$cont_1,$spreadsheet,$array_data,$columnas,$cell_order)
    {
        $total = 0.0;

        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $data = $array_data[$f];
            for ($i=0; $i < count($columnas); $i++) { 
                $cell_id = $cell_order[$cont_2].$cont_1;
                $cell_value = "";
                if($columnas[$i]!=''){
                    $cell_value = $data->{$columnas[$i]};
                    $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_id, $cell_value);
                }
                else
                {
                    $spreadsheet->setActiveSheetIndex($sheet)->setCellValue($cell_id, "");
                }

                $cont_2++;
            }
            $cont_1++;
        }
    }

    static function transformDateTime(string $value, string $format = 'Y-m-d')
    {
        $date = "";
        $datos = explode("-", $value);
        if(sizeof($datos)>1)
        {
            if(strlen($datos[0])>3){
                $date = $datos[0].'-'.$datos[1].'-'.$datos[2];
            } else {
                $date = $datos[2].'-'.$datos[1].'-'.$datos[0];
            }
        } else {
            $datos = explode("/", $value);
            if(strlen($datos[0])>3){
                $date = $datos[0].'-'.$datos[1].'-'.$datos[2];
            } else {
                $date = $datos[2].'-'.$datos[1].'-'.$datos[0];
            }
        }
        if(sizeof($datos)>1){
            if(strlen($datos[0])>3){
                $date = $datos[0].'-'.$datos[1].'-'.$datos[2];
            } else {
                $date = $datos[2].'-'.$datos[1].'-'.$datos[0];
            }
        } else {
            $datos = explode(".", $value);
            if(strlen($datos[0])>3){
                $date = $datos[0].'-'.$datos[1].'-'.$datos[2];
            } else {
                $date = $datos[2].'-'.$datos[1].'-'.$datos[0];
            }
        }
        echo $date;
        return $date;
    }

    static function downloadExcel($json_data,$cell_order,$template_path)
    {
        //$json_data = '[{"NroDoc":"20510743271","cliente":"E.V. GRAFICA E.I.R.L.","IdUso":"1","IdArchivo":"41","Periodo":"20200100","Correlativo":"M2020001","FecEmision":"03.01.2020","FecVenci":null,"TipoComp":"01","NumSerie":"F001","AnoDua":"0","NumComp":"8000000002","NumTicket":"3833","TipoDoc":"6","BIAG1":"991.5","IGVIPM1":"178.47","BIAG2":"0","IGVIPM2":"0","BIAG3":"0","IGVIPM3":"0","AdqGrava":"0","ISC":"0","Otros":"0","Total":"1169.97","Moneda":"USD","TipoCam":"3.305","FecOrigenMod":null,"TipoCompMod":null,"NumSerieMod":null,"AnoDuaMod":null,"NumSerComOriMod":null,"FecConstDetrac":null,"NumConstDetrac":null,"Retencion":null,"ClasifBi":"1","Contrato":null,"ErrorT1":null,"ErrorT2":null,"ErrorT3":null,"ErrorT4":null,"MedioPago":null,"Estado":null},{"NroDoc":"20600667280","cliente":"BIZALAB S.A.C","IdUso":"1","IdArchivo":"41","Periodo":"20200100","Correlativo":"M2020006","FecEmision":"03.01.2020","FecVenci":null,"TipoComp":"01","NumSerie":"E001","AnoDua":"0","NumComp":"8000000017","NumTicket":"1128","TipoDoc":"6","BIAG1":"918.79","IGVIPM1":"165.38","BIAG2":"0","IGVIPM2":"0","BIAG3":"0","IGVIPM3":"0","AdqGrava":"0","ISC":"0","Otros":"0","Total":"1084.17","Moneda":"USD","TipoCam":"3.305","FecOrigenMod":null,"TipoCompMod":null,"NumSerieMod":null,"AnoDuaMod":null,"NumSerComOriMod":null,"FecConstDetrac":null,"NumConstDetrac":null,"Retencion":null,"ClasifBi":"5","Contrato":null,"ErrorT1":null,"ErrorT2":null,"ErrorT3":null,"ErrorT4":null,"MedioPago":null,"Estado":null},{"NroDoc":"20100281245","cliente":"ANDERS PERU S.A.C.","IdUso":"1","IdArchivo":"41","Periodo":"20200100","Correlativo":"M2020001","FecEmision":"06.01.2020","FecVenci":null,"TipoComp":"01","NumSerie":"F001","AnoDua":"0","NumComp":"8000000021","NumTicket":"32515","TipoDoc":"6","BIAG1":"1026.41","IGVIPM1":"184.75","BIAG2":"0","IGVIPM2":"0","BIAG3":"0","IGVIPM3":"0","AdqGrava":"0","ISC":"0","Otros":"0","Total":"1211.16","Moneda":"USD","TipoCam":"3.311","FecOrigenMod":null,"TipoCompMod":null,"NumSerieMod":null,"AnoDuaMod":null,"NumSerComOriMod":null,"FecConstDetrac":null,"NumConstDetrac":null,"Retencion":null,"ClasifBi":"1","Contrato":null,"ErrorT1":null,"ErrorT2":null,"ErrorT3":null,"ErrorT4":null,"MedioPago":null,"Estado":null},{"NroDoc":"20101052771","cliente":"IMPRESSO GRAFICA S A","IdUso":"1","IdArchivo":"41","Periodo":"20200100","Correlativo":"M2020001","FecEmision":"13.01.2020","FecVenci":null,"TipoComp":"01","NumSerie":"F001","AnoDua":"0","NumComp":"8000000189","NumTicket":"16832","TipoDoc":"6","BIAG1":"1150","IGVIPM1":"207","BIAG2":"0","IGVIPM2":"0","BIAG3":"0","IGVIPM3":"0","AdqGrava":"0","ISC":"0","Otros":"0","Total":"1357.00","Moneda":"PEN","TipoCam":"1","FecOrigenMod":null,"TipoCompMod":null,"NumSerieMod":null,"AnoDuaMod":null,"NumSerComOriMod":null,"FecConstDetrac":null,"NumConstDetrac":null,"Retencion":null,"ClasifBi":"1","Contrato":null,"ErrorT1":null,"ErrorT2":null,"ErrorT3":null,"ErrorT4":null,"MedioPago":null,"Estado":null}]';
        
        $array_data = json_decode($json_data, true);
        $spreadsheet = IOFactory::load($template_path);
        
        $cont_1 = 2;
    
        foreach ($array_data as $item) {
            $cont_2 = 0;
            foreach ($item as $cell_value) {
                $cell_id = $cell_order[$cont_2].$cont_1;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
                $cont_2++;
            }
            $cont_1++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Hoja 1');
    
        $spreadsheet->setActiveSheetIndex(0);
        /*
            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="TEST_FILE.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');
            
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        */
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $content = ob_get_contents();
        ob_end_clean();

        $username = Auth::user()->name;

        //Almacenamiento::guardarreportemuestrascompras($username,$content);
        $fruta = Storage::disk('public')->put('/muestreo/compras/'.$username.'/'.time().'_'.'mayorcompras/'.'reporte/', $content);
        return $fruta;
    }


}
