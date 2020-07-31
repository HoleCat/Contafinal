eventosactivos();

var dataactivos = '';

function eventosactivos(){
	setview('#form-historico','#content','/Old/old_activos');
	$('#opcion-new').click(function(e){
		function confirmacion() {
			console.log('vista cargada');
		}
		getview('#nav-muestreo-content','/New/Activos',confirmacion);
	});
	set_ruta('/Delete/trash_uso_activos?iduso=');
	seteventview('/New/new_activos');
	$('#formeliminardata').submit(function(e){
		e.preventDefault();
		function confirmar(data) {
			crearselect('#usoarchivoselect',data,'archivos')
		}
		let formdata = new FormData(e.target);
		ejecutarruta(formdata,'/Delete/trash_archivo_activos',confirmar);
	});
	$('#usoarchivoselect').change(function(e){
		let idarchivo = e.target.value;
		asignarvalor('#idarchivoactivos',idarchivo);
		console.log(idarchivo);
	});
	$('#activosfile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#activoslabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#formcargaactivos').submit(function(event){
		event.preventDefault();
		function setarchivo(data) {
			var archivo = data.archivo;
			var archivos = data.archivos;
			asignarvalor('#idarchivoactivos',archivo.id);
			crearselectfromdata('#usoarchivoselect',archivos)
		}
		cargararchivo('#formcargaactivos','#cargaactivosfile','/Activos/Importar',setarchivo);
    });
    $('#formfiltroactivos').submit(function(event){
		event.preventDefault();
		let botonesactivos = [
			{
				btn_text: '<i class="fas fa-trash-alt"></i>',
				funcion: cambiarregistrotag,
				ruta: '/Delete/trash_activos',
				id_columnname: 'id',
				tag: true,
				confirm: delete_row_activos,
            }
        ];

        function delete_row_activos(data) {
            function eliminartablachill() {
                tabla_var
                    .row(data.tag.closest('tr'))
                    .remove()
                    .draw();
            }
            eliminartablachill();
            console.log(data);
        }

		let form = document.querySelector('#formfiltroactivos');
		let formdata = new FormData(form);
        let columnas = ['Codigo','CuentaContable','Descipcion','Marca','Modelo','NumeroSeriePlaca','CostoFin','Adquisicion','Mejoras'
        ,'RetirosBajas','Otros','ValorHistorico','AjusteInflacion','ValorAjustado'
        ,'CostoNetoIni','FecAdquisicion','FecInicio','Metodo','NroDoc','PorcDepreciacion','DepreAcumulada','DepreEjercicio','DepreRelacionada','DepreOtros'
        ,'DepreHistorico','DepreAjusInflacion','DepreAcuInflacion','CostoHistorico','DepreAcuTributaria','CostoNetoIniTributaria','DepreEjercicioTributaria'
        ,'FecBaja','RATIO','DEPRESIACION','DEPRESIACION_VALIDADA','ANALISISn1','ANALISISn2',];
        let cabecera = ['Codigo','CuentaContable','Descipcion','Marca','Modelo','NumeroSeriePlaca','CostoFin','Adquisicion','Mejoras',
        'RetirosBajas','Otros','ValorHistorico','AjusteInflacion','ValorAjustado'
        ,'CostoNetoIni','FecAdquisicion','FecInicio','Metodo','NroDoc','PorcDepreciacion','DepreAcumulada','DepreEjercicio','DepreRelacionada','DepreOtros'
        ,'DepreHistorico','DepreAjusInflacion','DepreAcuInflacion','CostoHistorico','DepreAcuTributaria','CostoNetoIniTributaria','DepreEjercicioTributaria'
        ,'FecBaja','RATIO','DEPRESIACION','DEPRESIACION_VALIDADA','ANALISISn1','ANALISISn2','OPCIONES'];
		creartablaone(formdata,'#cargafiltroactivos','table table-bordered','tablaactivos','#divactivostable','/Activos/Filtrar',cabecera,columnas,true,confirmartabla,botonesactivos);
	});
}

function confirmartabla() {
    console.log('tabla filtro activos cargada');
}


