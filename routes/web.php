<?php
use App\Clases\Caja\Aprobador;
use App\Clases\Caja\LiquidacionDetalle;
use App\clases\modelosgenerales\Centrocosto;
use App\clases\modelosgenerales\Codigocontable;
use App\clases\modelosgenerales\Dni;
use App\Clases\Modelosgenerales\Empresa;
use App\Clases\Modelosgenerales\Moneda;
use App\clases\modelosgenerales\Pais;
use App\Clases\Modelosgenerales\Tipouso;
use App\Clases\Reporte\DTR;
use App\Clases\Uso;
use App\Userdata;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





//Route::match(['get', 'post'], '/Delete/validacion_reporte_ventas', 'TrashController@trash_reporte_compras');
//Route::match(['get', 'post'], '/Delete/validacion_reporte_compras', 'TrashController@trash_reporte_compras');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 


    Route::match(['get', 'post'], '/contacto', 'CorreoController@index');

Route::get('/demo', function () {
    return view('demo');
});
Route::get('/', function () {
    $principal = "";
    $resumen = "";
    $footer = "";
    $activos = "";
    $muestras = "";
    $xml = "";
    $caja = "";
    $validacion = "";
    $reporte = "";
    $balance = "";
    $titulos = DB::table('titulos')->get();
    $images = DB::table('imagens')->get();
    foreach ($images as $images) {
        if($images->nombre == "inicio")
        {
            $foto1 = $images->ruta;
        }
        if($images->nombre == "medio")
        {
            $foto2 = $images->ruta;
        }
        if($images->nombre == "final")
        {
            $foto3 = $images->ruta;
        }
    }
    foreach ($titulos as $titulo) {
        if($titulo->codigo == "resumen")
        {
            $resumen = $titulo->contenido;
        }
        if($titulo->codigo == "principal")
        {
            $principal = $titulo->contenido;
        }
        if($titulo->codigo == "footer")
        {
            $footer = $titulo->contenido;
        }
        if($titulo->codigo == "activos")
        {
            $activos = $titulo->contenido;
        }
        if($titulo->codigo == "muestras")
        {
            $muestras = $titulo->contenido;
        }
        if($titulo->codigo == "xml")
        {
            $xml = $titulo->contenido;
        }
        if($titulo->codigo == "caja")
        {
            $caja = $titulo->contenido;
        }
        if($titulo->codigo == "validador")
        {
            $validacion = $titulo->contenido;
        }
        if($titulo->codigo == "reporte")
        {
            $reporte = $titulo->contenido;
        }
        if($titulo->codigo == "balance")
        {
            $balance = $titulo->contenido;
        }
    }
    $noticias = DB::table('noticias')->get();
    return view('home',['foto3'=>$foto3,'foto2'=>$foto2,'foto1'=>$foto1,'noticias'=>$noticias,'resumen'=>$resumen,'principal'=>$principal,'footer'=>$footer,'activos'=>$activos,'muestras'=>$muestras,'xml'=>$xml,'caja'=>$caja,'validacion'=>$validacion,'reporte'=>$reporte,'balance'=>$balance]);
});
Route::get('/Admin', function () {
    $users = DB::table('users')
    ->join('userdatas', 'userdatas.user_id', '=', 'users.id')
    ->get();
    $empresas = DB::table('empresas')
        ->select('empresas.*','users.*','empresas.id as idcool')
        ->join('users', 'users.id', '=', 'empresas.user_id')
        ->get();
    return view('admin',['users'=>$users,'empresas'=>$empresas]);
});
Route::match(['get', 'post'], '/titulo/referencia', 'TituloController@referencia')->name('referencia');
//////////////////APROBADOR//////////////////////
Route::match(['get', 'post'], '/aprobador/index', 'AprobadorController@index')->name('aprobador');
Route::match(['get', 'post'], '/aprobador/store', 'AprobadorController@store');
Route::match(['get', 'post'], '/aprobador/delete', 'AprobadorController@destroy');
//////////////////NOTICAS//////////////////////
Route::match(['get', 'post'], '/noticia/index', 'NoticiaController@index')->name('noticia');
Route::match(['get', 'post'], '/noticia/store', 'NoticiaController@store');
Route::match(['get', 'post'], '/noticia/delete', 'NoticiaController@destroy');

