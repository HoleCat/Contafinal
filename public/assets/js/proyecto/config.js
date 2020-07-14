$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function crearselectconruta(dataname,ruta,form,name,id,contenedor,valuefield,textfields,separetor)
{
    let tag = document.querySelector(form);
    var formdata = new FormData(tag);
    $.ajax({
        url: ruta,
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            if(data.error)
			{
				show_alert_now(data.error);
            }
            else
            {
                resultado = data[dataname];
                $(contenedor).html('');
                var select = document.createElement('select');
                select.setAttribute('name',name);
                select.setAttribute('id',id);
                select.setAttribute('class','custom-select');
                for (let index = 0; index < resultado.length; index++) {
                    var columna = resultado[index];
                    
                        var value = columna[valuefield];
                        var texto = "";
                        for (let index2 = 0; index2 < textfields.length; index2++) {
                            if(index2 == 0)
                            {
                                texto += columna[textfields[index2]];
                            }
                            else
                            {
                                texto += separetor + columna[textfields[index2]];
                            }
                        }
                        var option = document.createElement('option');
                        option.setAttribute('value',value);
                        option.innerHTML = texto;
						select.append(option);
					
                }
                $(contenedor).append(select);
            }
        }
    })
}

function validacionbasica(id,flag,msg,limit) {
    let target = document.querySelector(id);
    
    for (let i = 0; i < inputs.length; i++) {
        const type = inputs[i].getAttribute('type');
        if(type != 'hidden')
        {
            const input = inputs[i];
            const msg = input.nextElementSibling;
            if(input.value == '')
            {
                if(msg.classList.contains('fade'))
                {
                    msg.classList.remove('fade');
                }
                if(!input.classList.contains('border-danger'))
                {
                    input.classList.add('border-danger');
                }
            } else {
                if(!msg.classList.contains('fade'))
                {
                    input.classList.add('fade');
                }
                if(input.classList.contains('border-danger'))
                {
                    msg.classList.remove('border-danger');
                }
            }
        }
    }

}

function validacionunitariabasica(field,small,min,max) {
    var input = document.querySelector(field);
    var msg = document.querySelector(small);
    var val = input.value;
    var vals = val.toString();

    var count = vals.length;

    var validador = {
        contenido : true,
        cantidad : true
    }
    var text = '';
    if(val == '')
    {   
        validador.contenido = false;
        text = '* campo obligatorio '
    }
    if(count < min)
    {
        validador.cantidad = false;
        text += '* el minimo de caracteres es '+ min;
    }
    if(count > max)
    {
        validador.cantidad = false;
        text += '* el maximo de caracteres es '+ max;
    }

    msg.innerHTML = text;
    var resultado = false;
    
    if(validador.contenido == true && validador.cantidad == true)
    {
        if(!msg.classList.contains('fade'))
        {
            msg.classList.add('fade');
            msg.classList.remove('text-danger');
        }
        if(input.classList.contains('border-danger'))
        {
            input.classList.remove('border-danger');
            msg.classList.remove('text-danger');
        }
        resultado = true;
    }
    else 
    {
        if(msg.classList.contains('fade'))
        {
            msg.classList.remove('fade');
            msg.classList.add('text-danger');
        }
        if(!input.classList.contains('border-danger'))
        {
            input.classList.add('border-danger');
        }
        resultado = false;
    }

    return resultado;
}

function validarsunat(input,msg,valor) {
    let ruc = document.querySelector(input).value;
    let dato = document.querySelector(input);
    let respuesta = document.querySelector(msg);
    let formData = new FormData();
    var resultado = false;
    formData.set('nruc', ruc);
    $.ajax({
		url: 'http://sunat.innovafashionperu.com/rucServices.php',
		type: 'POST',
		data: formData,
		processData: false,
        contentType: false,
        success: function(data){
            console.log(data);
            data = JSON.parse(data);
            if(data.success == true){
                resultado = true;
                respuesta.innerHTML = 'condicion :' + data.result.condicion;
                if(respuesta.classList.contains('text-danger')){
                    respuesta.classList.remove('text-danger');
                    dato.classList.remove('border-danger');
                    respuesta.classList.add('text-primary');
                    dato.classList.add('border-primary');
                } else {
                    respuesta.classList.add('text-primary');
                    dato.classList.add('border-primary');
                    respuesta.classList.remove('text-danger');
                    dato.classList.remove('border-danger');
                }
                if(respuesta.classList.contains('fade'))
                {
                    respuesta.classList.remove('fade');
                }
            } else {
                respuesta.innerHTML = data.message;
                if(!respuesta.classList.contains('text-danger')){
                    respuesta.classList.add('text-danger');
                    dato.classList.add('border-danger');
                    respuesta.classList.remove('text-primary');
                    dato.classList.remove('border-primary');
                } else {
                    respuesta.classList.add('text-danger');
                    dato.classList.add('border-danger');
                    respuesta.classList.remove('text-primary');
                    dato.classList.remove('border-primary');
                }
                if(respuesta.classList.contains('fade'))
                {
                    respuesta.classList.remove('fade');
                }
            }        
        }
    }).done(function(){
        if(valor){
            valor = resultado;
        }
		return resultado;
    });
}

