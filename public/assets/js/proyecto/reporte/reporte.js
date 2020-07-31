eventosreporte();

var tabla_var_rcompras = "";
var tabla_var_rventas = "";
var tabla_var_rrentas = "";
var tabla_var_rresultadoruc = "";
var tabla_var_rdetraccion = "";

function confirmar(data){
	console.log(data);
}

function tablareportecomprasvalidacion(id)
{
	let botonesreporte = [
		{
			btn_text: '<i class="fas fa-trash-alt"></i>',
			funcion: cambiarregistrotag,
			ruta: '/Delete/trash_reporte_compras',
			id_columnname: 'IdCool',
			tag: true,
            confirm: delete_row_rcompras,
        }
    ];

    function delete_row_rcompras(data) {
        function eliminartablachill() {
            tabla_var_rcompras
                .row(data.tag.closest('tr'))
                .remove()
                .draw();
        }
        eliminartablachill();
        console.log(data);
    }
	let botonesdetraccion = [
		{
			btn_text: '<i class="fas fa-trash-alt"></i>',
			funcion: cambiarregistrotag,
			ruta: '/Delete/trash_detraccion_compras',
			id_columnname: 'id',
			tag: true,
            confirm: delete_row_rdetraccion,
        }
    ];

    function delete_row_rdetraccion(data) {
        function eliminartablachill() {
            tabla_var_rdetraccion
                .row(data.tag.closest('tr'))
                .remove()
                .draw();
        }
        eliminartablachill();
        console.log(data);
    }
	let botonesruc = [
		{
			btn_text: '<i class="fas fa-trash-alt"></i>',
			funcion: cambiarregistrotag,
			ruta: '/Delete/trash_resultados_ruc',
			id_columnname: 'id',
			tag: true,
            confirm: delete_row_rresultadoruc,
        }
    ];

    function delete_row_rresultadoruc(data) {
        function eliminartablachill() {
            tabla_var_rresultadoruc
                .row(data.tag.closest('tr'))
                .remove()
                .draw();
        }
        eliminartablachill();
        console.log(data);
    }
	/*let botonesventas = [
		{
			btn_text: '<i class="fas fa-trash-alt"></i>',
			funcion: cambiarregistrotag,
			ruta: '/Delete/trash_resultados_ruc',
			id_columnname: 'id',
			tag: true,
			confirm: delete_row,
		}
	];*/
	let checks = [
		{
			label: 'Liberar :',
			funcion: cambiarregistro,
			ruta: '/Reporte/Compras/Liberar',
			id_columnname: 'IdCool',
			confirm: confirmar,
			checkflag: 'Liberar',
			negative: 'no',
			positive: 'si',
		},
		{
			label: 'Excluir :',
			funcion: cambiarregistro,
			ruta: '/Reporte/Compras/Status',
			id_columnname: 'IdCool',
			confirm: confirmar,
			checkflag: 'Status',
			negative: 'no',
			positive: 'si',
		}
	];
	let botonesrentas = [
		{
			btn_text: '<i class="fas fa-trash-alt"></i>',
			funcion: cambiarregistrotag,
			ruta: '/Delete/trash_renta',
			id_columnname: 'id',
			tag: true,
            confirm: delete_row_rrentas,
        }
    ];

    function delete_row_rrentas(data) {
        function eliminartablachill() {
            tabla_var_rrentas
                .row(data.tag.closest('tr'))
                .remove()
                .draw();
        }
        eliminartablachill();
        console.log(data);
    }

	let botonesventas = [
		{
			btn_text: '<i class="fas fa-trash-alt"></i>',
			funcion: cambiarregistrotag,
			ruta: '/Delete/trash_reporte_ventas',
			id_columnname: 'id',
			tag: true,
            confirm: delete_row_rventas,
        }
    ];

    function delete_row_rventas(data) {
        function eliminartablachill() {
            tabla_var_rventas
                .row(data.tag.closest('tr'))
                .remove()
                .draw();
        }
        eliminartablachill();
        console.log(data);
    }

	var formdata = new FormData();
	formdata.set('iduso',id);

	ejecutarruta(formdata,'/Reporte/Compras/Data',confirmartabla);
	
	var data_validacion = "";
	var data_dtr = "";
	var data_resultadoruc = "";
	var data_rentas = "";
	var data_ventas = "";
	

	var data_detracciones = "";
	var data_compras = "";
	var data_archivosruc = "";
	var data_archivosrentas = "";
	var data_archivosventas = "";

	
	let cabecera1 = 
	[
		'TipoCuenta','NumeroCuenta','NumeroConstancia','PeriodoTributario','RucProveedor',
		'NombreProveedor','TipoDocumentoAdquiriente','NumeroDocumentoAdquiriente','RazonSocialAdquiriente','FechaPago',
		'MontoDeposito','TipoBien','TipoOperacion','TipoComprobante','SerieComprobante','NumeroComprobante','NumeroPagoDetraciones',
		'ValidacionPorcentual','Base','ValidacionBase','TipoServicio','Opciones'
	]
	let columnas1 = 
	[
		'TipoCuenta','NumeroCuenta','NumeroConstancia','PeriodoTributario','RucProveedor',
		'NombreProveedor','TipoDocumentoAdquiriente','NumeroDocumentoAdquiriente','RazonSocialAdquiriente','FechaPago',
		'MontoDeposito','TipoBien','TipoOperacion','TipoComprobante','SerieComprobante','NumeroComprobante','NumeroPagoDetraciones',
		'Porcentaje','Base','ValidacionBase','Denominacion'
	]

	let cabecera2 = 
	[	
		'LIBERAR','EXCLUIR','PERIODO','CUO','ORD','FECHA EMISION','FECHA VENCIMIENTO','T. COMPR.','N. SERIE','Año de DUA',
		'N. COMPROBANTE','N. TICKETS','T. DOC. IDENTIDAD','N. DOCUMENTO','APELLIDOS Y NOMBRE, DENOMINACIÓN SOCIAL',
		'B.Imponible OG','IGV Y/o IPM','B. Imponible OG y ONG','IGV Y/o IPM','B. Imponible ONG','IGV Y/o IPM',
		'Adquisiciones no gravadas','ISC','OTROS','TOTAL','MONEDA','TIPO DE CAMBIO','FECHA DOC. ORIGINAL',
		'T. COMPROBANTE DOC. ORIGINAL','N. SERIE DOC. ORIGINAL','Año de DUA','N. SERIE DOC. ORIGINAL',
		'Detracción: Fecha','Detracción: Número','Retención','Clasif. Bienes y servicios','Contrato','Error tipo 1',
		'Error tipo 2','Error tipo 3','Error tipo 4','Indicador de medio de pago','ESTADO','NumeroConstancia','FechaPago','Comentario','OPCIONES'
	]
	let columnas2 =
	[
		'Periodo','Correlativo','Orden','FecEmision','FecVenci','TipoComp','NumSerie','AnoDua','NumComp',
		'NumTicket','TipoDoc','NroDoc','Nombre','BIAG1','IGVIPM1','BIAG2','IGVIPM2','BIAG3','IGVIPM3',
		'AdqGrava','ISC','Otros','Total','Moneda','TipoCam','FecOrigenMod','TipoCompMod','NumSerieMod',
		'AnoDuaMod','NumSerComOriMod','FecConstDetrac','NumConstDetrac','Retencion','ClasifBi','Contrato',
		'ErrorT1','ErrorT2','ErrorT3','ErrorT4','MedioPago','Estado','NumeroConstancia','FechaPago','Comentario',
	]
	let cabecera3 = 
	[
		'NumeroRuc','RazonSocial','TipoContribuyente','ProfesionOficio',
		'NombreComercial','CondicionContribuyente','EstadoContribuyente','FechaInscripcion',
		'FechaInicioActividades','Departamento','Provincia','Distrito','Direccion','Telefono',
		'Fax','ActividadComercioExterior','PrincipalCIIU','CIIU1','CIIU2','RUS','BuenContribuyente',
		'AgenteRetencion','AgentePercepcionVtaInt','AgentePercepcionComLiq','Opciones'
	];
		
	let columnas3 = 
	[
		'NumeroRuc','RazonSocial','TipoContribuyente','ProfesionOficio',
		'NombreComercial','CondicionContribuyente','EstadoContribuyente','FechaInscripcion',
		'FechaInicioActividades','Departamento','Provincia','Distrito','Direccion','Telefono',
		'Fax','ActividadComercioExterior','PrincipalCIIU','CIIU1','CIIU2','RUS','BuenContribuyente',
		'AgenteRetencion','AgentePercepcionVtaInt','AgentePercepcionComLiq',
	];

	let cabecera4 = 
	[
		'Numero',
		'Nombrecuenta',
		'Acumulado',
		'Opciones'
	];
	
	let columnas4 = 
	[
		'Numero',
		'Nombrecuenta',
		'Acumulado'
	];
	let cabecera5 = 
	[
		'Periodo','Correlativo',
		'Ordenado','FecEmision','FecVenci','TipoComp','NumSerie',
		'NumComp','NumTicket','TipoDoc','NroDoc','Nombre','Export',
		'BI','Desci','IGVIPMBI','IGVIPMDesc','ImporteExo','ImporteIna',
		'ISC','BIIGVAP','IGVAP','Otros','Total','Moneda','TipoCam',
		'FecOrigenMod','TipoCompMod','NumSerieMod','NumDocMod',
		'Contrato','ErrorT1','MedioPago','Estado','Opciones'
	];
		
	let columnas5 = 
	[
		'Periodo','Correlativo',
		'Ordenado','FecEmision','FecVenci','TipoComp','NumSerie',
		'NumComp','NumTicket','TipoDoc','NroDoc','Nombre','Export',
		'BI','Desci','IGVIPMBI','IGVIPMDesc','ImporteExo','ImporteIna',
		'ISC','BIIGVAP','IGVAP','Otros','Total','Moneda','TipoCam',
		'FecOrigenMod','TipoCompMod','NumSerieMod','NumDocMod',
		'Contrato','ErrorT1','MedioPago','Estado'
	];

	function confirmardataini(){
		console.log('completada carga inicial');
	}

	var data_ini = "";

	function confirmartabla(data) {
		data_ini = data;
		console.log(data);

		data_validacion = data_ini.validacion;
		data_dtr = data_ini.dtr;
		data_resultadoruc = data_ini.resultadoruc;
		data_rentas = data_ini.rentas;
		data_ventas = data_ini.ventas;
		data_detracciones = data_ini.detracciones;
		data_compras = data_ini.compras;
		data_archivosruc = data_ini.archivosruc;
		data_archivosrentas = data_ini.archivosrentas;
		data_archivosventas = data_ini.archivosventas;
	

		crearselectfromdata('#selectarchivo1',data_ini.detracciones);
		crearselectfromdata('#selectarchivo2',data_ini.compras);
		crearselectfromdata('#selectarchivoresultadoruc',data_ini.archivosruc);
		crearselectfromdata('#selectarchivorenta',data_ini.archivosrentas);
		crearselectfromdata('#selectarchivoventas',data_ini.archivosventas);

		tabla_var_rventas = creartablaseven(data_ventas,formdata,'#cargaventas','table table-bordered','tablaventas','#divventastable',cabecera5,columnas5,true,confirmardataini,botonesventas,tabla_var_rventas);
        tabla_var_rcompras = creartablasix(data_validacion, checks, formdata, '#cargareportecomprasfile', 'table table-bordered', 'tablareporte1', '#divreportecomprastable', cabecera2, columnas2, true, confirmardataini, botonesreporte, tabla_var_rcompras);
        tabla_var_rdetraccion = creartablaseven(data_dtr, formdata, '#cargadetraccioncompras', 'table table-bordered', 'tablareporte2', '#divdetraccioncomprastable', cabecera1, columnas1, true, confirmardataini, botonesdetraccion, tabla_var_rdetraccion);
        tabla_var_rresultadoruc = creartablaseven(data_resultadoruc, formdata, '#cargaresultadoruc', 'table table-bordered', 'tablareporte3', '#divresultadoructable', cabecera3, columnas3, true, confirmardataini, botonesruc, tabla_var_rresultadoruc);
        tabla_var_rrentas = creartablaseven(data_rentas, formdata, '#cargarenta', 'table table-bordered', 'tablarenta', '#divrentatable', cabecera4, columnas4, true, confirmardataini, botonesrentas, tabla_var_rrentas);
		generarprorrata('','#divprorrata',data_ini.prorratas);
		generarcredito('','#divcredito',data_ini.creditos);
	}
	
	//creartablafive('ventas',formdata,'#cargaventas','table table-bordered','tablaventas','#divventastable','/Reporte/Compras/Data',cabecera5,columnas5,true,confirmartabla,botonesventas);
	//creartablafour('validacion',checks,formdata,'#cargareportecomprasfile','table table-bordered','tablareporte1','#divreportecomprastable','/Reporte/Compras/Data',cabecera2,columnas2,true,confirmartabla,botonesreporte);
	//creartablafive('dtr',formdata,'#cargadetraccioncompras','table table-bordered','tablareporte2','#divdetraccioncomprastable','/Reporte/Compras/Data',cabecera1,columnas1,true,confirmartabla,botonesdetraccion);
	//creartablafive('resultadoruc',formdata,'#cargaresultadoruc','table table-bordered','tablareporte3','#divresultadoructable','/Reporte/Compras/Data',cabecera3,columnas3,true,confirmartabla,botonesruc);
	//creartablafive('rentas',formdata,'#cargarenta','table table-bordered','tablarenta','#divrentatable','/Reporte/Compras/Data',cabecera4,columnas4,true,confirmartabla,botonesruc);	
}