//////////////////CENTRO DE COSTOS//////////////////////
Route::match(['get', 'post'], '/centrocosto/index', 'CentrocostoController@index')->name('centrocosto');
Route::match(['get', 'post'], '/centrocosto/store', 'CentrocostoController@store');
Route::match(['get', 'post'], '/centrocosto/delete', 'CentrocostoController@destroy');

//////////////////HOMOLOGACION//////////////////////
Route::match(['get', 'post'], '/homologacion/index', 'HomologacionController@index')->name('homologacion');
Route::match(['get', 'post'], '/homologacion/store', 'HomologacionController@store');
Route::match(['get', 'post'], '/homologacion/delete', 'HomologacionController@destroy');
//////////////////TITULOS//////////////////////
Route::match(['get', 'post'], '/titulos/index', 'TituloController@index')->name('titulos');
Route::match(['get', 'post'], '/titulos/store', 'TituloController@store');
Route::match(['get', 'post'], '/titulos/delete', 'TituloController@destroy');
//////////////////IMAGENES//////////////////////
Route::match(['get', 'post'], '/imagen/index', 'ImagenController@index')->name('imagenes');
Route::match(['get', 'post'], '/imagen/store', 'ImagenController@store');
Route::match(['get', 'post'], '/imagen/delete', 'ImagenController@destroy');
///////////////////OLD///////////////////////
Route::match(['get', 'post'], '/Old/old_reporte', 'OldController@old_reporte');

Route::match(['get', 'post'], '/Old/old_compras', 'OldController@old_compras');
Route::match(['get', 'post'], '/Old/old_ventas', 'OldController@old_ventas');
Route::match(['get', 'post'], '/Old/old_gastos', 'OldController@old_gastos');

Route::match(['get', 'post'], '/Old/old_caja', 'OldController@old_caja');
Route::match(['get', 'post'], '/Old/old_xml', 'OldController@old_xml');

Route::match(['get', 'post'], '/Old/old_activos', 'OldController@old_activos');

Route::match(['get', 'post'], '/Old/old_balance', 'OldController@old_balance');
///////////////////NEWS///////////////////////
Route::match(['get', 'post'], '/New/new_reporte', 'NewController@new_reporte');

Route::match(['get', 'post'], '/New/new_compras', 'NewController@new_compras');
Route::match(['get', 'post'], '/New/new_ventas', 'NewController@new_ventas');
Route::match(['get', 'post'], '/New/new_gastos', 'NewController@new_gastos');

Route::match(['get', 'post'], '/New/new_caja', 'NewController@new_caja');
Route::match(['get', 'post'], '/New/new_xml', 'NewController@new_xml');

Route::match(['get', 'post'], '/New/new_activos', 'NewController@new_activos');

Route::match(['get', 'post'], '/New/new_balance', 'NewController@new_balance');
/////////////ARCHIVOS REPORTE/////////////////////
Route::match(['get', 'post'], '/Delete/trash_detraccion', 'TrashController@trash_detraccion');
Route::match(['get', 'post'], '/Delete/trash_r_compras', 'TrashController@trash_r_compras');
Route::match(['get', 'post'], '/Delete/trash_r_ruc', 'TrashController@trash_r_ruc');
Route::match(['get', 'post'], '/Delete/trash_r_rentas', 'TrashController@trash_r_rentas');
Route::match(['get', 'post'], '/Delete/trash_r_ventas', 'TrashController@trash_r_ventas');
/////////////TRASH REGISTROS////////////////////
Route::match(['get', 'post'], '/Delete/trash_reporte_compras', 'TrashController@trash_reporte_compras');
Route::match(['get', 'post'], '/Delete/trash_detraccion_compras', 'TrashController@trash_detraccion_compras');
Route::match(['get', 'post'], '/Delete/trash_reporte_ventas', 'TrashController@trash_reporte_ventas');

