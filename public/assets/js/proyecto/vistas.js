window.onload = function() {
    
    loadmodule();
};

function confirmacion() {
    console.log('vista cargada');
}

function muestreochildviews() {
    $('#nav-compras-tab').click(function(e){
        getview('#nav-muestreo-content','/Muestreo/Compras',confirmacion);
    });
    $('#nav-gastos-tab').click(function(e){
        getview('#nav-muestreo-content','/Muestreo/Gastos',confirmacion);
    });
    $('#nav-ventas-tab').click(function(e){
        getview('#nav-muestreo-content','/Muestreo/Ventas',confirmacion);
    });
}

function loadmodule()   {
    
    $('#nav-xml').click(function(e){
        getview('#content','/Xml',muestreochildviews);
    });
    $('#nav-reporte').click(function(e){
        getview('#content','/Reporte',muestreochildviews);
    });
    $('#nav-validador').click(function(e){
        getview('#content','/Validador',muestreochildviews);
    });
    $('#nav-muestreo').click(function(e){
        getview('#content','/Muestreo',muestreochildviews);
    });
    $('#nav-activos').click(function(e){
		getview('#content','/Activos',confirmacion);
    });
    $('#nav-caja').click(function(e){
		getview('#content','/Modulo/Caja',confirmacion);
    });
    $('#nav-balance').click(function(e){
		getview('#content','/Balance',confirmacion);
    });
    /*
    $('#opcion-new').click(function(e){
        getview('#content','/Caja/Nuevo', confirmacion);
    });
    */
}

function setview(detonador,contenedor,ruta) {
    $(detonador).submit(function(e){
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        var elems= document.querySelectorAll('input[type=checkbox]');
        for (var i=0;i<elems.length;i++)
        {
            var isChecked =elems[i].checked;
            var type = elems[i].getAttribute('name');
            if(isChecked == false){
                formData.set(type, 1);
            } else {
                formData.set(type, 0);
            }
        }
        $.ajax({
            url: ruta,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                $(contenedor).html('');
                $(contenedor).html(data);
            }
        }).done(function(){
            
        });
    });
}

function setviewcall(detonador,contenedor,ruta,funcion) {
    var resultado;
    $(detonador).submit(function(e){
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        var elems= document.querySelectorAll('input[type=checkbox]');
        for (var i=0;i<elems.length;i++)
        {
            var isChecked =elems[i].checked;
            var type = elems[i].getAttribute('name');
            if(isChecked == false){
                formData.set(type, 1);
            } else {
                formData.set(type, 0);
            }
        }
        $.ajax({
            url: ruta,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                $(contenedor).html('');
                $(contenedor).html(data);
                resultado = data;
            }
        }).done(function(){
            funcion(resultado);
        });
    });
}

function jsonview(contenedor,ruta,funcion,id) {
    var formData = new FormData();
    formData.set('id',id);
    var resultado;
    $.ajax({
        url: ruta,
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function(data){
            $(contenedor).html('');
            $(contenedor).html(data);
            resultado = data;
        }
    }).done(function(){
        funcion(resultado);
    });
}

function jsonviewsimple(contenedor,ruta,id) {
    var formData = new FormData();
    formData.set('id',id);
    var resultado;
    $.ajax({
        url: ruta,
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function(data){
            $(contenedor).html('');
            $(contenedor).html(data);
            resultado = data;
        }
    }).done(function(){
        alert('registro eliminado')
    });
}

function getview(contenedor,ruta,funcion) {
    var resultado;
    $.ajax({
        url: ruta,
        type: 'GET',
        processData: false,
        contentType: 'html',
        success: function(data){
            resultado = data;
            $(contenedor).html('');
            $(contenedor).html(data);
        }
    }).done(function(){
        funcion(resultado);
    });
}