function validartipodecambio(input,contenedor) {
    var msg = "";
    var moneda = document.querySelector('#select_cambio').value;
    var fecha = document.querySelector(input).value;
    var campos = fecha.split('.');
    var mes = '';
    var anio = '';
    
        if(campos.length > 2){
            mes = campos[1];
            anio = campos[0];
            if(anio.length < 3)
            {
                anio = campos[2];
                dia = campos[0];
            }
            else{
                dia = campos[2]
            }
        } else {
            campos = fecha.split('/');
    
            if(campos.length > 2){
                mes = campos[1];
                anio = campos[0];
                if(anio.length < 3)
                {
                    anio = campos[2];
                    dia = campos[0];
                }
                else{
                    dia = campos[2]
                }
            } else {
                campos = fecha.split('-');
                mes = campos[1];
                anio = campos[0];
                if(anio.length < 3)
                {
                    anio = campos[2];
                    anio = campos[0];
                }
                else{
                    dia = campos[2]
                }
            }
        }
    
        let formData = new FormData();
        formData.set('mes', mes);
        formData.set('anio', anio);
    if(mes == undefined || anio == undefined || mes == "" ||  anio == "" || moneda != 2)
    {
        msg = 'ingrese una fecha y/o elija dolar, si elije otra opcion favor de ingresar valores manualmente';
        display_none_off('#cambio_div');
        let c = document.querySelector('#compra_var');
        let v = document.querySelector('#venta_var');
        c.value = 0.0;
        v.value = 0.0;
        show_alert_now(msg);
    }
    else
    {
        $.ajax({
            url: 'http://sunat.innovafashionperu.com/tcServices.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data);
                data = JSON.parse(data);
                console.log(data);
                if(data.success === true)
                {
                    
                    var registros = data.result;
                    var flag_error = false;
                    var flag_equal = false;

                    var flag_def = false;

                    var limit_NX_C_dia = "";
                    var limit_NX_V_dia = "";
                    var limit_PX_C_dia = "";
                    var limit_PX_V_dia = "";

                    for (let rr = 0; rr < registros.length; rr++) {
                        const ff = registros[rr];
                        var fecha = ff.fecha;
                        var ar_ff = fecha.split(' - ');
                        var mess_ = ar_ff[1];
                        var diaa_ = ar_ff[0];
                        diaa_ = parseInt(diaa_);    
                        if(diaa_ == dia)
                        {
                            let c = document.querySelector('#compra_var');
                            let v = document.querySelector('#venta_var');
                            msg = "Se encontraron resultados para esta fecha."
                            show_alert_now(msg);
                            display_none_off('#cambio_div');
                            c.value = ff.compra;
                            v.value = ff.venta;
                            flag_equal = true;

                            break;
                        }
                    }


                    if(flag_equal == false)
                    {
                        for (let rr2 = 0; rr2 < registros.length; rr2++) {
                            const ff2 = registros[rr2];
                            var fecha2 = ff2.fecha;
                            var ar_ff2 = fecha2.split(' - ');
                            var mess_2 = ar_ff2[1];
                            var diaa_2 = ar_ff2[0];
                            diaa_2 = parseInt(diaa_2);
                            if(rr2 == 0)
                            {
                                if(diaa_2 > dia)
                                {
                                    msg = "no hubo cambios en este mes hasta la fecha consultada, sugerimos consultar el ultimo valor del mes pasado, el valor entregado es el primero de este mes";
                                    limit_NX_C_dia = ff2.compra;
                                    limit_NX_V_dia = ff2.venta;
                                    limit_PX_C_dia = ff2.compra;
                                    limit_PX_V_dia = ff2.venta;
                                    display_none_off('#cambio_div');
                                    let c = document.querySelector('#compra_var');
                                    let v = document.querySelector('#venta_var');
                                    c.value = limit_NX_C_dia;
                                    v.value = limit_NX_V_dia;
                                    show_alert_now(msg);
                                    break;
                                }
                            }
                            
                                if(diaa_2 < dia)
                                {
                                    msg = "no hubo cambios en este mes hasta la fecha consultada, sugerimos consultar el ultimo valor del mes pasado, el valor entregado es el anterior al consultado";
                                    limit_NX_C_dia = ff2.compra;
                                    limit_NX_V_dia = ff2.venta;
                                    let c = document.querySelector('#compra_var');
                                    let v = document.querySelector('#venta_var');
                                    display_none_off('#cambio_div');
                                    c.value = limit_NX_C_dia;
                                    v.value = limit_NX_V_dia;
                                }
                                else if (diaa_2 > dia)
                                {
                                    limit_PX_C_dia = ff2.compra;
                                    limit_PX_V_dia = ff2.venta;
                                    show_alert_now(msg);
                                    break;
                                }
                            
                            
                        }
                    }else
                    {

                    }
                }
                else
                {
                    let c = document.querySelector('#compra_var');
                    let v = document.querySelector('#venta_var');
                    c.value = 0.0;
                    v.value = 0.0;
                    msg = 'Lo mas probable es que no enviara una fecha o eligiera algo diferente a dolar, intente otra vez despues de re-cargar la pagina. Si su moneda es diferente a Dolar o Nuevo Sol moneda debera ingresar los valores de aquel momento manualmente. Elegir Nuevo sol equivale a 0.0';
                    show_alert_now(msg);
                    display_none_off('#cambio_div');
                }
            }
        }).done(function(){
            
        });
    }
}