function eventosreporte()
{
	$('#formeliminardata-detraccion').submit(function(e){
		e.preventDefault();
		crearselectconruta('archivos','/Delete/trash_detraccion','#formeliminardata-detraccion','id_archivo','selectarchivo1','#div-select-detraccion','id',['id','ruta'],' - ');
	});
	$('#formeliminardata-compras').submit(function(e){
		e.preventDefault();
		crearselectconruta('archivos','/Delete/trash_r_compras','#formeliminardata-compras','id_archivo','selectarchivo2','#div-select-compras','id',['id','ruta'],' - ');
	});
	$('#formeliminardata-ruc').submit(function(e){
		e.preventDefault();
		crearselectconruta('archivos','/Delete/trash_r_ruc','#formeliminardata-ruc','id_archivo','selectarchivoresultadoruc','#div-select-ruc','id',['id','ruta'],' - ');
	});
	$('#formeliminarrenta').submit(function(e){
		e.preventDefault();
		crearselectconruta('archivos','/Delete/trash_r_rentas','#formeliminarrenta','id_archivo','selectarchivorenta','#div-select-rentas','id',['id','ruta'],' - ');
	});
	$('#formeliminarventas').submit(function(e){
		e.preventDefault();
		crearselectconruta('archivos','/Delete/trash_r_ventas','#formeliminarventas','id_archivo','selectarchivoventas','#div-select-ventas','id',['id','ruta'],' - ');
	});
	
	set_ruta('/Delete/trash_uso_reporte?iduso=');
	seteventview('/New/new_reporte');
	let id = document.querySelector('#uso_id').value;
	tablareportecomprasvalidacion(id);

	setview('#form-historico','#content','/Old/old_reporte');
	///
	$('#reportecomprasfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#reportecompraslabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	///
	$('#detraccioncomprasfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#detraccioncompraslabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	///
	$('#resultadorucfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#resultadoruclabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#resultadocomprobantefile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#resultadocomprobantelabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#rentafile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#rentalabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#ventasfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#ventaslabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	///
	$('#formresultadoruc').submit(function(event){
		event.preventDefault();
		let botonesruc = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_resultados_ruc',
				id_columnname: 'id',
				tag: true,
                confirm: delete_row_rresultadoruc,
            }
        ];

        function delete_row_rresultadoruc(data) {
            function eliminartablachill() {
                tabla_var_rresultadoruc
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }
		let form = document.querySelector('#formresultadoruc');
		let formdata = new FormData(form);
		function confirmartabla(data) {
			crearselect('#selectarchivoresultadoruc',data,'archivos');
		}
		let cabecera = 
		[
			'NumeroRuc','RazonSocial','TipoContribuyente','ProfesionOficio',
			'NombreComercial','CondicionContribuyente','EstadoContribuyente','FechaInscripcion',
			'FechaInicioActividades','Departamento','Provincia','Distrito','Direccion','Telefono',
			'Fax','ActividadComercioExterior','PrincipalCIIU','CIIU1','CIIU2','RUS','BuenContribuyente',
			'AgenteRetencion','AgentePercepcionVtaInt','AgentePercepcionComLiq','Opciones'
		];
		
		let columnas = 
		[
			'NumeroRuc','RazonSocial','TipoContribuyente','ProfesionOficio',
			'NombreComercial','CondicionContribuyente','EstadoContribuyente','FechaInscripcion',
			'FechaInicioActividades','Departamento','Provincia','Distrito','Direccion','Telefono',
			'Fax','ActividadComercioExterior','PrincipalCIIU','CIIU1','CIIU2','RUS','BuenContribuyente',
			'AgenteRetencion','AgentePercepcionVtaInt','AgentePercepcionComLiq',
		   ];
		
		creartablafive('resultado',formdata,'#cargaresultadoruc','table table-bordered','tablareporte3','#divresultadoructable','/Reporte/Compras/Resultadoconsultaruc',cabecera,columnas,true,confirmartabla,botonesruc);
	});
	$('#formresultadocomprobantes').submit(function(event){
		event.preventDefault();
		let botonesdetraccion = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_reporte_comprobantes',
				id_columnname: 'id',
				tag: true,
				confirm: delete_row,
			}
        ];
		let form = document.querySelector('#formresultadocomprobantes');
		let formdata = new FormData(form);
		function confirmartabla(data) {
			crearselect('#selectarchivoresultadocomprobantes',data,'resultadoscomprobantes');
		}
		let cabecera = 
		[
			
		]
		
		let columnas = 
		[
			
		]
		
		creartablafive('resultadocomprobantes',formdata,'#cargaresultadocomprobantes','table table-bordered','tablareporte4','#divresultadocomprobantestable','/Reporte/Reporte/Consultacomprobantes',cabecera,columnas,true,confirmartabla,botonescomprobantes);
	});
	///
	$('#formdetraccioncompras').submit(function(event){
		event.preventDefault();
		let botonesdetraccion = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_detraccion_compras',
				id_columnname: 'id',
				tag: true,
                confirm: delete_row_rdetraccion,
            }
        ];

        function delete_row_rdetraccion(data) {
            function eliminartablachill() {
                tabla_var_rdetraccion
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }
		let form = document.querySelector('#formdetraccioncompras');
		let formdata = new FormData(form);
		function confirmartabla(data) {
			crearselect('#selectarchivo1',data,'detracciones');
			crearselect('#selectarchivo2',data,'compras');
		}
		let cabecera = 
		[
			'TipoCuenta','NumeroCuenta','NumeroConstancia','PeriodoTributario','RucProveedor',
            'NombreProveedor','TipoDocumentoAdquiriente','NumeroDocumentoAdquiriente','RazonSocialAdquiriente','FechaPago',
            'MontoDeposito','TipoBien','TipoOperacion','TipoComprobante','SerieComprobante','NumeroComprobante','NumeroPagoDetraciones',
			'ValidacionPorcentual','Base','ValidacionBase','TipoServicio','Opciones'
		]
		
		let columnas = 
		[
			'TipoCuenta','NumeroCuenta','NumeroConstancia','PeriodoTributario','RucProveedor',
            'NombreProveedor','TipoDocumentoAdquiriente','NumeroDocumentoAdquiriente','RazonSocialAdquiriente','FechaPago',
            'MontoDeposito','TipoBien','TipoOperacion','TipoComprobante','SerieComprobante','NumeroComprobante','NumeroPagoDetraciones',
			'Porcentaje','Base','ValidacionBase','Denominacion'
		]

        creartablafive('dtr', formdata, '#cargadetraccioncompras', 'table table-bordered', 'tablareporte2', '#divdetraccioncomprastable', '/Reporte/Compras/Detraccion', cabecera, columnas, true, confirmartabla, botonesdetraccion, tabla_var_rdetraccion);
	});
	///
	$('#formcargareportecompras').submit(function(event){
		event.preventDefault();
		let botonesreporte = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_reporte_compras',
				id_columnname: 'IdCool',
				tag: true,
                confirm: delete_row_rcompras,
            }
        ];

        function delete_row_rcompras(data) {
            function eliminartablachill() {
                tabla_var_rcompras
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }

        let checks = [
			{
				label: 'Liberar :',
				funcion: cambiarregistro,
				ruta: '/Reporte/Compras/Liberar',
				id_columnname: 'IdCool',
				confirm: confirmar,
				checkflag: 'Liberar',
				negative: 'no',
				positive: 'si',
			},
			{
				label: 'Excluir :',
				funcion: cambiarregistro,
				ruta: '/Reporte/Compras/Status',
				id_columnname: 'IdCool',
				confirm: confirmar,
				checkflag: 'Status',
				negative: 'no',
				positive: 'si',
			}
		];
		let form = document.querySelector('#formcargareportecompras');
		let formdata = new FormData(form);
		function confirmartabla(data) {
			crearselect('#selectarchivo1',data,'detracciones');
			crearselect('#selectarchivo2',data,'compras');
		}
		let cabecera = 
		[	
			'LIBERAR','EXCLUIR','PERIODO','CUO','ORD','FECHA EMISION','FECHA VENCIMIENTO','T. COMPR.','N. SERIE','Año de DUA',
			'N. COMPROBANTE','N. TICKETS','T. DOC. IDENTIDAD','N. DOCUMENTO','APELLIDOS Y NOMBRE, DENOMINACIÓN SOCIAL',
			'B.Imponible OG','IGV Y/o IPM','B. Imponible OG y ONG','IGV Y/o IPM','B. Imponible ONG','IGV Y/o IPM',
			'Adquisiciones no gravadas','ISC','OTROS','TOTAL','MONEDA','TIPO DE CAMBIO','FECHA DOC. ORIGINAL',
			'T. COMPROBANTE DOC. ORIGINAL','N. SERIE DOC. ORIGINAL','Año de DUA','N. SERIE DOC. ORIGINAL',
			'Detracción: Fecha','Detracción: Número','Retención','Clasif. Bienes y servicios','Contrato','Error tipo 1',
			'Error tipo 2','Error tipo 3','Error tipo 4','Indicador de medio de pago','ESTADO','OPCIONES'
		];
		let columnas =
		[
			'Periodo','Correlativo','Orden','FecEmision','FecVenci','TipoComp','NumSerie','AnoDua','NumComp',
			'NumTicket','TipoDoc','NroDoc','Nombre','BIAG1','IGVIPM1','BIAG2','IGVIPM2','BIAG3','IGVIPM3',
			'AdqGrava','ISC','Otros','Total','Moneda','TipoCam','FecOrigenMod','TipoCompMod','NumSerieMod',
			'AnoDuaMod','NumSerComOriMod','FecConstDetrac','NumConstDetrac','Retencion','ClasifBi','Contrato',
			'ErrorT1','ErrorT2','ErrorT3','ErrorT4','MedioPago','Estado'
		];
		creartablafour('validacion',checks,formdata,'#cargareportecomprasfile','table table-bordered','tablareporte1','#divreportecomprastable','/Reporte/Compras/Importar',cabecera,columnas,true,confirmartabla,botonesreporte,tabla_var_rcompras);
	});
	///
	$('#formrenta').submit(function(event){
		event.preventDefault();
		let botonesrentas = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_renta',
				id_columnname: 'id',
				tag: true,
                confirm: delete_row_rrentas,
            }
        ];

        function delete_row_rrentas(data) {
            function eliminartablachill() {
                tabla_var_rrentas
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }
		let form = document.querySelector('#formrenta');
		let formdata = new FormData(form);
		function confirmartabla(data) {
			crearselect('#selectarchivorenta',data,'archivos');
		}
		let cabecera = 
		[
			'Numero',
			'Nombrecuenta',
			'Acumulado',
			'Opciones'
		];
		
		let columnas = 
		[
			'Numero',
			'Nombrecuenta',
			'Acumulado'
		];
		creartablafive('rentas',formdata,'#cargarenta','table table-bordered','tablarenta1','#divrentatable','/Reporte/Ventas/Rentas',cabecera,columnas,true,confirmartabla,botonesrentas);
	});
	///
	$('#formventas').submit(function(event){
		event.preventDefault();
		let botonesventas = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_reporte_ventas',
				id_columnname: 'id',
				tag: true,
                confirm: delete_row_rventas,
            }
        ];

        function delete_row_rventas(data) {
            function eliminartablachill() {
                tabla_var_rventas
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }
		let form = document.querySelector('#formventas');
		let formdata = new FormData(form);
		function confirmartabla(data) {
			crearselect('#selectarchivoventas',data,'archivos');
		}
		let cabecera = 
		[
			'Periodo',
			'Correlativo',
			'Ordenado',
			'FecEmision',
			'FecVenci',
			'TipoComp',
			'NumSerie',
			'NumComp',
			'NumTicket',
			'TipoDoc',
			'NroDoc',
			'Nombre',
			'Export',
			'BI',
			'Desci',
			'IGVIPMBI',
			'IGVIPMDesc',
			'ImporteExo',
			'ImporteIna',
			'ISC',
			'BIIGVAP',
			'IGVAP',
			'Otros',
			'Total',
			'Moneda',
			'TipoCam',
			'FecOrigenMod',
			'TipoCompMod',
			'NumSerieMod',
			'NumDocMod',
			'Contrato',
			'ErrorT1',
			'MedioPago',
			'Estado',
			'Opciones'
		];
		
		let columnas = 
		[
			'Periodo',
			'Correlativo',
			'Ordenado',
			'FecEmision',
			'FecVenci',
			'TipoComp',
			'NumSerie',
			'NumComp',
			'NumTicket',
			'TipoDoc',
			'NroDoc',
			'Nombre',
			'Export',
			'BI',
			'Desci',
			'IGVIPMBI',
			'IGVIPMDesc',
			'ImporteExo',
			'ImporteIna',
			'ISC',
			'BIIGVAP',
			'IGVAP',
			'Otros',
			'Total',
			'Moneda',
			'TipoCam',
			'FecOrigenMod',
			'TipoCompMod',
			'NumSerieMod',
			'NumDocMod',
			'Contrato',
			'ErrorT1',
			'MedioPago',
			'Estado'
		];
		creartablafive('ventas',formdata,'#cargaventas','table table-bordered','tablaventas','#divventastable','/Reporte/Ventas/Importar',cabecera,columnas,true,confirmartabla,botonesventas);
	});
	///
	function confirmacion(data){
		console.log('descargable configurado ..');
	};
	setviewcall('#formtxtconsultaruc','#zipsconsultaruc','/Reporte/Compras/Txtconsultaruc',confirmacion());
	setviewcall('#formtxtcomprobantes','#zipscomprobantes','/Reporte/Compras/Txtcomprobantes',confirmacion());
	$('#formexportarreporte').submit(function(event){
		ejecutarrutaexportar('#formexportarreporte','/Reporte/Exportar',confirmacion());
	});
	
}

