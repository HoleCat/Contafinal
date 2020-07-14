<?php

namespace App\Formatos;

use Illuminate\Database\Eloquent\Model;

class Txtexportaciones extends Model
{
    public static function csv_to_array($filename, $delimiter=',') {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
    
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                array_push($data, $row);
            }
            
            fclose($handle);
        }
        if(count($data))
        return $data;
    }
    
    public static function columnLetter($c){

        $c = intval($c);
        if ($c <= 0) return '';
    
        $letter = '';
                 
        while($c != 0){
           $p = ($c - 1) % 26;
           $c = intval(($c - $p) / 26);
           $letter = chr(65 + $p) . $letter;
        }
        
        return $letter;
    }

    public static function sumIf($yr, $arr, $string) {
        $sum = 0;
        $cont = 1;
        foreach ($arr as $data) {
            if(substr($data[0],0,4) == $yr && mb_strtoupper($data[23]) == $string) $sum += ($data[17] - $data[18]);
            //if(mb_strtoupper($data[23])=='PROPIEDAD, PLANTA Y EQUIPO') {echo substr($data[0],0,4).'_'.$cont.' '.mb_strtoupper($data[23]);
            //$cont++;}
        }
        return $sum;
    }

    public static function getNameHomologacion($codigo,$tabla = null) {
        // TODO
        $homologacion = array(102=>"Efectivo y equivalente de efectivo",
        103=>"Efectivo y equivalente de efectivo",
        104=>"Efectivo y equivalente de efectivo",
        121=>"Cuentas por cobrar comerciales",
        122=>"Otras cuentas por pagar",
        123=>"Cuentas por cobrar comerciales",
        129=>"Cuentas por cobrar comerciales",
        131=>"Cuentas por cobrar Intercompany",
        133=>"Cuentas por cobrar Intercompany",
        139=>"Cuentas por cobrar Intercompany",
        141=>"Otras cuentas por cobrar",
        149=>"Otras cuentas por cobrar",
        161=>"Otras cuentas por cobrar",
        162=>"Otras cuentas por cobrar",
        164=>"Otras cuentas por cobrar",
        168=>"Otras cuentas por cobrar",
        171=>"Otras cuentas por cobrar intercompany",
        174=>"Otras cuentas por cobrar intercompany",
        178=>"Otras cuentas por cobrar intercompany",
        179=>"Otras cuentas por cobrar intercompany",
        181=>"Gastos pagados por anticipado",
        182=>"Gastos pagados por anticipado",
        183=>"Gastos pagados por anticipado",
        189=>"Gastos pagados por anticipado",
        191=>"Cuentas por cobrar comerciales",
        201=>"Existencias",
        211=>"Existencias",
        222=>"Existencias",
        231=>"Existencias",
        241=>"Existencias",
        251=>"Existencias",
        252=>"Existencias",
        253=>"Existencias",
        261=>"Existencias",
        262=>"Existencias",
        295=>"Existencias",
        333=>"Propiedad, planta y equipo",
        334=>"Propiedad, planta y equipo",
        335=>"Propiedad, planta y equipo",
        336=>"Propiedad, planta y equipo",
        338=>"Propiedad, planta y equipo",
        339=>"Propiedad, planta y equipo",
        373=>"Obligaciones Financieras",
        391=>"Propiedad, planta y equipo",
        392=>"Intangibles",
        401=>"Otras cuentas por pagar",
        402=>"Revisar",
        403=>"Otras cuentas por pagar",
        407=>"Otras cuentas por pagar",
        411=>"Otras cuentas por pagar",
        413=>"Otras cuentas por pagar",
        415=>"Otras cuentas por pagar",
        419=>"Otras cuentas por pagar",
        421=>"Cuentas por pagar comerciales",
        422=>"Otras cuentas por cobrar",
        424=>"Cuentas por pagar comerciales",
        429=>"Cuentas por pagar comerciales",
        431=>"Intercompany por pagar",
        432=>"Intercompany por pagar",
        439=>"Intercompany por pagar",
        441=>"Otras cuentas por pagar",
        442=>"Otras cuentas por pagar",
        451=>"Obligaciones Financieras",
        452=>"Obligaciones Financieras",
        453=>"Obligaciones Financieras",
        454=>"Obligaciones Financieras",
        455=>"Obligaciones Financieras",
        459=>"Obligaciones Financieras",
        467=>"Otras cuentas por pagar",
        469=>"Otras cuentas por pagar",
        479=>"Intercompany por pagar",
        489=>"Otras cuentas por pagar",
        491=>"Otras cuentas por pagar",
        496=>"Activo Diferido",
        501=>"Patrimonio",
        571=>"Patrimonio",
        591=>"Patrimonio",
        601=>"Gastos operativos",
        604=>"Gastos operativos",
        605=>"Gastos operativos",
        606=>"Gastos operativos",
        609=>"Gastos operativos",
        611=>"Gastos operativos",
        612=>"Gastos operativos",
        613=>"Gastos operativos",
        614=>"Gastos operativos",
        615=>"Gastos operativos",
        616=>"Gastos operativos",
        621=>"Cargas de Personal",
        622=>"Cargas de Personal",
        623=>"Cargas de Personal",
        624=>"Cargas de Personal",
        625=>"Cargas de Personal",
        627=>"Cargas de Personal",
        628=>"Cargas de Personal",
        629=>"Cargas de Personal",
        631=>"Gastos operativos",
        632=>"Gastos operativos",
        633=>"Gastos operativos",
        634=>"Gastos operativos",
        635=>"Gastos operativos",
        636=>"Gastos operativos",
        637=>"Gastos operativos",
        639=>"Gastos operativos",
        641=>"Gastos operativos",
        643=>"Gastos operativos",
        651=>"Gastos operativos",
        652=>"Gastos operativos",
        653=>"Gastos operativos",
        654=>"Gastos operativos",
        656=>"Gastos operativos",
        659=>"Gastos operativos",
        671=>"Ingresos y Gastos Financieros",
        673=>"Ingresos y Gastos Financieros",
        675=>"Ingresos y Gastos Financieros",
        676=>"Diferencia de cambio",
        681=>"Provisiones-Gastos",
        682=>"Provisiones-Gastos",
        684=>"Provisiones-Gastos",
        686=>"Provisiones-Gastos",
        691=>"Costo de venta",
        692=>"Costo de venta",
        693=>"Costo de venta",
        694=>"Costo de venta",
        701=>"Ingresos",
        702=>"Ingresos",
        703=>"Ingresos",
        704=>"Ingresos",
        709=>"Ingresos",
        711=>"Gastos operativos",
        712=>"Gastos operativos",
        713=>"Gastos operativos",
        716=>"Gastos operativos",
        731=>"Ingresos",
        741=>"Ingresos",
        754=>"Otros Ingresos",
        755=>"Otros Ingresos",
        759=>"Otros Ingresos",
        772=>"Ingresos y Gastos Financieros",
        776=>"Diferencia de cambio",
        779=>"Ingresos y Gastos Financieros",
        881=>"Provisiones-Gastos",
        881=>"Provisiones-Gastos");
    
        return $homologacion[$codigo];
    }
}
