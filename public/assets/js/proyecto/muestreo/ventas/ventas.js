eventosventas();

var dataventas = '';

function eventosventas(){
	$('#formeliminardata').submit(function(e){
		e.preventDefault();
		function confirmar(data) {
			console.log(data);
			crearselect('#usoarchivoselect',data,'archivos');
		}
		let formdata = new FormData(e.target);
		ejecutarruta(formdata,'/Muestreo/Ventas/Destroy',confirmar);
	});
	$('#usoarchivoselect').change(function(e){
		let idarchivo = e.target.value;
		asignarvalor('#idarchivoventas',idarchivo);
		console.log(idarchivo);
	});
	$('#ventasfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#ventaslabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#formcargaventas').submit(function(event){
		event.preventDefault();
		function setarchivoventas(data) {
			var archivo = data.archivo;
			var archivos = data.archivos;
			asignarvalor('#idarchivoventas',archivo.id);
			crearselectfromdata('#usoarchivoselect',archivos)
		}
		cargararchivo('#formcargaventas','#cargaventasfile','/ImportarExcelVentas',setarchivoventas);
	});
	$('#formfiltroventas').submit(function(event){
		event.preventDefault();
		let botonesventas = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_ventas',
				id_columnname: 'id',
				tag: true,
				confirm: delete_row_ventas,
			}
        ]

        function delete_row_ventas(data) {
            function eliminartablachill() {
                tabla_var
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }

		let form = document.querySelector('#formfiltroventas');
		let formdata = new FormData(form);
		let cabecera = 
		['Periodo','Correlativo','Ordenado',
		'FecEmision','FecVenci','TipoComp','NumSerie','NumComp','NumTicket','TipoDoc',
		'NroDoc','Cliente','Export','BI','Desci','IGVIPMBI','IGVIPMDesc','ImporteExo',
		'ImporteIna','ISC','BIIGVAP','IGVAP','Otros','Total','Moneda','TipoCam',
		'FecOrigenMod','TipoCompMod','NumSerieMod','NumDocMod','Contrato','ErrorT1',
		'MedioPago','Estado','Opciones'];
		let columnas = 
		['Periodo','Correlativo','Ordenado',
		'FecEmision','FecVenci','TipoComp','NumSerie','NumComp','NumTicket','TipoDoc',
		'NroDoc','cliente','Export','BI','Desci','IGVIPMBI','IGVIPMDesc','ImporteExo',
		'ImporteIna','ISC','BIIGVAP','IGVAP','Otros','Total','Moneda','TipoCam',
		'FecOrigenMod','TipoCompMod','NumSerieMod','NumDocMod','Contrato','ErrorT1',
		'MedioPago','Estado'];
		function confirmartabla(data) {
			console.log('tabla cargada');
			//crearselect('#usoarchivoselect',data,'archivos');
		}
		creartablatwo('ventas',formdata,'#cargafiltroventas','table table-bordered','tablaventas','#divventastable','/FiltrarExcelVentas',cabecera,columnas,true,confirmartabla,botonesventas);
	});
}

var identificadorventas = 0;