Route::match(['get', 'post'], '/Delete/trash_compras', 'TrashController@trash_compras');
Route::match(['get', 'post'], '/Delete/trash_ventas', 'TrashController@trash_ventas');
Route::match(['get', 'post'], '/Delete/trash_gastos', 'TrashController@trash_gastos');
Route::match(['get', 'post'], '/Delete/trash_resultados_ruc', 'TrashController@trash_resultados_ruc');
Route::match(['get', 'post'], '/Delete/trash_rentas', 'TrashController@trash_rentas');

Route::match(['get', 'post'], '/Delete/trash_caja_chica', 'TrashController@trash_caja_chica');
Route::match(['get', 'post'], '/Delete/trash_rendir_pago', 'TrashController@trash_rendir_pago');
Route::match(['get', 'post'], '/Delete/trash_xml', 'TrashController@trash_xml');

Route::match(['get', 'post'], '/Delete/trash_activos', 'TrashController@trash_activos');

Route::match(['get', 'post'], '/Delete/trash_balance', 'TrashController@trash_balance');
///////////////////////////////////////
/////////////TRASH ARCHIVOS////////////////////
Route::match(['get', 'post'], '/Delete/trash_archivo_reporte_compras', 'TrashController@trash_archivo_reporte_compras');
Route::match(['get', 'post'], '/Delete/trash_archivo_reporte_ventas', 'TrashController@trash_reporte_ventas');

Route::match(['get', 'post'], '/Delete/trash_archivo_compras', 'TrashController@trash_archivo_compras');
Route::match(['get', 'post'], '/Delete/trash_archivo_ventas', 'TrashController@trash_archivo_ventas');
Route::match(['get', 'post'], '/Delete/trash_archivo_gastos', 'TrashController@trash_archivo_gastos');

Route::match(['get', 'post'], '/Delete/trash_archivo_activos', 'TrashController@trash_archivo_activos');
///////////////////////////////////////
/////////////TRASH USOS////////////////////
Route::match(['get', 'post'], '/Delete/trash_uso_liquidacion', 'TrashController@trash_uso_liquidacion');
Route::match(['get', 'post'], '/Delete/trash_uso_caja_chica', 'TrashController@trash_uso_caja');
Route::match(['get', 'post'], '/Delete/trash_uso_rendir_pago', 'TrashController@trash_uso_caja');

Route::match(['get', 'post'], '/Delete/trash_uso_muestreo', 'TrashController@trash_uso_muestreo');
Route::match(['get', 'post'], '/Delete/trash_uso_activos', 'TrashController@trash_uso_activos');

Route::match(['get', 'post'], '/Delete/trash_uso_xml', 'TrashController@trash_uso_xml');
Route::match(['get', 'post'], '/Delete/trash_uso_reporte', 'TrashController@trash_uso_reporte');
///////////////////////////////////////


Route::match(['get', 'post'], '/Admin/Empresa', 'AdminController@empresa');
Route::match(['get', 'post'], '/Admin/Sistemacontable', 'AdminController@sistemacontable');
Route::match(['get', 'post'], '/Admin/Empresa/Delete', 'AdminController@deleteempresa');

Auth::routes();

