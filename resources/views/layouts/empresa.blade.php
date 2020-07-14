
    <form id="formuserdata2">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">NOMBRE     : {{$userdata->nombre}}<input class="d-none form-control" type="text" name="nombre"></li>
            <li class="list-group-item">APELLIDO   : {{$userdata->apellido}}<input class="d-none form-control" type="text" name="apellido"></li>
            <li class="list-group-item">DNI        : {{$userdata->dni}}<input class="d-none form-control" type="text" name="dni"></li>
            <li class="list-group-item">RUC        : {{$userdata->ruc}}<input class="d-none form-control" type="text" name="ruc"></li>
            <li class="list-group-item">CORREO     : {{$user->email}}<input class="d-none form-control" type="text" name="correo"></li>
            <li class="list-group-item">|<a class="btn btn-info" onclick="mostrarelementos('#formuserdata2')"><i class="fas fa-unlock"></i></a>|<input value="GUARDAR CAMBIOS" class="d-none btn btn-warning" type="submit"></li>
        </ul>
    </form>
    <script type="">
        setview('#formuserdata2','#empresa-userdata','/Userdata/Empresa');
    </script>