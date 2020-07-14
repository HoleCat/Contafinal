eventoscajachica();

function eventoscajachica(){
    seteventview('/New/new_caja');
    set_ruta_condicional('/Delete/trash_uso_liquidacion?iduso=','/Delete/trash_uso_caja_chica?iduso=');
    setview('#form-historico','#content','/Old/old_caja');
}

var cajachica = {
    total : 0,
}

var datacajachica;

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

var identificadorcajachica = 0;

var botonescajachica = [
	{
		btn_text: '<i class="fas fa-trash-alt"></i>',
        funcion: cambiarregistrotag,
        ruta: '/Delete/trash_caja_chica',
        id_columnname: 'id',
        tag: true,
        confirm: delete_row,
	}
]

var parametroscajachica = [
    {
        header: 'liquidacion_id',
        value: document.querySelector('#liquidaciondetalle_id').value,
        cambio:0.0
    }
];

function confirmaciontablacajachica() {
    console.log('la tabla cargo');
}

function ejecutarvalidacioncajachica() {
    var eso = [];
    var resultado = true;
    var sunat = false;
    var test = function () {
        return new Promise(function (resolve, reject) {
            let ruc = document.querySelector('#ruccajachica').value;
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
        eso.push(validacionunitariabasica('#ruccajachica','#validador-ruc',8,12));
        eso.push(validacionunitariabasica('#codigodocumentocajachica','#validador-nrodocumento',3,5));
        eso.push(validacionunitariabasica('#numerodocumentocajachica','#validador-nrodocumento',3,5));
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
    jsonview('#cajachicatotales','/Caja/Totales',confirmaciontablacajachica,document.querySelector('#liquidaciondetalle_id').value);
}

$(function(){
    creartablavalidada(ejecutarvalidacioncajachica,'table','tablacajachica','#formcajachica','#divtablacajachica','/Caja/Cajachica/Adicion',columnascajachicha,cabeceracajachicha,true,optenertotales,botonescajachica,identificadorcajachica);
    tabla_caja(parametroscajachica,'table','tablacajachica','#divtablacajachica','/Caja/Cajachica/Info',columnascajachicha,cabeceracajachicha,true,optenertotales,botonescajachica,identificadorcajachica);
})