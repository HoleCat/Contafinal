<?php

namespace App\Imports;

use App\Formatos\Validacion;
use App\Mayorgasto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MayorgastosImport implements ToModel, WithStartRow
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
                if($i == 14 || $i == 15){
                    $row[$i] = null;
                }else{
                    $row[$i] = null;
                }
            }
        }
        
        if($row[15]!=null)
        {
            try {
            $row[15] = date_format(Date::excelToDateTimeObject($row[15]), 'd-m-Y');
            $row[15] = str_replace("-", "/", $row[15]);
            } catch (\Throwable $th) {
                try {
                    $row[15] = $row[15];
                    $row[15] = str_replace(".", "/", $row[15]);
                    $row[15] = str_replace("-", "/", $row[15]);
                } catch (\Throwable $th) {
                    $row[15] = null;
                }
            }
        }
        
        if($row[14]!=null)
        {
            try {
                $row[14] = date_format(Date::excelToDateTimeObject($row[14]), 'd-m-Y');
                $row[14] = str_replace("-", "/", $row[14]);
            } catch (\Throwable $th) {
                try {
                    $row[14] = $row[14];
                    $row[14] = str_replace(".", "/", $row[14]);
                    $row[14] = str_replace("-", "/", $row[14]);
                } catch (\Throwable $th) {
                    $row[14] = null;
                }
            }
        }

        return new Mayorgasto([
            'IdUso'=>$row[0],
            'IdArchivo'=>$row[1],
            'Periodo'=> $row[2],
            'CUO'=> $row[3],
            'AMC'=> $row[4],
            'Cuenta'=> $row[5],
            'Unid_Econ'=> $row[6],
            'CentroCosto'=> $row[7],
            'Moneda'=> $row[8],
            'TipoDoc1'=> Validacion::Completarcomprobante($row[9],2),
            'Numero'=> $row[10],
            'TipoDoc2'=> $row[11],
            'NumSerie'=> $row[12],
            'NumComp'=> $row[13],
            'FecEmision'=> $row[14],
            'FecVenci'=> $row[15],
            'FecOperacion'=> $row[16],
            'Glosa1'=> $row[17],
            'Glosa2'=> $row[18],
            'Debe'=> $row[19],
            'Haber'=> $row[20],
            'RefenciaCompraVenta'=> $row[21],
            'IndOP'=> $row[22],
            'Diferenciar'=> $row[23]
        ]);
    }
}
