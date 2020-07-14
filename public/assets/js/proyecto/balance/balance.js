eventosbalance();

var databalance = '';

function eventosbalance(){
	$('#balancefile').change(function(e){
		let filename = this.files[0].name;
		let filelabel = document.querySelector('#balancelabel');
		filelabel.innerHTML = filename;
		console.log(filename);
	});
	$('#formcargabalance').submit(function(event){
		event.preventDefault();
		function setarchivo(data) {
			console.log(data);
		}
		cargararchivo('#formcargabalance','#cargabalancefile','/Balance/Importar',setarchivo);
    });
}

function confirmartablabalance(hola) {
	databalance = hola;
	console.log('tabla cargada balance');
}

var botonesbalance = [
	{
		texto: '<i class="fas fa-trash-alt"></i>',
		accion: 'borrardetalleliquidacion',
		ruta: '/Destroy/Tuvieja',
		id: 0
	}
]

function exportarmayorbalance() {
	console.log(JSON.stringify(databalance));
	console.log(databalance);
	var formdata = new FormData();
	formdata.set('data',JSON.stringify(databalance));
	$.ajax({
		url: '/Balance/Exportar',
		type: 'POST',
		data: formdata,
		processData: false,
		contentType: false,
		success: function(data){
			console.log(data)
			/*let link = document.createElement('a');
			link.setAttribute('href',data);
			link.click();*/
		}
	}).done(function(){
		
	});
}
 
var cabecerabalance = [
    'ORD1',
    'ORD2',
    'ORD3',
    'CUENTA',
    'ORD5',
    'ORD6',
    'ORD7',
    'ORD8',
    'ORD9',
    'ORD10',
    'ORD11',
    'ORD12',
    'ORD13',
    'ORD14',
    'ORD15',
    'ORD16',
    'ORD17',
    'DEBE',
    'HABER',
    'ORD20',
    'ORD21'
];