Route::match(['get', 'post'],'/Reporte',
['uses' => 'ReporteComprasController@Index']
);
Route::match(['get', 'post'],'/Reporte/Compras/Importar',
['uses' => 'ReporteComprasController@Importar']
);
Route::match(['get', 'post'],'/Reporte/Compras/Liberar',
['uses' => 'ReporteComprasController@Liberar']
);
Route::match(['get', 'post'],'/Reporte/Compras/Status',
['uses' => 'ReporteComprasController@Status']
);
Route::match(['get', 'post'],'/Reporte/Compras/Data',
['uses' => 'ReporteComprasController@Data']
);
Route::match(['get', 'post'],'/Reporte/Compras/Txtconsultaruc',
['uses' => 'ReporteComprasController@Txtconsultaruc']
);
Route::match(['get', 'post'],'/Reporte/Compras/Resultadoconsultaruc',
['uses' => 'ReporteComprasController@Resultadoconsultaruc']
);
Route::match(['get', 'post'],'/Reporte/Compras/Txtcomprobantes',
['uses' => 'ReporteComprasController@Txtcomprobantes']
);
Route::match(['get', 'post'],'/Reporte/Compras/Detraccion',
['uses' => 'ReporteComprasController@ImportarDetraccion']
);
Route::match(['get', 'post'],'/Reporte/Ventas/Rentas',
['uses' => 'ReporteVentasController@ImportarRentas']
);
Route::match(['get', 'post'],'/Reporte/Ventas/Importar',
['uses' => 'ReporteVentasController@ImportarVentas']
);
Route::match(['get', 'post'],'/Reporte/Ventas/Coeficiente',
['uses' => 'ReporteVentasController@Coeficiente']
);
Route::match(['get', 'post'],'/Reporte/Exportar',
['uses' => 'ReporteComprasController@ExportarReporte']
);
Route::match(['get', 'post'],'/Reporte/Prorrata',
['uses' => 'ReporteComprasController@GuardarProrrata']
);
Route::match(['get', 'post'],'/Reporte/Credito',
['uses' => 'ReporteComprasController@GuardarCredito']
);


Route::match(['get', 'post'],'/Validador',
['uses' => 'ValidacionController@Index']
);
Route::match(['get', 'post'],'/Validador/Importar',
['uses' => 'ValidacionController@Importar']
);
Route::match(['get', 'post'],'/Validador/Exportar',
['uses' => 'ValidacionController@Exportar']
);

Route::match(['get', 'post'],'/Xml',
['uses' => 'FacturaController@Index']
);
Route::match(['get', 'post'],'/Xml/create',
['uses' => 'FacturaController@create']
);
Route::match(['get', 'post'],'/Xml/Nuevo',
['uses' => 'FacturaController@Nuevo']
);
Route::match(['get', 'post'],'/Xml/Exportar',
['uses' => 'FacturaController@Exportar']
);
Route::match(['get', 'post'],'/Xml/Show',
['uses' => 'FacturaController@show']
);
Route::match(['get', 'post'],'/upload',[
    'uses' => 'FacturaController@GetData'
]);
Route::match(['get', 'post'],'/Factura/Eliminar',[
    'uses' => 'FacturaController@eliminar'
]);

Route::match(['get', 'post'],'/Seguimiento', function () {
    
    $user = Auth::user();
    $userdatacount = Userdata::where('user_id','=',$user->id)->count();
    if($userdatacount>0)
    {
        $userdata = Userdata::firstWhere('user_id','=',$user->id);
        return view('layouts.seguimiento',['user'=>$user,'userdata'=>$userdata]);
    } else {
        $userdata = new Userdata();
        $userdata->user_id = Auth::user()->id;
        $userdata->save();
        return view('layouts.seguimiento',['user'=>$user,'userdata'=>$userdata]);
    }
});
Route::match(['get', 'post'],'/Seguimiento/Data', 'SeguimientoController@data');

Route::match(['get', 'post'],'/Userdata', function () {

    $user = Auth::user();
    $userdatacount = Userdata::where('user_id','=',$user->id)->count();
    $empresas = Empresa::get()->where('user_id','=',$user->id);
    $aprobadores = Aprobador::get()->where('user_id','=',$user->id);

   // return $empresas;

    if($userdatacount>0)
    {
        $userdata = Userdata::firstWhere('user_id','=',$user->id);
        $empresa = Empresa::firstWhere('id','=', $userdata->empresa);
        $aprobador = Empresa::firstWhere('id','=', $userdata->aprobador_id);
        return view('layouts.userdata',['aprobador'=>$aprobador,'aprobadores'=>$aprobadores,'empresa'=>$empresa,'user'=>$user,'userdata'=>$userdata,'empresas'=>$empresas]);
    } else {
        $userdata = new Userdata();
        $userdata->user_id = Auth::user()->id;
        $userdata->save();
        return view('layouts.userdata',['aprobadores'=>$aprobadores,'user'=>$user,'userdata'=>$userdata,'empresas'=>$empresas]);
    }
});
Route::match(['get', 'post'],'/Userdata/Perfil', 'UserdataController@perfil');
Route::match(['get', 'post'],'/Userdata/Empresa', 'UserdataController@empresa');

