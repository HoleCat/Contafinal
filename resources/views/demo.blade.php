@extends('layouts.app')

@section('content')

<style>
    .img-track
    {
        width: 100px;
        border-radius: 50px;
    }

    .icon-track {
        font-size: 40px;
        color: #fc575e;
        background-color: white;
        border-radius: 50%;
        padding: 8px;
        max-height: 56px;
        max-width: 56px;
        min-height: 56px;
        min-width: 56px;
        z-index: 2;
        text-align: center
    }

    .icon-track-false {
        font-size: 40px;
        color: white;
        background-color: red;
        border-radius: 50%;
        padding: 8px;
        max-height: 56px;
        max-width: 56px;
        min-height: 56px;
        min-width: 56px;
        z-index: 2;
        text-align: center
    }

    .border-track-left {
        border-left: solid black 2px;
        padding-top: 100px;
        padding-bottom: 100px;
    }

    .flex-center {
        align-items: center;
    }
</style>

<div class="container-fluid">
    <div class="row" id="content">
        <div class="col-12">
            <div id="div-track" class="col-xl-6 col-md-6 col-sm-12 col-xs-12 mx-auto">
                <table>
                    <tbody>
                        <tr class="position-relative d-flex">
                            <td><span class="px-1"></span></td>
                            <td class="border-track-left px-3">
                                <!--<img src="{{ asset('assets/img/track/check.png')}}" class="img-track">-->
                                <img src="{{ asset('assets/img/track/getorder.png')}}" class="img-track">
                                <div class="position-absolute d-flex" style="
                                left: -16.5px;
                                bottom: -50px;">
                                    <i class="fab fa-joget icon-track p-2"></i>
                                    <div class="col d-flex flex-center">
                                        <p class="title-track my-0">
                                            PEDIDO RECIBIDO
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="d-flex flex-center">
                                <p class="p-track px-2 my-0">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

    var data_status = 
    [
        {
            title: "PEDIDO RECIBIDO",
            description: "Se ha recepcionado tu pedido, consulta esta pagina para ver el status de tu pedido.",
            img_src: "/assets/img/track/getorder.png",
            icon_class: "fab fa-joget icon-track",
            icon_class_false: "fa fa-times icon-track-false",
            flag: true,
        },
        {
            title: "EMPAQUETANDO",
            description: "Se ha recepcionado tu pedido, consulta esta pagina para ver el status de tu pedido.",
            img_src: "/assets/img/track/getorder.png",
            icon_class: "fab fa-joget icon-track",
            icon_class_false: "fa fa-times icon-track-false",
            flag: false,
        },
        {
            title: "EL DRIVER YA TIENE TU PEDIDO",
            description: "Se ha recepcionado tu pedido, consulta esta pagina para ver el status de tu pedido.",
            img_src: "/assets/img/track/getorder.png",
            icon_class: "fab fa-joget icon-track",
            icon_class_false: "fa fa-times icon-track-false",
            flag: true,
        },
        {
            title: "DRIVER EN CAMINO",
            description: "Se ha recepcionado tu pedido, consulta esta pagina para ver el status de tu pedido.",
            img_src: "/assets/img/track/getorder.png",
            icon_class: "fab fa-joget icon-track",
            icon_class_false: "fa fa-times icon-track-false",
            flag: false,
        },
        {
            title: "ESTAMOS EN TU DOMICILIO",
            description: "Se ha recepcionado tu pedido, consulta esta pagina para ver el status de tu pedido.",
            img_src: "/assets/img/track/getorder.png",
            icon_class : "fab fa-joget icon-track",
            icon_class_false: "fa fa-times icon-track-false",
            flag: true,
        }
    ];
    var div_track = document.querySelector('#div-track');
    div_track.innerHTML = "";
    var table = document.createElement('table');
    var tbody = document.createElement('tbody');
    var tr = document.createElement('tr');
    var td = document.createElement('td');

    //status = JSON.parse(status);
    for(let i = 0; i < data_status.length; i++) {
        const element = data_status[i];
        tr = document.createElement('tr');
        tr.setAttribute('class','position-relative d-flex');
        
        td = document.createElement('td');
        let span = document.createElement('span');
        span.setAttribute('class','px-1');
        td.appendChild(span);
        tr.appendChild(td);

        td = document.createElement('td');
        td.setAttribute('class','border-track-left px-3');
        let img = document.createElement('img');
        img.setAttribute('class', 'img-track');
        img.setAttribute('src',element.img_src);
        td.appendChild(img);
        let wrap = document.createElement('div');
        wrap.setAttribute('class','position-absolute d-flex');
        wrap.setAttribute('style','left: -16.5px;bottom: -50px;');
        let icon = document.createElement('i');
        if(element.flag == true)
        {
            icon.setAttribute('class',element.icon_class)
        }
        else
        {
            icon.setAttribute('class',element.icon_class_false)
        }
        wrap.appendChild(icon);
        let div_title = document.createElement('div');
        div_title.setAttribute('class','col d-flex flex-center'); 
        let title = document.createElement('p');
        title.setAttribute('class','title-track my-0');
        title.innerHTML = element.title;
        div_title.appendChild(title);
        wrap.appendChild(div_title);
        td.appendChild(wrap);
        tr.appendChild(td);

        td = document.createElement('td');
        td.setAttribute('class','d-flex flex-center');
        p_track = document.createElement('p');
        p_track.setAttribute('class','p-track px-2 my-0')
        p_track.innerHTML = element.description;
        td.appendChild(p_track);
        tr.appendChild(td);

        tbody.appendChild(tr);
    };
    table.appendChild(tbody);
    div_track.appendChild(table);
</script>

@endsection