eventosrendirpago();

function eventosrendirpago(){
    seteventview('/New/new_caja');
    set_ruta_condicional('/Delete/trash_uso_liquidacion?iduso=','/Delete/trash_uso_rendir_pago?iduso=');
    setview('#form-historico','#content','/Old/old_caja');
}

var rendirpago = {
    total : 0,
}

var datarendirpago;

var cabeceracajachicha = [
    'ruc'
    ,'tipodocumento'
    ,'codigodocumento'
    ,'documento'
    ,'fecha'
    ,'moneda'
    ,'compra'
    ,'venta'
    ,'concepto'
    ,'contabilidad'
    ,'centrocosto'
    ,'base'
    ,'igv'
    ,'monto'
    ,'opciones'
];

var columnascajachicha = [
    'ruc'
    ,'ctipodocumento'
    ,'codigodocumento'
    ,'documento'
    ,'fecha'
    ,'cmoneda'
    ,'compra'
    ,'venta'
    ,'concepto'
    ,'ccontabilidad'
    ,'ccentrocosto'
    ,'base'
    ,'igv'
    ,'monto'
];

var identificadorrendirpago = 0;

var botonesrendirpago = [
	{
		btn_text: '<i class="fas fa-trash-alt"></i>',
        funcion: cambiarregistrotag,
        ruta: '/Delete/trash_rendir_pago',
        id_columnname: 'id',
        tag: true,
        confirm: delete_rendir_pago,
	}
]

function delete_rendir_pago(data)
{
	let formdata = new FormData();
	function eliminartablachill()
	{
		tabla_var
		.row( data.tag.closest('tr') )
		.remove()
		.draw();
	}
	eliminartablachill();
    optenertotales();
    console.log(data);
}

var parametrosrendirpago = [
    {
        header: 'liquidacion_id',
        value: document.querySelector('#liquidaciondetalle_id').value,
        cambio:0.0
    }
];

function confirmaciontablarendirpago() {
    console.log('la tabla cargo');
}

function ejecutarvalidacionrendirpago() {
    var eso = [];
    var resultado = true;
    var sunat = false;
    var test = function () {
        return new Promise(function (resolve, reject) {
            let ruc = document.querySelector('#rucrendirpago').value;
            var formData = new FormData();
            formData.append("nruc",ruc);
         
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://sunat.innovafashionperu.com/rucServices.php");
            xhr.send(formData);
            xhr.onreadystatechange=function () {
                if (xhr.readyState !== 4) return;
                if (xhr.status >= 200 && xhr.readyState == 4) {
                    console.log(xhr.responseText);
                    resolve(xhr);
                }else{
                    reject({
                        status: xhr.status,
                        statusText: xhr.statusText
                    });
                }
            }
        });
    };
    test().then(function(data) {
        if(data.success == true){
            sunat = true;
            
        } else {
            sunat = false;
        }
        console.log('termino');
        eso.push(sunat);
        eso.push(validacionunitariabasica('#rucrendirpago','#validador-ruc',8,12));
        eso.push(validacionunitariabasica('#codigodocumentorendirpago','#validador-nrodocumento',3,5));
        eso.push(validacionunitariabasica('#numerodocumentorendirpago','#validador-nrodocumento',3,5));
        console.log(eso);
        for (let index = 0; index < eso.length; index++) {
            const element = eso[index];
            if(element != true){
                resultado = false;
            }
        }
    });
    return resultado;
}

function optenertotales() {
    jsonview('#rendirpagototales','/Caja/Totales',confirmaciontablarendirpago,document.querySelector('#liquidaciondetalle_id').value);
}

$(function(){
    creartablavalidada(ejecutarvalidacionrendirpago,'table','tablarendirpago','#formrendirpago','#divtablarendirpago','/Caja/Rendirpago/Adicion',columnascajachicha,cabeceracajachicha,true,optenertotales,botonesrendirpago,identificadorrendirpago);
    tabla_caja(parametrosrendirpago,'table','tablarendirpago','#divtablarendirpago','/Caja/Rendirpago/Info',columnascajachicha,cabeceracajachicha,true,optenertotales,botonesrendirpago,identificadorrendirpago);
})  