Route::post('/Userdata/Data', 'UserdataController@index' );
Route::post('/Userdata/Editar', 'UserdataController@store' );

Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get', 'post'],'/Modulo/Caja', 'CajaController@index' )->name('View.Caja');
Route::post('/Caja/Liquidacion', 'CajaController@liquidacion' );
Route::match(['get', 'post'],'/Caja/Nuevo', 'CajaController@nuevaliquidacion' );
Route::match(['get', 'post'],'/Caja/Totales', 'CajaController@obtenertotales' );

Route::post('/Caja/Cajachica', 'CajaController@cajachica' );
Route::post('/Caja/Cajachica/Adicion', 'CajaController@cajachicainsert' );
Route::post('/Caja/Cajachica/Info', 'CajaController@cajachicainfo');
Route::match(['get', 'post'], '/Caja/cajachica/Exportar', 'CajaController@cajachicaexportar');

Route::post('/Caja/Rendirpago', 'CajaController@rendirpago' );
Route::post('/Caja/Rendirpago/Adicion', 'CajaController@rendirpagoinsert' );
Route::post('/Caja/Rendirpago/Info', 'CajaController@rendirpagoinfo');
Route::match(['get', 'post'], '/Caja/rendirpago/Exportar', 'CajaController@cajachicaexportar');

Route::get('/Caja/Parametros', function () { return view('modules.caja.parametros'); })->name('View.Parametros');

Route::get('/Muestreo', function () { return view('modules.muestreo.muestreo'); })->name('View.Muestreo');

Route::get('/Muestreo/Compras', 'MayorcompraController@Index');
Route::get('/Muestreo/Gastos', 'MayorgastoController@Index');
Route::get('/Muestreo/Ventas', 'MayorventaController@Index');

Route::match(['get', 'post'],'/Muestreo/Compras/Destroy', 'TrashController@trash_archivo_compras');
Route::match(['get', 'post'],'/Muestreo/Gastos/Destroy', 'TrashController@trash_archivo_gastos');
Route::match(['get', 'post'],'/Muestreo/Ventas/Destroy', 'TrashController@trash_archivo_ventas');

Route::match(['get', 'post'], '/ImportarExcelCompra', 'MayorcompraController@importar');
Route::match(['get', 'post'], '/ExportarExcelCompra', 'MayorcompraController@exportar');
Route::match(['get', 'post'], '/FiltrarExcelCompra', 'MayorcompraController@filtrar');

Route::match(['get', 'post'], '/ImportarExcelVentas', 'MayorventaController@importar');
Route::match(['get', 'post'], '/ExportarExcelVentas', 'MayorventaController@exportar');
Route::match(['get', 'post'], '/FiltrarExcelVentas', 'MayorventaController@filtrar');

Route::match(['get', 'post'], '/ImportarExcelGastos', 'MayorgastoController@importar');
Route::match(['get', 'post'], '/ExportarExcelGastos', 'MayorgastoController@exportar');
Route::match(['get', 'post'], '/FiltrarExcelGastos', 'MayorgastoController@filtrar');

Route::match(['get', 'post'], '/ImportExcelActivo', 'ActivofijoController@import');

Auth::routes();

Route::get('/Caja/Parametros', function () { return view('modules.caja.parametros'); })->name('View.Parametros');

