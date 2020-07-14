eventosuserdata();

var datauserdata = '';

function eventosuserdata(){
}

function confirmartablauserdata(hola) {
	datauserdata = hola;
	console.log('tabla cargada');
}

var identificadoruserdata = 0;

var botonesuserdata = [
	{
		texto: '<i class="fas fa-trash-alt"></i>',
		accion: 'borrardetalleliquidacion',
		ruta: '/Destroy/Tuvieja',
		id: 0
	}
]

$(function(){
	creartabla('table','tablauserdata','#formuserdata','#divuserdatatable','/ImportExcelCompra',cabecerauserdata,true,confirmartablauserdata,botonesuserdata,identificadoruserdata); 
})

var cabecerauserdata = [
	'NroDoc',
	'cliente',
	'IdUso',
	'IdArchivo',
	'Periodo',
	'Correlativo',
	'FecEmision',
	'FecVenci',
	'TipoComp',
	'NumSerie',
	'AnoDua',
	'NumComp',
	'NumTicket',
	'TipoDoc',
	'BIAG1',
	'IGVIPM1',
	'BIAG2',
	'IGVIPM2',
	'BIAG3',
	'AdqGrava',
	'IGVIPM3',
	'AdqGrava',
	'ISC',
	'Otros',
	'Total',
	'Moneda',
	'TipoCam',
	'FecOrigenMod',
	'TipoCompMod',
	'NumSerieMod',
	'AnoDuaMod',
	'NumSerComOriMod',
	'FecConstDetrac',
	'NumConstDetrac',
	'Retencion',
	'ClasifBi',
	'Contrato',
	'ErrorT1',
	'ErrorT2',
	'ErrorT3',
	'ErrorT4',
	'MedioPago',
	'Estado'
];