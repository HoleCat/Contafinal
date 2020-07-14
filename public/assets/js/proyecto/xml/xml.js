eventosxml();

var tableJ;

var jTable = (() => {
    tableJ = $('#tablaxml').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 
            {
                extend: 'csvHtml5',
                action: function ( e, dt, node, config ) {
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, node, config)
                },
                title: 'Registros de Archivos XML',
                titleAttr: 'csv',
                exportOptions: {
                    columns: ':visible'
                },
                
                footer: true
            }, {
                extend: 'excelHtml5',
                action: function ( e, dt, node, config ) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config)
                },
                title: 'Registros de Archivos XML',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: ':hidden'
                },
                footer: true
            }
        ],
        language: {
            "decimal": ",",
            "thousands": ".",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Documentos",
            "infoEmpty": "Mostrando 0 to 0 of 0 Documentos",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Documentos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});

var createTable = ((jData) =>{
    var tr, td, table, div, th, thead, tbody;

    if ($.fn.dataTable.isDataTable('#tablaxml')) {
        console.log("entró");
        $('#tablaxml').DataTable().destroy();
    }

    div = document.querySelector(".grid-result");
    div.innerHTML = ""; 
    const trs = div.querySelectorAll("tbody>tr");
    table = document.createElement("table");
    table.setAttribute('id','tablaxml');
    table.setAttribute('class','w-100 table table-responsive');
    div.append(table);
    if (trs.length == 0) {
        thead = document.createElement("thead");
        table.appendChild(thead);
        tr = document.createElement("tr");
        thead.appendChild(tr);

        th =document.createElement("th");
        th.textContent =""; //auto increment
        tr.appendChild(th);
        
        th =document.createElement("th");
        th.textContent ="RUC";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="DENOMINACIÓN";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="FECHA DE EMISIÓN";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="CÓDIGO";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="SERIE";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="NÚMERO";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="RAZÓN SOCIAL";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="RUC CLIENTE";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="DESCRIPCIÓN";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="MONEDA";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="SUB TOTAL";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="IGV";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="TOTAL";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="DIRECCIÓN DE ENTREGA";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="EMISOR CPE";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="CONDICIÓN";
        tr.appendChild(th);

        th =document.createElement("th");
        th.textContent ="OPCIONES";
        tr.appendChild(th);
        tbody = document.createElement('tbody');
        table.appendChild(tbody);
    }
    
    let suma=0;

    
    const tb = div.querySelector("tbody");
    jData.map((item, index) => {
        tr = document.createElement("tr");

        td = document.createElement("td");
        td.textContent = index + 1;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.ruc_proveedor;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.razon_social_proveedor;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.fecha_emision;
        tr.appendChild(td);
        
        td = document.createElement("td");
        td.textContent = item.codigo_doc;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.serie;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.numero;
        tr.appendChild(td);
    
        td = document.createElement("td");
        td.textContent = item.razon_social_cliente;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.ruc_cliente;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.descripcion;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.moneda;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.valor_venta;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.igv;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.total;
        tr.appendChild(td);
        suma += item.total;

        td = document.createElement("td");
        td.textContent = item.direccion_entrega;
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = "";
        tr.appendChild(td);

        td = document.createElement("td");
        td.textContent = item.condicion;
        tr.appendChild(td);

        td = document.createElement("td");
        let btn = document.createElement('buttom');
        btn.addEventListener("click", function(ee){
            let formdata = new FormData();
            formdata.set('id',item.id);
            function eliminartablachill()
            {
                tableJ
                .row( ee.currentTarget.closest('tr') )
                .remove()
                .draw();
            }
            eliminartablachill();
            ejecutarruta(formdata,'/Factura/Eliminar', eliminartablachill);
        });
        btn.setAttribute('class',"btn btn-danger");
        btn.innerHTML = '<i class="fas fa-trash"></i>';
        td.append(btn);
        tr.appendChild(td);
        tb.appendChild(tr);

        
    });
    jTable();
});