function calcularcoeficiente()
{
	let nroventaneta = parseFloat(document.querySelector('#coeficientenroventaneta').value).toFixed(2);
	let ventaneta = parseFloat(document.querySelector('#coeficienteventaneta').value).toFixed(2);
	let nroingresosfiancierosgravados = parseFloat(document.querySelector('#coeficientenroingresosfiancierosgravados').value).toFixed(2);
	let ingresosfiancierosgravados = parseFloat(document.querySelector('#coeficienteingresosfiancierosgravados').value).toFixed(2);
	let nroingresosgravados = parseFloat(document.querySelector('#coeficientenroingresosgravados').value).toFixed(2);
	let ingresosgravados = parseFloat(document.querySelector('#coeficienteingresosgravados').value).toFixed(2);
	let nroingresosnogravados = parseFloat(document.querySelector('#coeficientenroingresosnogravados').value).toFixed(2);
	let ingresosnogravados = parseFloat(document.querySelector('#coeficienteingresosnogravados').value).toFixed(2);
	let nroenajenacion = parseFloat(document.querySelector('#coeficientenroenajenacion').value).toFixed(2);
	let enajenacion = parseFloat(document.querySelector('#coeficienteenajenacion').value).toFixed(2);
	let nrorei = parseFloat(document.querySelector('#coeficientenrorei').value).toFixed(2);
	let rei = parseFloat(document.querySelector('#coeficienterei').value).toFixed(2);
	let totalneto = parseFloat(document.querySelector('#coeficientetotalneto').value).toFixed(2);
	let ingresosdiferenciacambio = parseFloat(document.querySelector('#coeficienteingresosdiferenciacambio').value).toFixed(2);
	let ingresosnetos = parseFloat(document.querySelector('#coeficienteingresosnetos').value).toFixed(2);
	let nroimpuestocalculado = parseFloat(document.querySelector('#coeficientenroimpuestocalculado').value).toFixed(2);
	let impuestocalculado = parseFloat(document.querySelector('#coeficienteimpuestocalculado').value).toFixed(2);
	let coeficiente = parseFloat(document.querySelector('#coeficiente').value).toFixed(2);
	let coeficientefinal = parseFloat(document.querySelector('#coeficientefinal').value).toFixed(2);
	let coeficientesunat = parseFloat(document.querySelector('#coeficientesunat').value).toFixed(2);
	let coeficientepdt = parseFloat(document.querySelector('#coeficientepdt').value).toFixed(2);
	let coeficientedefinitivo = parseFloat(document.querySelector('#coeficientedefinitivo').value).toFixed(2);

	//nroventaneta;
	//ventaneta;
	//nroingresosfiancierosgravados;
	//ingresosfiancierosgravados;
	//nroingresosgravados;
	//ingresosgravados;
	//nroingresosnogravados;
	//ingresosnogravados;
	//nroenajenacion;
	//enajenacion;
	//nrorei;
	//rei;
	
	totalneto = parseFloat(ventaneta*1+ingresosfiancierosgravados*1+ingresosgravados*1+ingresosnogravados*1+enajenacion*1+rei*1).toFixed(2);
	document.querySelector('#coeficientetotalneto').value = parseFloat(totalneto).toFixed(2);

	
	
	ingresosnetos = totalneto*1 - ingresosdiferenciacambio*1;
	document.querySelector('#coeficienteingresosnetos').value = parseFloat(ingresosnetos).toFixed(2);
	//nroimpuestocalculado;
	//=SI.ERROR(REDONDEAR(E21/E19;4);0)
	
	coeficiente = parseFloat(ingresosnetos/impuestocalculado).toFixed(2);
	coeficientefinal = parseFloat(coeficiente*1).toFixed(2);
	coeficientesunat = 1.50;
	coeficientepdt = coeficiente;
	
	if(coeficientesunat > coeficientepdt){
		coeficientedefinitivo = coeficientesunat;
	} else 
	{
		coeficientedefinitivo = coeficientepdt;
	}
	
	document.querySelector('#coeficiente').value = coeficiente;
	document.querySelector('#coeficientefinal').value  = coeficientefinal;
	document.querySelector('#coeficientesunat').value = coeficientesunat;
	document.querySelector('#coeficientepdt').value = coeficientepdt;
	document.querySelector('#coeficientedefinitivo').value = coeficientedefinitivo;
}