Route::get('/Activos', 'ActivofijoController@Index');
Route::match(['get', 'post'], '/Activos/Importar', 'ActivofijoController@importar');
Route::match(['get', 'post'], '/Activos/Filtrar', 'ActivofijoController@filtrar');
Route::match(['get', 'post'], '/Activos/Exportar', 'ActivofijoController@exportar');
Route::match(['get', 'post'], '/Activos/Destroy', 'ActivofijoController@Destroy');

Route::get('/Balance', function () {

    if(Auth::check()){
        $tipo = 18;
        $uso_id = 0;
        $idusuario = Auth::user()->id;
        $contadorusoactivos = DB::table('usos')->where('idusuario','=',$idusuario)->where('idtipo','=',$tipo)->count();
        
        $aprobadores = DB::table('aprobadors')->where('user_id','=',Auth::user()->id)->get();
        
        if($contadorusoactivos > 0)
        {
            $uso = DB::table('usos')
            ->where('idusuario','=',$idusuario)
            ->where('idtipo','=',$tipo)
            ->latest()
            ->first();

            return view('modules.balance.balance',['uso' => $uso,'aprobadores' => $aprobadores]);
            
        } else {
            $uso = new Uso();
            $uso->idusuario = $idusuario;
            $uso->uso_id = 0;
            $uso->referencia = 'Ejemplo de referencia balance';
            $uso->idtipo = $tipo;
            $uso->save();

            return view('modules.balance.balance',['uso' => $uso,'aprobadores' => $aprobadores]);
        }
    }

return view('modules.balance.balance');
})->name('View.Balance');

Route::match(['get', 'post'], '/Balance/Importar', 'BalanceController@importar');
Route::match(['get', 'post'], '/Balance/Exportar', 'BalanceController@exportar');

Route::get('/Centrocosto', function () { 
    $Centrocosto = new Centrocosto([
        'codigo' => '49448',
        'descripcion' => 'Centro costo 1'
    ]);
    $Centrocosto->save();

    $Centrocostos = DB::table('Centrocostos')->get();
    return $Centrocostos;
});
Route::get('/Activos/Tipouso', function () { 
    
    $tipo = new Tipouso([
        'descripcion' => 'Validacion'
    ]);
    $tipo->save();

    $activos = DB::table('tipousos')->get();
    return $activos; });

Route::get('/Codigocontable', function () { 
    
    $Codigocontable = new Codigocontable([
        'codigo' => '79988',
        'descripcion' => 'Contable 1'
    ]);
    $Codigocontable->save();

    $Codigocontable2 = new Codigocontable([
        'codigo' => '79999',
        'descripcion' => 'Contable 2',
        'idpais' => 1
    ]);
    $Codigocontable2->save();

    $codigocontables = DB::table('codigocontables')->get();
    return $codigocontables; });

Route::get('/Monedas', function () { 
    
    $pais = new Pais([
        'codigo' => '01',
        'descripcion' => 'Perú'
    ]);
    $pais->save();

    $moneda = new Moneda([
        'codigo' => '01',
        'descripcion' => 'Nuevo sol',
        'idpais' => 1
    ]);
    $moneda->save();

    $pais = new Pais([
        'codigo' => '02',
        'descripcion' => 'EEUU'
    ]);
    $pais->save();

    $moneda = new Moneda([
        'codigo' => '02',
        'descripcion' => 'DOLAR',
        'idpais' => 2
    ]);
    $moneda->save();

    $pais = DB::table('pais')->get();
    $monedas = DB::table('monedas')->get();
    return ['monedas'=>$monedas,'dnis'=>$pais]; });

Route::get('/Dni', function () { 
    
    $dni = new Dni([
        'codigo' => '01',
        'descripcion' => 'DNI'
    ]);
    $dni->save();

    $dni2 = new Dni([
        'codigo' => '02',
        'descripcion' => 'PASSAPORTE'
    ]);
    $dni2->save();

    $dni3 = new Dni([
        'codigo' => '03',
        'descripcion' => 'OTROS'
    ]);
    $dni3->save();

    $dnis = DB::table('dnis')->get();
    return $dnis; });

