eventosvalidador();

function eventosvalidador(){
	$('#validadorfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#validadorlabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#formcargavalidador').submit(function(event){
		event.preventDefault();
		function setarchivovalidador(data) {
			var idarchivo = data.id;
			asignarvalor('#idarchivovalidador',idarchivo);
        }
        function none() {
            console.log('check validator update');
        }
		cargararchivo('#formcargavalidador','#cargavalidadorfile','/Validador/Importar',none);
	});
	/*$('#formfiltrovalidador').submit(function(event){
		event.preventDefault();
		let botonesvalidador = [
			{
				texto: '<i class="fas fa-trash-alt"></i>',
				accion: 'borrardetalleliquidacion',
				ruta: '/Destroy/Tuvieja',
				id: 0
			}
		];
		let form = document.querySelector('#formfiltrovalidador');
		let formdata = new FormData(form);
		let columnas = ['NroDoc','cliente','Periodo','Correlativo','FecEmision','FecVenci','TipoComp','NumSerie',
		'AnoDua','NumComp','NumTicket','TipoDoc','BIAG1','IGVIPM1','BIAG2','IGVIPM2','BIAG3','AdqGrava','IGVIPM3','AdqGrava','ISC',
		'Otros','Total','Moneda','TipoCam','FecOrigenMod','TipoCompMod','NumSerieMod','AnoDuaMod','NumSerComOriMod','FecConstDetrac',
		'NumConstDetrac','Retencion','ClasifBi','Contrato','ErrorT1','ErrorT2','ErrorT3','ErrorT4','MedioPago','Estado'];
		let cabecera = ['NroDoc','cliente','Periodo','Correlativo','FecEmision','FecVenci','TipoComp','NumSerie','AnoDua','NumComp',
		'NumTicket','TipoDoc','NroDoc','Nombre','BIAG1','IGVIPM1','BIAG2','IGVIPM2','BIAG3','IGVIPM3','AdqGrava','ISC','Otros','Total',
		'Moneda','TipoCam','FecOrigenMod','TipoCompMod','NumSerieMod','AnoDuaMod','NumSerComOriMod','FecConstDetrac','NumConstDetrac',
		'Retencion','ClasifBi','Contrato','ErrorT1','ErrorT2','ErrorT3','ErrorT4','MedioPago','Estado','Opciones'];
		creartablaone(formdata,'#cargafiltrovalidador','table table-bordered','tablavalidador','#divvalidadortable','/FiltrarExcelCompra',cabecera,columnas,true,confirmartabla,botonesvalidador);
	});
	$('#btn-exportar-mayorvalidador').click(function(e){
		exportarmayorvalidador();
	});*/
}

function confirmartabla(hola) {
	datavalidador = hola;
	console.log('tabla cargada');
}

function exportarmayorvalidador() {
	console.log(JSON.stringify(datavalidador));
	console.log(datavalidador);
	var formdata = new FormData();
	formdata.set('data',JSON.stringify(datavalidador));
	$.ajax({
		url: '/ExportExcelCompra',
		type: 'POST',
		data: formdata,
		processData: false,
		contentType: false,
		success: function(data){
			console.log(data)
		}
	}).done(function(){
		
	});
}

function tablaarray(data) {
	var table = document.createElement('table');
	var thead = document.createElement('thead');
	var tbody = document.createElement('tbody');
	var tr = document.createElement('tr');
	var td = document.createElement('td');
	var th = document.createElement('th');
	for (let index = 0; index < data.length; index++) {
		const row = data[index];
		tr = document.createElement('tr');
		for (let index = 0; index < row.length; index++) {
			const col = row[index];
			td = document.createElement('td');
			td.innerHTML = col;
			tr.append(td);
		}
		tbody.append(tr);
	}
	table.append(tbody);
}