function generarprorrata(fecha,contenedor,data)
{
	$(contenedor).html('');
	var container = document.querySelector(contenedor);
	if(fecha != "")
	{
		var date = document.querySelector(fecha).value;

		var split_date = date.split('-');

		var dates_ = 
		[
			{"mes":"enero","nro":1}
			,{"mes":"febrero","nro":2}
			,{"mes":"marzo","nro":3}
			,{"mes":"abril","nro":4}
			,{"mes":"mayo","nro":5}
			,{"mes":"junio","nro":6}
			,{"mes":"julio","nro":7}
			,{"mes":"agosto","nro":8}
			,{"mes":"setiembre","nro":9}
			,{"mes":"octubre","nro":10}
			,{"mes":"noviembre","nro":11}
			,{"mes":"diciembre","nro":12}
		];

		var sec_ = [];

		for (let index = 0; index < 12; index++) {
			let ini = parseInt(split_date[1]);
			ini = ini+index;
			if(ini > 12)
			{
				sec_.push(ini-12);
			}
			else
			{
				sec_.push(ini);
			}
		}

		console.log(sec_);

		var month_sec_ = [];
		var orden = 0;
		for (let index2 = 0; index2 < sec_.length; index2++) {
			const sec_pos = sec_[index2];
			dates_.forEach(element => {
				if(element.nro == sec_pos)
				{
					orden++;
					let obj = 
					{
						orden: orden,
						mes: element.mes
					}
					month_sec_.push(obj);
				}
			});
		}
	}
	

	var table = document.createElement('table');
	table.setAttribute('id','tabla_porrota');
	table.setAttribute('class','table table-bordered table-responsive');
	var tbody = document.createElement('tbody');
	var thead = document.createElement('thead');
	var tr = document.createElement('tr');
	var td = document.createElement('td');
	var th = document.createElement('th');
	var input = document.createElement('input');

	var header_sec_ = ["Orden","Periodo","Ventas Nacionales Gravadas","Exportaciones","Ventas No Gravadas","boletas exoneradas","NC BOLETAS EXONE","Total Vtas no Grav"];

	for (let indexh = 0; indexh < header_sec_.length; indexh++) {
		const element = header_sec_[indexh];
		th = document.createElement('th');
		th.innerHTML = element;
		tr.append(th);
	}
	thead.append(tr);
	table.append(thead);
	//////////////////////////////////////////////////////////////////////////////////////////////////
	//'Periodo','VentasNacionalesGravadas',
	//'Exportaciones','VentasNoGravadas',
	//'boletasexoneradas','NCBOLETASEXONE','TotalVtasNoGrav',
	console.log(month_sec_);
	if(data!="")
	{
		data.forEach(element => {
			tr = document.createElement('tr');
			
			td = document.createElement('td');
			td.innerHTML = element.Orden;
			tr.append(td);
			
			td = document.createElement('td');
			td.innerHTML = element.Periodo;
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.VentasNacionalesGravadas;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.Exportaciones;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.VentasNoGravadas;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.boletasexoneradas;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.NCBOLETASEXONE;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.TotalVtasNoGrav;
			td.append(input);
			tr.append(td);
			tbody.append(tr);
		});
	}
	else
	{
		for (let index3 = 0; index3 < month_sec_.length; index3++) {
			var orden = month_sec_[index3].orden;
			var element = month_sec_[index3].mes;
			tr = document.createElement('tr');
			td = document.createElement('td');
			td.innerHTML = orden;
			tr.append(td);
			
			td = document.createElement('td');
			td.innerHTML = element;
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			tbody.append(tr);
		}
	}
	
	table.append(tbody);

	container.append(table);
	
	$('#' + 'tabla_porrota').DataTable({
		"scrollY":  "200px",
		"scrollCollapse": true,
		"scrollX": true,
		"paging": false,
	});
	
}

