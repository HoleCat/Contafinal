<?php

namespace App\Http\Controllers;

use App\Clases\Uso;
use App\Formatos\Validacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ValidacionController extends Controller
{
    public function Importar(Request $request)
    {
        $rules = "";
        try
        {
            if($request->tipo == 1)
            {
                $rules =
                '[{"orden":"0","minimo":"","maximo":"","estatico":"8","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"1","minimo":"0","maximo":"24","estatico":"","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"2","minimo":"0","maximo":"100","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"3","minimo":"","maximo":"","estatico":"2","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"4","minimo":"0","maximo":"60","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"5","minimo":"0","maximo":"24","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"6","minimo":"0","maximo":"100","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"7","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"si"}]';
            }           



            if($request->tipo == 2)
            {
                $rules =
                '[{"orden":"0","minimo":"","maximo":"","estatico":"8","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"1","minimo":"1","maximo":"40","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"2","minimo":"2","maximo":"10","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"3","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"si"},
                {"orden":"4","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"5","minimo":"","maximo":"","estatico":"2","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"6","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"7","minimo":"1","maximo":"4","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"8","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"9","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"10","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"11","minimo":"0","maximo":"15","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"12","minimo":"0","maximo":"100","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"13","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"14","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"15","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"16","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"17","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"18","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"19","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"20","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"21","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"22","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"23","minimo":"","maximo":"","estatico":"3","tipo":"ALFABETICO","obligatorio":"no"},
                {"orden":"24","minimo":"","maximo":"","estatico":"5","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"25","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"26","minimo":"","maximo":"","estatico":"2","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"27","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"28","minimo":"","maximo":"","estatico":"3","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"29","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"30","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"31","minimo":"0","maximo":"24","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"32","minimo":"","maximo":"","estatico":"1","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"33","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"34","minimo":"","maximo":"","estatico":"12","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"35","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"36","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"37","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"38","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"39","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"40","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"si"}]';

            }
            

            if($request->tipo == 3)
            {
                $rules =
                '[{"orden":"0","minimo":"","maximo":"","estatico":"8","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"1","minimo":"0","maximo":"40","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"2","minimo":"2","maximo":"10","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"3","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"4","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"5","minimo":"","maximo":"","estatico":"2","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"6","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"7","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"8","minimo":"0","maximo":"20","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"9","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"10","minimo":"0","maximo":"15","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"11","minimo":"0","maximo":"100","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"12","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"13","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"14","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"15","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"16","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"17","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"18","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"19","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"20","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"21","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"22","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"23","minimo":"0","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"24","minimo":"","maximo":"","estatico":"3","tipo":"ALFABETICO","obligatorio":"no"},
                {"orden":"25","minimo":"","maximo":"","estatico":"5","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"26","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"27","minimo":"","maximo":"","estatico":"2","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"28","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"29","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"30","minimo":"","maximo":"","estatico":"12","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"31","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},
                {"orden":"32","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"no"},{"orden":"33","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"si"}]';
                

            }
            


            if($request->tipo == 4)
            {
                $rules =
                '[{"orden":"0","minimo":"","maximo":"","estatico":"8","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"1","minimo":"0","maximo":"40","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"2","minimo":"2","maximo":"10","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"3","minimo":"0","maximo":"24","estatico":"","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"4","minimo":"0","maximo":"24","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"5","minimo":"0","maximo":"24","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"6","minimo":"","maximo":"","estatico":"3","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"7","minimo":"","maximo":"","estatico":"1","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"8","minimo":"0","maximo":"15","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"9","minimo":"","maximo":"","estatico":"2","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"10","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"no"},
                {"orden":"11","minimo":"0","maximo":"20","estatico":"","tipo":"ALFANUMERICO","obligatorio":"si"},
                {"orden":"12","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"13","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"no"},
                {"orden":"14","minimo":"","maximo":"","estatico":"10","tipo":"FECHA","obligatorio":"si"},
                {"orden":"15","minimo":"0","maximo":"200","estatico":"","tipo":"ALFABETICO","obligatorio":"si"},
                {"orden":"16","minimo":"0","maximo":"200","estatico":"","tipo":"ALFABETICO","obligatorio":"no"},
                {"orden":"17","minimo":"4","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"18","minimo":"4","maximo":"15","estatico":"","tipo":"NUMERICO","obligatorio":"si"},
                {"orden":"19","minimo":"0","maximo":"92","estatico":"","tipo":"ALFABETICO","obligatorio":"no"},
                {"orden":"20","minimo":"","maximo":"","estatico":"1","tipo":"NUMERICO","obligatorio":"si"}]';
            }

            //$rules2 = '[{"name":"Jonathan Suh","gender":"male"},{"name":"William Philbin","gender":"male"},{"name":"Allison McKinnery","gender":"female"}]';
            //$rules2 = json_decode($rules2);
            //return $rules2[0]->name; 
            $data = Validacion::importar($request->file('myfile'),$request->delimitador,$rules);
        
            session(['datavalidada' => $data]);
            session(['tipoarchivo' => $request->tipo]);

            return $data;
            //return $data;
        }catch(\Throwable $th)
        {
            return ["error"=>"Parece que tienes errores, comprueba que el separador sera |, si el error persiste trate recargando la pagina, si esto no arregla el problema y no encuentra".$th];
        }
    }

    public function Exportar(Request $request)
    {   
        $json_data = session('datavalidada');
        $json_tipo = session('tipoarchivo');

        $cell_order_ventas = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ");
        
        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        
        $ruta = public_path('/assets/files/validador.xlsx');

        //$array_data = json_decode($json_data, true);
        $array_data = $json_data;
        $spreadsheet = IOFactory::load($ruta);
    
        $cont_1 = 5;

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "EMPRESA :");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', "RUC :");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', "PERIODO :");

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', $request->empresa);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B2', $request->ruc);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B3', $request->periodo);
    
        for ($f = 0; $f < count($array_data); $f++) {
            $cont_2 = 0;
            $item = $array_data[$f];
            
            for ($i=0; $i < count($item); $i++) { 
                $cell_id = $cell_order_ventas[$cont_2].$cont_1;
                $cell_value = $item[$i];
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
                $cont_2++;
            }
            //foreach ($item['data'] as $cell_value) {
            //    $cell_id = $cell_order_compras[$cont_2].$cont_1;
            //    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_id, $cell_value);
            //    $cont_2++;
            //}
            $cont_1++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Resultado');
    
        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="validacion_resultado.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function Index()
    {
        $tipo = 20;
        
        if(Auth::check()){
            $user = Auth::user();
            $count = Uso::where('idtipo','=',$tipo)->where('idusuario','=',$user->id)->count();
            if($count>0){
                $uso = Uso::where('idusuario','=',$user->id)
                ->where('idtipo','=',$tipo)
                ->latest()
                ->first();
                return view('modules.validador.validador',['uso'=>$uso]);
            } else {
                $uso = new Uso([
                    'idusuario' => $user->id,
                    'uso_id' => 0,
                    'referencia' => 'Ejemplo de referencia validador',
                    'idtipo' => $tipo,
                ]);
                $uso->save();
                return view('modules.validador.validador',['uso'=>$uso]);
            }
        }
    }

    public function Nuevo()
    {
        $tipo = 20;
        if(Auth::check())
        {
            $user = Auth::user();
            $uso = new Uso([
                'idusuario' => $user->id,
                'uso_id' => 0,
                'referencia' => 'Ejemplo de referencia validador',
                'idtipo' => $tipo,
            ]);
            $uso->save();
            return view('modules.validador.validador',['uso'=>$uso]);
        }
    }

}
