<?php

namespace App\Formatos;

use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    public static function Validarnumero($numero)
    {
        $cant =strlen($numero);
        $letras = str_split($numero);
        $flag = true;
        $num = "";
        for ($i=0; $i < $cant; $i++) { 
            if($letras[$i]=="0" || $letras[$i]=="1" || $letras[$i]=="2" || $letras[$i]=="3" || $letras[$i]=="4" || $letras[$i]=="5" || $letras[$i]=="6" || $letras[$i]=="7" || $letras[$i]=="8" || $letras[$i]=="9")
            {
                $num = $num.$letras[$i];
            }
            else
            {

            }
        }
        $data1 = strlen($numero);
        $data2 = strlen($num);
        if($data1==$data2)
        {
            //return "COOL".$cant."/".strlen($num);
            return $numero;
        }
        else
        {
            //return "NOTCOOL".$cant."/".strlen($num);
            return "DEBE CONTENER SOLO NUMEROS";
        }
    }

    public static function Validarcantidad($numero,$min,$max,$estatico)
    {
        if($max!='' && $min!='')
        {
            if(strlen($numero)>=$min && strlen($numero)<=$max){
                $numero = $numero;
            } else {
                $numero = 'ERROR EN EL LARGO DEL CONTENIDO DEBE SER MAYOR A '.$min.'Y MENOR A '.$max;    
            }
        }
        else if($min!='' && $max=='')
        {
            if(strlen($numero)>=$min){
                $numero = $numero;
            } else {
                $numero = 'ERROR EN EL LARGO DEL CONTENIDO DEBE SER MAYOR A '.$min;
            }
        }
        else if($estatico!='')
        {
            if(strlen($numero)==$estatico){
                $numero = $numero;
            } else {
                $numero = 'ERROR EN EL LARGO DEL CONTENIDO DEBE SER '.$estatico;
            }
        }

        return $numero;
    }

}