function tabla_to_array_prorrata(tabla){
	var table = document.querySelector(tabla);
	var tbody = table.querySelector('tbody');
	var tr = tbody.querySelectorAll('tr');
	var pro_sec_array_ = [];
	var pro_sec_ = {
		"Orden" : "",
		"Periodo" : "",
		"VentasNacionalesGravadas" : "",
		"Exportaciones" : "",
		"VentasNoGravadas" : "",
		"boletasexoneradas" : "",
		"NCBOLETASEXONE" : "",
		"TotalVtasNoGrav" : "",
	};

	for (let index = 0; index < tr.length; index++) {
		const row = tr[index].querySelectorAll('td');

		pro_sec_ = {
			"Orden" : "",
			"Periodo" : "",
			"VentasNacionalesGravadas" : "",
			"Exportaciones" : "",
			"VentasNoGravadas" : "",
			"boletasexoneradas" : "",
			"NCBOLETASEXONE" : "",
			"TotalVtasNoGrav" : "",
		};

		pro_sec_.Orden = row[0].textContent;
		pro_sec_.Periodo = row[1].textContent;
		pro_sec_.VentasNacionalesGravadas = row[2].querySelector('input').value;
		pro_sec_.Exportaciones = row[3].querySelector('input').value;
		pro_sec_.VentasNoGravadas = row[4].querySelector('input').value;
		pro_sec_.boletasexoneradas = row[5].querySelector('input').value;
		pro_sec_.NCBOLETASEXONE = row[6].querySelector('input').value;
		pro_sec_.TotalVtasNoGrav = row[7].querySelector('input').value;

		pro_sec_array_.push(pro_sec_);
	}
	console.log(pro_sec_array_);

	var formdata = new FormData();
	var iduso = document.querySelector('#uso_id').value;
	formdata.append('data',JSON.stringify(pro_sec_array_));
	formdata.append('iduso',iduso);
	function conf(data)
	{
		generarprorrata('','#divprorrata',data);
	}
	ejecutarruta(formdata,'Reporte/Prorrata',conf);
}

