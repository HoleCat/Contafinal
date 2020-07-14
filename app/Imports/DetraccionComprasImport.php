<?php

namespace App\Imports;

use App\Clases\Reporte\DetraccionCompras;
use App\Formatos\Validacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DetraccionComprasImport implements ToModel, WithStartRow, WithCalculatedFormulas
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
                if($i == 12){
                    $row[$i] = null;
                }else{
                    $row[$i] = null;
                }
            }
        }
        
        if($row[11]!=null)
        {
            try {
                $row[11] = date_format(Date::excelToDateTimeObject($row[11]), 'd-m-Y');
                $row[11] = str_replace("-", "/", $row[11]);
            } catch (\Throwable $th) {
                try {
                    $row[11] = $row[11];
                    $row[11] = str_replace(".", "/", $row[11]);
                    $row[11] = str_replace("-", "/", $row[11]);
                } catch (\Throwable $th) {
                    $row[11] = null;
                }
            }
        }
        
        return new DetraccionCompras([
            'IdUso'=>$row[0],
            'IdArchivo'=>$row[1],
            'TipoCuenta'=>$row[2],
            'NumeroCuenta'=>$row[3],
            'NumeroConstancia'=>$row[4],
            'PeriodoTributario'=>$row[5],
            'RucProveedor'=>$row[6],
            'NombreProveedor'=>$row[7],
            'TipoDocumentoAdquiriente'=>$row[8],
            'NumeroDocumentoAdquiriente'=>$row[9],
            'RazonSocialAdquiriente'=>$row[10],
            'FechaPago'=>$row[11],
            'MontoDeposito'=>$row[12],
            'TipoBien'=>Validacion::Completarcomprobante($row[13],3),
            'TipoOperacion'=>$row[14],
            'TipoComprobante'=>$row[15],
            'SerieComprobante'=>$row[16],
            'NumeroComprobante'=>Validacion::Completarcomprobante($row[17],7),
            'NumeroPagoDetraciones'=>$row[18],
            'ValidacionPorcentual'=>$row[19],
            'Base'=>"",
            'ValidacionBase'=>"",
            'TipoServicio'=>""
        ]);
    }
}