function eventosxml() {
    let uwu = document.querySelector("#formguardardataxml");
    uwu.addEventListener('submit', function(e){
        e.preventDefault();
        obtenerdataxmltable();
    });
        set_ruta('/Delete/trash_uso_activos?iduso=');
        seteventview('/New/new_xml');
        setview('#form-historico','#content','/Old/old_xml');
        let file = document.querySelector("#xml");
        let form = document.querySelector("#formcargaxml");
        let btn = document.querySelector(".btn-send");
        let key = document.querySelector("meta[name='csrf-token']").content;
        let xhr = new XMLHttpRequest();

        let formdata = new FormData();
        let uso_id = document.querySelector('#uso_id').value;
        formdata.set('uso_id',uso_id);
        xhr.open('post', '/Xml/Show');
        xhr.setRequestHeader("x-csrf-token", key);
        xhr.addEventListener("load", transferComplete);
        xhr.send(formdata);

        form.addEventListener('submit', function(e){
            e.preventDefault();
            let formdata = new FormData(form);

            xhr.open('post', '/upload');
            xhr.setRequestHeader("x-csrf-token", key);
            xhr.addEventListener("load", transferComplete);
            xhr.send(formdata);
        });

        function transferComplete(data) {
            const res = data.currentTarget.response;
            console.log(res);
            const jData = JSON.parse(res);

            let arr_ruc = [];
            jData.map((value) => {
                value["condicion"] = "";
                if (arr_ruc.indexOf(value.ruc_proveedor) === -1) {
                    arr_ruc.push(value.ruc_proveedor);
                }
            });
            
            //webservice
            if (arr_ruc.length > 0) {
                const tbl = document.querySelector(".grid-result");
                
                for (let i = 0; i < arr_ruc.length; i++) {
                    const element = arr_ruc[i];
                    let url = `http://sunat.innovafashionperu.com/rucServices.php?nruc=${element}`;
                    let req = new XMLHttpRequest();
                    //req.responseType="json";
                    req.open("GET", url);
                    req.setRequestHeader("Access-Control-Allow-Origin", '*');
                    req.setRequestHeader("Access-Control-Allow-Credentials", 'true');
                    req.onload = function(){
                        if (req.status === 200 && req.readyState === 4) {
                            let jdataTable = $('#tablaxml').DataTable();
                            const jService = JSON.parse(req.responseText);
                           if (jService.success === true) {
                               const trs = tbl.querySelectorAll("tbody>tr");
                               
                               for (let i = 0; i < trs.length; i++) {
                                   const tr = trs[i];
                                   if (tr.children[1].textContent === jService.result.ruc) {    // Sí encuentra coincidencia del ruc
                                    jdataTable.cell(i, 16).data(jService.result.condicion).draw(); // setea el campo condición con el valor del servicio
                                        if (jService.result.comprobante_electronico.length > 0) {
                                            const cpes = jService.result.comprobante_electronico;
                                            for (let j = 0; j < cpes.length; j++) {
                                                const doc = cpes[j];
                                                const cp = doc.substr(0, doc.indexOf(" "));
                                                if (cp.substr(0, 1) === tr.children[5].textContent.substr(0, 1)) { //compara si es factura o boleta para setear emisor CPE
                                                    jdataTable.cell(i, 15).data(doc).draw();
                                                    //tr.children[13].textContent = doc;
                                                    break;
                                                }
                                            }
                                        }
                                   }
                               }
                           } else {
                               console.log(JSON.parse(req.responseText));
                           }
                           //restore table
                           //jTable();
                        }
                    }
                    req.send();
                }
            }

            createTable(jData);
        }
        
}

function obtenerdataxmltable()
{
    var tabla = document.querySelector('#tablaxml');
    var tbody = tabla.querySelector('tbody');
    var filas = tbody.querySelectorAll('tr');

    var documentos = [];

    for (let index = 0; index < filas.length; index++) {
        var fila = filas[index].querySelectorAll('td');
        let obj =
        {
            dato0 : fila[0].textContent,
            dato1 : fila[1].textContent,
            dato2 : fila[2].textContent,
            dato3 : fila[3].textContent,
            dato4 : fila[4].textContent,
            dato5 : fila[5].textContent,
            dato6 : fila[6].textContent,
            dato7 : fila[7].textContent,
            dato8 : fila[8].textContent,
            dato9 : fila[9].textContent,
            dato10 : fila[10].textContent,
            dato11 : fila[11].textContent,
            dato12 : fila[12].textContent,
            dato13 : fila[13].textContent,
            dato14 : fila[14].textContent,
            dato15 : fila[15].textContent,
            dato16 : fila[16].textContent,
        }
        documentos.push(obj);
    }

    let tag = document.querySelector('#formguardardataxml');
    var formdata = new FormData(tag);
    formdata.set('documentos',JSON.stringify(documentos));
    $.ajax({
        url: 'Xml/create',
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
                console.log(data);
            }
        }
    })
}