Route::get('/DTR', function () { 

    $dtr1 = new DTR(['COD' => '008','MCOD'=>'8','Porcentaje'=>0.04,'Denominacion'=>'Madera']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'010','MCOD'=>'10','Porcentaje'=>0.15,'Denominacion'=>'Residuos, subproductos, desechos.']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'012','MCOD'=>'12','Porcentaje'=>0.12,'Denominacion'=>'Intermed. Laboral y Tercerización']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'019','MCOD'=>'19','Porcentaje'=>0.10,'Denominacion'=>'Arrendamiento de muebles']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'020','MCOD'=>'20','Porcentaje'=>0.12,'Denominacion'=>'Manten. / Reparación bienes muebles']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'021','MCOD'=>'21','Porcentaje'=>0.10,'Denominacion'=>'Movimiento de carga']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'022','MCOD'=>'22','Porcentaje'=>0.12,'Denominacion'=>'Otros servicios empresariales']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'024','MCOD'=>'24','Porcentaje'=>0.10,'Denominacion'=>'Comisión Mercantil']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'025','MCOD'=>'25','Porcentaje'=>0.10,'Denominacion'=>'Fabricación de bienes por encargo']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'026','MCOD'=>'26','Porcentaje'=>0.10,'Denominacion'=>'Transporte de personas']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'027','MCOD'=>'27','Porcentaje'=>0.04,'Denominacion'=>'ransporte de bienes']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'030','MCOD'=>'30','Porcentaje'=>0.04,'Denominacion'=>'ontrato de construcción']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'037','MCOD'=>'37','Porcentaje'=>0.12,'Denominacion'=>'Demás servicios gravados con el IGV']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'039','MCOD'=>'39','Porcentaje'=>0.10,'Denominacion'=>'Minerales no metálicos']);
    $dtr1->save();
    $dtr1 = new DTR(['COD'=>'099','MCOD'=>'99','Porcentaje'=>0.08,'Denominacion'=>'ey N° 30737']);
    $dtr1->save();

    $data = DB::table('d_t_r_s')->get();
    return $data;
});

Route::get('/TipoUso', function () { 
    
    $tipo = new Tipouso([
        'descripcion' => 'Reporte'
    ]);
    
    $tipo = new Tipouso([
        'descripcion' => 'Reporte de Compras'
    ]);
    $tipo->save();


    $tipos = DB::table('tipousos')->get();
    return $tipos; });


    Route::get('/Muestreo/Aprobadores', function () { 
    
        $aprobador = new Aprobador([
            'nombre' => 'Jorge',
            'apellido' => 'Hospinal',
            'dni' => '72733291',
            'telefono' => '966153268',
            'correo' => 'jorge.hospinal@yahoo.com',
            'user_id' => Auth::user()->id
        ]);
        $aprobador->save();
    
        $aprobador = new Aprobador([
            'nombre' => 'Axel',
            'apellido' => 'Davis',
            'dni' => '72755591',
            'telefono' => '966222268',
            'correo' => 'example@yahoo.com',
            'user_id' => Auth::user()->id
        ]);
        $aprobador->save();
    
        $aprobadores = DB::table('aprobadors')->get();
        return $aprobadores; });

        Route::get('/Muestreo/MIERDA', function () { 
            
            $columnas = ['IdUso','IdArchivo','Cuo','TipoCuenta','NumeroCuenta','NumeroConstancia','PeriodoTributario','RucProveedor',
            'NombreProveedor','TipoDocumentoAdquiriente','NumeroDocumentoAdquiriente','RazonSocialAdquiriente','FechaPago',
            'MontoDeposito','TipoBien','TipoOperacion','TipoComprobante','SerieComprobante','NumeroComprobante','NumeroPagoDetraciones',
            'Porcentaje','Base','ValidacionBase','Denominacion'];
            $aprobadores = DB::table('aprobadors')->get();
            return $aprobadores; 
        });