function set_ruta(ruta_var)
{

    let uso_id_general = document.querySelector('#uso_id_general').value;
	let rute  = document.querySelector('#opcion-delete').getAttribute('href');
	document.querySelector('#opcion-delete').setAttribute('href',rute+ruta_var+uso_id_general);

}
function seteventview2(ruta)
{
    let tag = document.querySelector('#opcion-new');
    tag.setAttribute('onclick',"getview('#nav-muestreo-content',"+"'"+ruta+"'"+", confirmacion)");
}
function seteventview(ruta)
{
    let tag = document.querySelector('#opcion-new');
    tag.setAttribute('onclick',"getview('#content',"+"'"+ruta+"'"+", confirmacion)");
}
function set_ruta_condicional(ruta_var_uso,ruta_var)
{

    let uso_id_general = document.querySelector('#uso_id_general').value;
	let rute  = document.querySelector('#opcion-delete').getAttribute('href');
    document.querySelector('#opcion-delete').setAttribute('href',rute+ruta_var+uso_id_general);

	let rute2  = document.querySelector('#opcion-delete-uso').getAttribute('href');
	document.querySelector('#opcion-delete-uso').setAttribute('href',rute2+ruta_var_uso+uso_id_general);

}

function validarcomprobantes(input,valor) {
    let ruc = document.querySelector(input).value;
    //let dato = document.querySelector(input);
    //let respuesta = document.querySelector(msg);
    let formData = new FormData();
    var resultado = false;
    formData.set('nruc', ruc);
    $.ajax({
		url: 'http://sunat.innovafashionperu.com/cpeServices.php',
		type: 'POST',
		data: formData,
		processData: false,
        contentType: false,
        success: function(data){
            console.log(data);
            data = JSON.parse(data);
            if(data.success == true){
                resultado = true;
                let respuesta = 'condicion :' + 'encontrado';
                $('#modal-comprobantes').modal('show');
                $('#modal-comprobantes-titulo').html(respuesta);
                var html = '<ul class="list-group">';
                var tipos = data.result;
                
                if(tipos.length>0){
                    tipos.forEach(tipo => {
                        const fecha = tipo.fecha;
                        html += '<li class="list-group-item">';
                        html += fecha;
                        html += '</li>';
                        const comprobantes = tipo.comprobantes;
                        for (let index = 0; index < comprobantes.length; index++) {
                            const element = comprobantes[index];
                            html += '<li class="list-group-item">';
                            html += element;
                            html += '</li>';
                        }
                    });
                } else {
                    html += '<li class="list-group-item">';
                    html += 'SIN REGISTOS QUE MOSTRAR';
                    html += '</li>';
                }
                    
                
                html += '</ul>';
                $('#modal-comprobantes .modal-body').html(html);
            } else {
                resultado = false;
                let respuesta = 'condicion :' + 'sin data';
                $('#modal-comprobantes').modal('show');
                $('#modal-comprobantes-titulo').html(respuesta);
            }        
        }
    }).done(function(){
        if(valor){
            valor = resultado;
        }
		return resultado;
    });
}

function confirmacionpopup(titulo,contenido,botones) {
    $.confirm({
        title: titulo,
        content: contenido,
        buttons: botones
    });
}

