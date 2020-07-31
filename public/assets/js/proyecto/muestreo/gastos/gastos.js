eventosgastos();

var datagastos = '';

function eventosgastos(){
	$('#formeliminardata').submit(function(e){
		e.preventDefault();
		function confirmar(data) {
			crearselect('#usoarchivoselect',data,'archivos');
		}
		let formdata = new FormData(e.target);
		ejecutarruta(formdata,'/Muestreo/Gastos/Destroy',confirmar);
	});
	$('#usoarchivoselect').change(function(e){
		let idarchivo = e.target.value;
		asignarvalor('#idarchivogastos',idarchivo);
		console.log(idarchivo);
	});
	$('#gastosfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#gastoslabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#formcargagastos').submit(function(event){
		event.preventDefault();
		function setarchivogastos(data) {
			var archivo = data.archivo;
			var archivos = data.archivos;
			asignarvalor('#idarchivogastos',archivo.id);
			crearselectfromdata('#usoarchivoselect',archivos);
		}
		cargararchivo('#formcargagastos','#cargagastosfile','/ImportarExcelGastos',setarchivogastos);
	});
	$('#formfiltrogastos').submit(function(event){
		event.preventDefault();
		
        var botonesgastos = [
            {
                btn_text: '<i class="fas fa-trash-alt"></i>',
                funcion: cambiarregistrotag,
                ruta: '/Delete/trash_gasto',
                id_columnname: 'id',
                tag: true,
                confirm: delete_gasto,
            }
        ]

        function delete_gasto(data) {
            function eliminartablachill() {
                tabla_var
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }

		let form = document.querySelector('#formfiltrogastos');
		let formdata = new FormData(form);
		let cabecera = [
			'Periodo','CUO','AMC','cuenta','Unid_Econ','CentroCosto',
			'Moneda','TipoDoc1','Numero','TipoDoc2','NumSerie','NumComp',
			'FecEmision','FecVenci','FecOperacion',	'Glosa1','Glosa2',
			'Debe','Haber','RefenciaCompraVenta','IndOP','Diferenciar','Opciones'
		];
		let columnas = [
			'Periodo','CUO','AMC','cuenta','Unid_Econ','CentroCosto',
			'Moneda','TipoDoc1','Numero','TipoDoc2','NumSerie','NumComp',
			'FecEmision','FecVenci','FecOperacion',	'Glosa1','Glosa2',
			'Debe','Haber','RefenciaCompraVenta','IndOP','Diferenciar'
		];
		function confirmartabla(hola) {
			datagastos = hola;
			console.log('tabla cargada');
		}	
		creartablatwo('gastos',formdata,'#cargafiltrogastos','table table-bordered','tablagastos','#divgastostable','/FiltrarExcelGastos',cabecera,columnas,true,confirmartabla,botonesgastos);
	});
}
 
