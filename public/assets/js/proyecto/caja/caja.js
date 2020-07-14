eventoscaja();

var datacompras;

function eventoscaja(){
    cajachildviews();
}

function cajachildviews() {
    $('#nav-cajachica-tab').click(function(e){
        let liquidacion_id = document.querySelector('#liquidacion_id').value;
        jsonview('#nav-cajachica','/Caja/Cajachica',confirmacion,liquidacion_id);
    });
    $('#nav-rendirpago-tab').click(function(e){
        getview('#nav-rendirpago','/Caja/Rendirpago',confirmacion);
    });
    $('#nav-parametro-tab').click(function(e){
        getview('#nav-parametro','/Caja/Parametros',confirmacion);
    });
    $('#nav-cajaresumen-tab').click(function(e){
        getview('#nav-cajaresumen','/Caja/Resumen',confirmacion);
    });
}

$(function(){

})