function confirmacionok() {
    $.confirm({
        title: 'AVISO :',
        content: 'revise los campos enviados, que las validaciones con sunat den positivo, los  campos con * son obligatorios.',
        buttons: {
            ok: {
                text: 'ok',
                btnClass: 'btn-primary',
                keys: ['enter', 'shift'],
                action: function(){
                    $.alert('ok');
                }
            }
        }
    });
}

function suplicar(veces) {
    for (let index = 0; index < veces; index++) {
        console.log('honto ni gomenasai sadko-chan');
        console.log('watashi baka desu');
    }
}

function dere(nombre,estilo,golpes){
	if(estilo=="loli")
	{ console.log(nombre + ' onichan no baka');}
	else if(estilo=="punk")
    { console.log(nombre + ' aniki no bakaaa');
        for (let index = 0; index < golpes; index++) {
            if(index == 0){
                console.log('ata');            
            } else {
                console.log('ta');            
            }
        }
    }
}

function mostrarelementos(id){
    var tag = document.querySelector(id);
    var elementos = tag.querySelectorAll('.d-none');
    for (let index = 0; index < elementos.length; index++) {
        const element = elementos[index];
        element.classList.remove('d-none');
    }
}

function display_none_off(id){
    var tag = document.querySelector(id);
    var elementos = tag.querySelectorAll('.d-none');
    tag.classList.remove('d-none');
    for (let index = 0; index < elementos.length; index++) {
        const element = elementos[index];
        element.classList.remove('d-none');
    }
}

function display_none_on(id){
    var tag = document.querySelector(id);
    var elementos = tag.querySelectorAll('.d-none');
    tag.classList.add('d-none');
    for (let index = 0; index < elementos.length; index++) {
        const element = elementos[index];
        element.classList.add('d-none');
    }
}

function mostrarcarga(id,siono) {
	var carga = document.querySelector(id);
	if(siono == true)
	{
        let divspinner = document.createElement('div');
        divspinner.setAttribute('class','spinner-border text-warning');
        divspinner.setAttribute('role','status');
        let spinner = document.createElement('span');
        spinner.setAttribute('class','sr-only');
        divspinner.append(spinner)
        carga.innerHTML = '';
        carga.append(divspinner);
    }
    else
    {
        let check = document.createElement('span');
        check.setAttribute('class','fas fa-check-circle text-success fa-2x py-1');
		carga.innerHTML = '';
        carga.append(check);
	}
}

function asignarvalor(id,valor) {
    var tag = document.querySelector(id);
    tag.value = valor;
}

function cargararchivo(form,spinner,ruta,funcion) {
	var formulario = document.querySelector(form);
    var formData = new FormData(formulario);
    var resultado;
    var status;
	mostrarcarga(spinner,true);
	$.ajax({
		url: ruta,
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(data){
            status = data;
            if(data.error)
            {
                show_alert_now(data.error);
            }
            else
            {
                resultado = data;
            }
		}
	}).done(function(){
        if(status.error)
        {
            
        }
        else
        {
            funcion(resultado);
        }
        
        mostrarcarga(spinner,false);
        
    });
    return resultado;
}

function ejecutarruta(formdata,ruta,funcion) {
    event.preventDefault();
    var resultado;
	$.ajax({
		url: ruta,
		type: 'POST',
		data: formdata,
		processData: false,
		contentType: false,
		success: function(data){
			resultado = data;
		}
	}).done(function(){
        funcion(resultado);
	});
}

function ejecutarrutaexportar(form,ruta,funcion) {
    let f = document.querySelector(form);
    formdata = new FormData(f)
    event.preventDefault();
    var resultado;
	$.ajax({
		url: ruta,
		type: 'POST',
		data: formdata,
		processData: false,
		contentType: false,
		success: function(data){
			resultado = data;
		}
	}).done(function(){
        funcion(resultado);
	});
}

function cambiarregistro(ruta,id,funcion) {
    let formdata = new FormData();
    formdata.append('id',id);
    event.preventDefault();
    var resultado;
	$.ajax({
		url: ruta,
		type: 'POST',
		data: formdata,
		processData: false,
		contentType: false,
		success: function(data){
			resultado = data;
		}
	}).done(function(){
        funcion(resultado);
	});
}

function cambiarregistrotag(tabla,tag,ruta,id,funcion) {
    let formdata = new FormData();
    formdata.append('id',id);
    event.preventDefault();
    var resultado;
	$.ajax({
		url: ruta,
		type: 'POST',
		data: formdata,
		processData: false,
		contentType: false,
		success: function(data){
            resultado = 
            {
                "tag" : tag,
                "data" :  data
            };
		}
	}).done(function(){
        funcion(resultado);
	});
}

function cambiarclase(tag,target,clase)
{
    if(tag.classList.contains(target))
    {
        tag.classList.remove(target);
        tag.classList.add(clase);
    }
}