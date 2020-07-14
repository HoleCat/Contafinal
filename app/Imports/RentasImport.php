<?php

namespace App\Imports;

use App\Clases\Reporte\Renta;
use App\Formatos\Dates as FormatosDates;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RentasImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        for ($i=0; $i < count($row); $i++) {
            
            if($row[$i] == "")
            {
                
                $row[$i] = null;
               
            }
        }
        /*
        if($row[4]!=null)
        {
            try {
                $row[4] = date_format(Date::excelToDateTimeObject($row[4]), 'd-m-Y');
            } catch (\Throwable $th) {
                try {
                    $row[4] = $row[4];
                    $row[4] = str_replace(".", "/", $row[4]);
                    $row[4] = str_replace("-", "/", $row[4]);
                } catch (\Throwable $th) {
                    $row[4] = "";
                }
            }
        }
        
        $pieces = FormatosDates::regular_date_to_array($row[4],"-");*/
        if($row[0]!== null)
        {
            return new Renta([
                'IdUso'=>$row[0],
                'IdArchivo'=>$row[1],
                'Numero'=>$row[2],
                'Nombrecuenta'=>$row[3],
                'Acumulado'=>$row[4]
            ]); 
        }
         
            
    }
}
