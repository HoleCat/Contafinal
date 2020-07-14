<?php

namespace App\Imports;

use App\Clases\Reporte\ValidacionReporteVenta;
use App\Formatos\Dates;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ValidacionReporteVentasImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        for ($i=0; $i < count($row); $i++) { 
            $row[$i] = str_replace(',','',$row[$i]);
            if($row[$i] == "")
            {
                if($i == 5 || $i == 6 || $i == 28){
                    $row[$i] = null;
                }else{
                    $row[$i] = null;
                }
            }
        }

        if($row[5]!=null){
            try {
                $row[5] = date_format(Date::excelToDateTimeObject($row[5]), 'd-m-Y');
                $row[5] = str_replace("-", "/", $row[5]);
            } catch (\Throwable $th) {
                try {
                    $row[5] = $row[5];
                    $row[5] = str_replace(".", "/", $row[5]);
                    $row[5] = str_replace("-", "/", $row[5]);
                } catch (\Throwable $th) {
                    $row[5] = null;
                }
            }
        }
        if($row[6]!=null){
            try {
                $row[6] = date_format(Date::excelToDateTimeObject($row[6]), 'd-m-Y');
                $row[6] = str_replace("-", "/", $row[6]);
            } catch (\Throwable $th) {
                try {
                    $row[6] = $row[6];
                    $row[6] = str_replace(".", "/", $row[5]);
                    $row[6] = str_replace("-", "/", $row[6]);
                } catch (\Throwable $th) {
                    $row[6] = null;
                }
            }
        }
        if($row[28]!=null){
            try {
                $row[28] = date_format(Date::excelToDateTimeObject($row[28]), 'd-m-Y');
                $row[28] = str_replace("-", "/", $row[28]);
            } catch (\Throwable $th) {
                try {
                    $row[28] = $row[28];
                    $row[28] = str_replace(".", "/", $row[28]);
                    $row[28] = str_replace("-", "/", $row[28]);
                } catch (\Throwable $th) {
                    $row[28] = null;
                }
            }
        }
        
        return new ValidacionReporteVenta([
            'flag1'=>"no",
            'flag2'=>"no",
            'IdUso'=>$row[0],
            'IdArchivo'=>$row[1],
            'Periodo'=>$row[2],
            'Correlativo'=>$row[3],
            'Ordenado'=>$row[4],
            'FecEmision'=>$row[5],
            'FecVenci'=>$row[6],
            'TipoComp'=>$row[7],
            'NumSerie'=>$row[8],
            'NumComp'=>$row[9],
            'NumTicket'=>$row[10],
            'TipoDoc'=>$row[11],
            'NroDoc'=>$row[12],
            'Nombre'=>$row[13],
            'Export'=>$row[14],
            'BI'=>$row[15],
            'Desci'=>$row[16],
            'IGVIPMBI'=>$row[17],
            'IGVIPMDesc'=>$row[18],
            'ImporteExo'=>$row[19],
            'ImporteIna'=>$row[20],
            'ISC'=>$row[21],
            'BIIGVAP'=>$row[22],
            'IGVAP'=>$row[23],
            'Otros'=>$row[24],
            'Total'=>$row[25],
            'Moneda'=>$row[26],
            'TipoCam'=>$row[27],
            'FecOrigenMod'=>$row[28],
            'TipoCompMod'=>$row[29],
            'NumSerieMod'=>$row[30],
            'NumDocMod'=>$row[31],
            'Contrato'=>$row[32],
            'ErrorT1'=>$row[33],
            'MedioPago'=>$row[34],
            'Estado'=>$row[35]
        ]);
         
    }
}