function generarcredito(fecha,contenedor,data)
{
	$(contenedor).html('');
	var container = document.querySelector(contenedor);
	if(fecha != "")
	{
		var date = document.querySelector(fecha).value;

		var split_date = date.split('-');

		var dates_ = 
		[
			{"mes":"enero","nro":1}
			,{"mes":"febrero","nro":2}
			,{"mes":"marzo","nro":3}
			,{"mes":"abril","nro":4}
			,{"mes":"mayo","nro":5}
			,{"mes":"junio","nro":6}
			,{"mes":"julio","nro":7}
			,{"mes":"agosto","nro":8}
			,{"mes":"setiembre","nro":9}
			,{"mes":"octubre","nro":10}
			,{"mes":"noviembre","nro":11}
			,{"mes":"diciembre","nro":12}
		];

		var sec_ = [];

		for (let index = 0; index <= 11; index++) {
			let ini = parseInt(split_date[1]);
			ini = ini+index;
			if(ini > 12)
			{
				sec_.push(ini-12);
			}
			else
			{
				sec_.push(ini);
			}
		}

		console.log(sec_);

		var month_sec_ = [];

		var orden = 0;
		for (let index2 = 0; index2 < sec_.length; index2++) {
			const sec_pos = sec_[index2];
			dates_.forEach(element => {
				if(element.nro == sec_pos)
				{
					orden++;
					let obj = 
					{
						orden: orden,
						mes: element.mes
					}
					month_sec_.push(obj);
				}
			});
		}
	}
	

	var table = document.createElement('table');
	table.setAttribute('id','tabla_credito');
	table.setAttribute('class','table table-bordered');
	var tbody = document.createElement('tbody');
	var thead = document.createElement('thead');
	var tr = document.createElement('tr');
	var td = document.createElement('td');
	var th = document.createElement('th');
	var input = document.createElement('input');

	var header_sec_ = ["Orden","Mes","Ir","Credito","Saldo","Itan"];

	for (let indexh = 0; indexh < header_sec_.length; indexh++) {
		const element = header_sec_[indexh];
		th = document.createElement('th');
		th.innerHTML = element;	
		tr.append(th);
	}
	thead.append(tr);
	table.append(thead);
	//////////////////////////////////////////////////////////////////////////////////////////////////
	//'Periodo','VentasNacionalesGravadas',
	//'Exportaciones','VentasNoGravadas',
	//'boletasexoneradas','NCBOLETASEXONE','TotalVtasNoGrav'
	if(data!="")
	{
		data.forEach(element => {
			tr = document.createElement('tr');
			td = document.createElement('td');
			td.innerHTML = element.Orden;
			tr.append(td);
			td = document.createElement('td');
			td.innerHTML = element.Mes;
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.Ir;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.Credito;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.Saldo;
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			input.value = element.Itan;
			td.append(input);
			tr.append(td);
			
			tbody.append(tr);
		});
	}
	else
	{
		for (let index3 = 0; index3 < month_sec_.length; index3++) {
			var element = month_sec_[index3].orden;
			var mes = month_sec_[index3].mes;
			tr = document.createElement('tr');

			td = document.createElement('td');
			td.innerHTML = element;
			tr.append(td);
			td = document.createElement('td');
			td.innerHTML = mes;
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			td = document.createElement('td');
			input = document.createElement('input');
			input.setAttribute('class','formc-control');
			input.setAttribute('type','text');
			td.append(input);
			tr.append(td);
			
			tbody.append(tr);
		}
	}
	
	table.append(tbody);

	container.append(table);
	
	$('#' + 'tabla_credito').DataTable({
		"scrollY":  "200px",
		"scrollCollapse": true,
		"scrollX": true,
		"paging": false,
	});
	
}

