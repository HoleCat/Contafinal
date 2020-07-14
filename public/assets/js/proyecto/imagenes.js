
eventoscompras();

function good(params) {
    var table = document.createElement('table');
    table.setAttribute('class','table table-responsive');
    table.setAttribute('id','tabla-imagen');
    var tbody = document.createElement('tbody');
    var thead = document.createElement('thead');
    thead.setAttribute('class','bg-white');
    tbody.setAttribute('class','body-real');

    var tr = document.createElement('tr');
    
    
    var th = document.createElement('th');
    th.innerHTML = "ID";
    tr.append(th);
    th = document.createElement('th');
    th.innerHTML = "IMAGEN";
    tr.append(th);
    th = document.createElement('th');
    th.innerHTML = "NOMBRE";
    tr.append(th);
    th = document.createElement('th');
    th.innerHTML = "OPCIONES";
    tr.append(th);

    thead.append(tr);
    for (let index = 0; index < params.length; index++) {
        const element = params[index];
        
        tr = document.createElement('tr')
        tr.setAttribute('class','bg-white');
        let td = document.createElement('td');
        let img = document.createElement('img');
        img.setAttribute('alt','ruta mala');
        img.setAttribute('src',element.ruta);
        img.setAttribute('style','width:40px');
        td.append(img);
        tr.append(td);

        td = document.createElement('td');
        td.innerHTML = element.id;
        tr.append(td);

        td = document.createElement('td');
        td.innerHTML = element.nombre;
        tr.append(td);

        /*<td class="col">
            <form action="/imagen/delete">
                <input type="hidden" name="id" value="{{ $imagenes->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </form>
        </td>*/
        td = document.createElement('td');
        let form = document.createElement('form');
        form.setAttribute('action','/imagen/delete');
        let input = document.createElement('input');
        input.setAttribute('type','hidden');
        input.setAttribute('value',element.id)
        input.setAttribute('name','id')
        form.append(input);
        input = document.createElement('button');
        input.setAttribute('class','btn btn-danger');
        input.setAttribute('type','submit');
        let i = document.createElement('i');
        i.setAttribute('class','fa fa-trash');
        input.append(i);
        form.append(input);
        td.append(form);
        tr.append(td);

        tbody.append(tr);

    }   

    table.append(thead);
    table.append(tbody)
    let container = document.querySelector('#tabla-imagen-div');
    container.innerHTML = "";
    container.append(table);
}

function eventoscompras(){
    $('#form_imagenes_store').submit(function(e){
        event.preventDefault();
        let tag = document.querySelector('#form_imagenes_store');
        var formdata = new FormData(tag);
        
        ejecutarruta(formdata,'/imagen/store', good);
    });


}

