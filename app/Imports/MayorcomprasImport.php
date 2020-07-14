<?php

namespace App\Imports;

use App\Mayorcompra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MayorcomprasImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
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
                if($i == 5 || $i == 6 || $i == 27 || $i == 32){
                    $row[$i] = null;
                }else{
                    $row[$i] = null;
                }
            }
        }
        
        if($row[5]!=null)
        {
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
        
        if($row[6]!=null)
        {
            try {
                $row[6] = date_format(Date::excelToDateTimeObject($row[6]), 'd-m-Y');
                $row[6] = str_replace("-", "/", $row[6]);
            } catch (\Throwable $th) {
                try {
                    $row[6] = $row[6];
                    $row[6] = str_replace("-", "/", $row[6]);
                    $row[6] = str_replace(".", "/", $row[6]);
                } catch (\Throwable $th) {
                    $row[6] = null;
                }
            }
        }
        
        if($row[27]!=null)
        {
            try {
                $row[27] = date_format(Date::excelToDateTimeObject($row[27]), 'd-m-Y');
                $row[27] = str_replace("-", "/", $row[27]);
            } catch (\Throwable $th) {
                try {
                    $row[27] = $row[27];
                    $row[27] = str_replace(".", "/", $row[27]);
                    $row[27] = str_replace("-", "/", $row[27]);
                } catch (\Throwable $th) {
                    $row[27] = null;
                }
            }
        }
        
        if($row[32]!=null)
        {
            try {
                $row[32] = date_format(Date::excelToDateTimeObject($row[32]), 'd-m-Y');
                $row[32] = str_replace("-", "/", $row[32]);
            } catch (\Throwable $th) {
                try {
                    $row[32] = $row[32];
                    $row[32] = str_replace(".", "/", $row[32]);
                    $row[32] = str_replace("-", "/", $row[32]);
                } catch (\Throwable $th) {
                    $row[32] = null;
                }
            }
        }        
        
        return new Mayorcompra([
            'IdUso'=>$row[0],
            'IdArchivo'=>$row[1],
            'Periodo'=> $row[2],
            'Correlativo'=> $row[3],
            'Orden'=> $row[4],
            'FecEmision'=> $row[5],
            'FecVenci'=> $row[6],
            'TipoComp'=> $row[7],
            'NumSerie'=> $row[8],
            'AnoDua'=> $row[9],
            'NumComp'=> $row[10],
            'NumTicket'=> $row[11],
            'TipoDoc'=> $row[12],
            'NroDoc'=> $row[13],
            'Nombre'=> $row[14],
            'BIAG1'=> $row[15],
            'IGVIPM1'=> $row[16],
            'BIAG2'=> $row[17],
            'IGVIPM2'=> $row[18],
            'BIAG3'=> $row[19],
            'IGVIPM3'=> $row[20],
            'AdqGrava'=> $row[21],
            'ISC'=> $row[22],
            'Otros'=> $row[23],
            'Total'=> $row[24],
            'Moneda'=> $row[25],
            'TipoCam'=> $row[26],
            'FecOrigenMod'=> $row[27],
            'TipoCompMod'=> $row[28],
            'NumSerieMod'=> $row[29],
            'AnoDuaMod'=> $row[30],
            'NumSerComOriMod'=> $row[31],
            'FecConstDetrac'=> $row[32],
            'NumConstDetrac'=> $row[33],
            'Retencion'=> $row[34],
            'ClasifBi'=> $row[35],
            'Contrato'=> $row[36],
            'ErrorT1'=> $row[37],
            'ErrorT2'=> $row[38],
            'ErrorT3'=> $row[39],
            'ErrorT4'=> $row[40],
            'MedioPago'=> $row[41],
            'Estado'=> $row[42]
        ]);
    }
}