function tabla_to_array_credito(tabla){
	var table = document.querySelector(tabla);
	var tbody = table.querySelector('tbody');
	var tr = tbody.querySelectorAll('tr');
	var pro_sec_array_ = [];
	var pro_sec_ = {
		"Orden":"",
		"Mes" : "",
		"Ir" : "",
		"Credito" : "",
		"Saldo" : "",
		"Itan" : "",
	};

	for (let index = 0; index < tr.length; index++) {
		const row = tr[index].querySelectorAll('td');

		pro_sec_ = {
			"Orden":"",
			"Mes" : "",
			"Ir" : "",
			"Credito" : "",
			"Saldo" : "",
			"Itan" : "",
		};

		pro_sec_.Orden = row[0].textContent;
		pro_sec_.Mes = row[1].textContent;
		pro_sec_.Ir = row[2].querySelector('input').value;
		pro_sec_.Credito = row[3].querySelector('input').value;
		pro_sec_.Saldo = row[4].querySelector('input').value;
		pro_sec_.Itan = row[5].querySelector('input').value;

		pro_sec_array_.push(pro_sec_);
	}
	console.log(pro_sec_array_);

	var formdata = new FormData();
	var iduso = document.querySelector('#uso_id').value;
	formdata.append('data',JSON.stringify(pro_sec_array_));
	formdata.append('iduso',iduso);
	function conf(data)
	{
		generarcredito('','#divcredito',data);
	}
	ejecutarruta(formdata,'Reporte/Credito',conf);
}
