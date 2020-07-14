<?php

namespace App\Formatos;

use App\Clases\Modelosgenerales\Comprobante;
use Dotenv\Regex\Regex as RegexRegex;
use Hamcrest\Type\IsNumeric;
use Highlight\RegEx;
use Illuminate\Database\Eloquent\Model;

class Validacion extends Model
{
    

    public static function Importar($filename, $delimiter=',',$rules) {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
    
        $data = array();
        $data2 = array();
        $regex="";
        
        $rules = json_decode($rules);
        $error = "";
        //var_dump(($rules));
        //return $rules[0]->tipo;
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                array_push($data2, $row); 
                for ($i=0; $i < count($rules); $i++) { 
                    $orden = $rules[$i]->orden;
                    $tipo = $rules[$i]->tipo;
                    $minimo = $rules[$i]->minimo;
                    $maximo = $rules[$i]->maximo;
                    $estatico = $rules[$i]->estatico;
                    $obligatorio = $rules[$i]->obligatorio;
                    $mensaje = "";
                    $defvalue = "";

                    if($obligatorio == "si" && $row[$orden]=="")
                    {
                        $row[$orden] = "ESTE CAMPO ES OBLIGATORIO";
                        $error = "ERROR";
                    }
                    else if($obligatorio == "si" && $row[$orden]!="")
                    {
                        switch ($tipo) {
                                case "NUMERICO":
                                    $regex = new RegEx("/^[0-9]+$/");
                                    $copia = $row[$orden];
                                    $defvalue = $row[$orden];
                                    if (strpos($copia, '.') !== false) {
                                        $copia_ = explode(".",$copia);
                                        $copia = str_replace([",","."],"",$copia);
                                        $row[$orden] = $copia;
                                        if(strlen($copia_[1])==2)
                                        {
                                            if (!preg_match($regex, $copia)) {
                                                $mensaje = "DEBE CONTENER SOLO NUMEROS";
                                            } elseif ($estatico !== "") {
                                                $regex = new RegEx("/^[0-9]{{$estatico}}+$/");
                                                $mensaje = "ESTE VALOR DEBE TENER {$estatico} CARACTERES";
                                            } elseif ($minimo !== "" || $maximo !== "") {
                                                $regex = new RegEx("/^[0-9]{{$minimo},{$maximo}}+$/");
                                                $mensaje = "ESTE VALOR DEBE TENER ENTRE {$minimo} Y {$maximo} CARACTERES";
                                            }
                                        } else
                                        {
                                            $mensaje= "NO TIENE DECIMALES SUFICIENTES (DEBEN SER DOS)";
                                            break;
                                        }
                                    } else
                                    {
                                        $mensaje= "NO TIENE DECIMALES (DEBEN SER DOS)";
                                        break;
                                    }
                                break;
                                
                                case "ALFANUMERICO":
                                    $regex = "/^[\w]+$/";
                                    $defvalue = $row[$orden];
                                    if (!preg_match($regex, $row[$orden])) {
                                        $mensaje = $row[$orden];
                                    } elseif ($estatico !== "") {
                                        $mensaje = "ESTE VALOR DEBE TENER {$estatico} CARACTERES";
                                        $regex = "/^[\w]{{$estatico}}+$/";
                                    } elseif ($minimo !== "" || $maximo !== "") {
                                        $mensaje = "ESTE VALOR DEBE TENER ENTRE {$minimo} Y {$maximo} CARACTERES";
                                        $regex = "/^[\w]{{$minimo},{$maximo}}+$/";
                                    }
                                    break;
                                    
                                    
                                case "ALFABETICO":
                                    $regex = "/^[a-zA-Z\s]+$/";
                                    $defvalue = $row[$orden];
                                    if (!preg_match($regex, $row[$orden])) {
                                        $mensaje = "ESTE VALOR ES DE TIPO ALFABÉTICO";
                                    } elseif ($estatico !== "") {
                                        $mensaje = "ESTE VALOR DEBE TENER {$estatico} CARACTERES";
                                        $regex = "/^[a-zA-Z\s]{{$estatico}}+$/";
                                    } elseif ($minimo !== "" || $maximo !== "") {
                                        $mensaje = "ESTE VALOR DEBE TENER ENTRE {$minimo} Y {$maximo} CARACTERES";
                                        $regex = $regex = "/^[a-zA-Z\s]{{$minimo},{$maximo}}+$/";
                                    }
                                    break;
                                case "FECHA":
                                    $regex = "/^(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d{2}$/";//  no está validado la cantidad de dígitos en dia y mes
                                    $defvalue = $row[$orden];
                                    //$regex = "/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/";
                                    //$regex = "/^(?:(?:0?[1-9]|1\d|2[0-8])(\/|-)(?:0?[1-9]|1[0-2]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:31(\/|-)(?:0?[13578]|1[02]))|(?:(?:29|30)(\/|-)(?:0?[1,3-9]|1[0-2])))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(29(\/|-)0?2)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/";
                                    //$regex = "/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i";
                                    $mensaje = "ESTE VALOR NO TIENE EL FORMATO CORRECTO";
                                    break;
                        }

                        if (!preg_match($regex, $row[$orden])) {
                            $row[$orden] = $mensaje;
                            $error = "ERROR";
                        }
                        else{
                            $row[$orden] = $defvalue;
                        }
                    }
                    else if ($obligatorio == "no" && $row[$orden]!="")
                    {
                        switch ($tipo)
                        {
                            case "NUMERICO":
                                $regex = new RegEx("/^[0-9]+$/");
                                $copia = $row[$orden];
                                $defvalue = $row[$orden];
                                if (strpos($copia, '.') !== false) {
                                    $copia_ = explode(".",$copia);
                                    $copia = str_replace([",","."],"",$copia);
                                    $row[$orden] = $copia;
                                    if(strlen($copia_[1])==2)
                                    {
                                        if (!preg_match($regex, $copia)) {
                                            $mensaje = "DEBE CONTENER SOLO NUMEROS";
                                        } elseif ($estatico !== "") {
                                            $regex = new RegEx("/^[0-9]{{$estatico}}+$/");
                                            $mensaje = "ESTE VALOR DEBE TENER {$estatico} CARACTERES";
                                        } elseif ($minimo !== "" || $maximo !== "") {
                                            $regex = new RegEx("/^[0-9]{{$minimo},{$maximo}}+$/");
                                            $mensaje = "ESTE VALOR DEBE TENER ENTRE {$minimo} Y {$maximo} CARACTERES";
                                        }
                                    } else
                                    {
                                        $mensaje= "NO TIENE DECIMALES SUFICIENTES (DEBEN SER DOS)";
                                        break;
                                    }
                                } else
                                {
                                    $mensaje= "NO TIENE DECIMALES (DEBEN SER DOS)";
                                    break;
                                }
                            break;
                            
                            case "ALFANUMERICO":
                                $regex = "/^[\w]+$/";
                                $defvalue = $row[$orden];
                                if (!preg_match($regex, $row[$orden])) {
                                    $mensaje = $row[$orden];
                                } elseif ($estatico !== "") {
                                    $mensaje = "ESTE VALOR DEBE TENER {$estatico} CARACTERES";
                                    $regex = "/^[\w]{{$estatico}}+$/";
                                } elseif ($minimo !== "" || $maximo !== "") {
                                    $mensaje = "ESTE VALOR DEBE TENER ENTRE {$minimo} Y {$maximo} CARACTERES";
                                    $regex = "/^[\w]{{$minimo},{$maximo}}+$/";
                                }
                            break;                       
                                
                            case "ALFABETICO":
                                $regex = "/^[a-zA-Z\s]+$/";
                                $defvalue = $row[$orden];
                                if (!preg_match($regex, $row[$orden])) {
                                    $mensaje = "ESTE VALOR ES DE TIPO ALFABÉTICO";
                                } elseif ($estatico !== "") {
                                    $mensaje = "ESTE VALOR DEBE TENER {$estatico} CARACTERES";
                                    $regex = "/^[a-zA-Z\s]{{$estatico}}+$/";
                                } elseif ($minimo !== "" || $maximo !== "") {
                                    $mensaje = "ESTE VALOR DEBE TENER ENTRE {$minimo} Y {$maximo} CARACTERES";
                                    $regex = $regex = "/^[a-zA-Z\s]{{$minimo},{$maximo}}+$/";
                                }
                            break;

                            case "FECHA":
                                $regex = "/^(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d{2}$/";//  no está validado la cantidad de dígitos en dia y mes
                                $defvalue = $row[$orden];
                                //$regex = "/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/";
                                //$regex = "/^(?:(?:0?[1-9]|1\d|2[0-8])(\/|-)(?:0?[1-9]|1[0-2]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:31(\/|-)(?:0?[13578]|1[02]))|(?:(?:29|30)(\/|-)(?:0?[1,3-9]|1[0-2])))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(29(\/|-)0?2)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/";
                                //$regex = "/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i";
                                $mensaje = "ESTE VALOR NO TIENE EL FORMATO CORRECTO";
                            break;
                        }

                        if (!preg_match($regex, $row[$orden])) {
                            $row[$orden] = $mensaje;
                            $error = "ERROR";
                        }
                        else{
                            $row[$orden] = $defvalue;
                        }
                    }
                    else {
                        $row[$orden] = $row[$orden];
                    }
                    
                }
                array_unshift($row ,$error);
                array_push($data, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public static function esfechavalida($fecha) {
  
        // La longitud de la fecha debe tener exactamente 10 caracteres
        if (strlen($fecha) !== 10)
           return false;
  
        // Primero verifica el patron
        if (preg_match("/^\d{1,2}\/\d{1,2}\/\d{4}$/", $fecha)) return false;
        
        // Mediante el delimitador "/" separa dia, mes y año
        $fecha = explode("/", $fecha);
        $day = (int)$fecha[0];
        $month = (int)($fecha[1]);
        $year = (int)($fecha[2]);
  
        // Verifica que dia, mes, año, solo sean numeros
        $error = ( isNan($day) || isNan($month) || isNan($year) );
  
        // Lista de dias en los meses, por defecto no es año bisiesto
        $ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
        if ( $month === 1 || $month > 2 )
           if ( $day > $ListofDays[$month-1] || $day < 0 || $ListofDays[$month-1] === 'undefined' )
              return false;
  
        // Detecta si es año bisiesto y asigna a febrero 29 dias
        if ( $month === 2 ) {
           $lyear = ( (!($year % 4) && $year % 100) || !($year % 400) );
           if ( $lyear === false && $day >= 29 )
              return false;
           if ( $lyear === true && $day > 29 )
              return false;
        }
        return true;
     } 

    public static function Completarcomprobante($comprobante,$val){
        if(strlen($comprobante)<$val)
        {
            $faltantes = $val - strlen($comprobante);
            for ($i=0; $i < $faltantes; $i++) { 
                $comprobante = '0'.$comprobante;
            }
        }
        return $comprobante;
    }
}
