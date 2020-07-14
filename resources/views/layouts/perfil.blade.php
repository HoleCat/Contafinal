
    <div class="card col-12 px-0">
        <img onclick="habilitarsubirfotoperfil('#userimguserdata')" class="card-img-top card-img-cool-circle"
         src="
        @if ($userdata->foto)
        {{ $userdata->foto }}
        @else
        {{ asset('assets/img/noimage.png') }}
        @endif
        "
         
        alt="Card image cap">
        <form  id="formuserdata1" enctype="multipart/form-data">
            <ul class="list-group list-group-flush">
                <li id="userimguserdata" class="d-none list-group-item">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="userdatafile" lang="es" name="foto">
                        <label id="userdatafilelabel" class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                    </div>  
                </li>
                <li class="list-group-item">USUARIO    : {{ $user->name }}<input class="d-none form-control" type="text" name="usuario" value=""></li>
                <li class="list-group-item">EMPRESA    : @if ($empresa) {{ $empresa->nombre }} @else SIN EMPRESA @endif
                    <select class="custom-select d-none" name="empresa">
                        <option value="">-- ELIGIR SI QUIERE EDITAR --</option>
                        @foreach ($empresas as $empresas)
                        <option value="{{ $empresas->id }}">{{ $empresas->nombre }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="list-group-item">APROBADOR  : @if ($aprobador) {{ $aprobador->nombre }}  {{ $aprobador->apellido }}@else SIN APROBADOR @endif
                    <select class="custom-select d-none" name="aprobador">
                        <option value="">-- ELIGIR SI QUIERE EDITAR --</option>
                        @foreach ($aprobadores as $aprobadores)
                        <option value="{{ $aprobadores->id }}">{{ $aprobadores->nombre }} {{ $aprobadores->apellido }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="list-group-item">|<a class="btn btn-info" onclick="mostrarelementos('#formuserdata1')"><i class="fas fa-unlock"></i></a>|<input value="GUARDAR CAMBIOS" class="d-none btn btn-warning" type="submit"></li>
            </ul>
        </form>
        <script>
            setview('#formuserdata1','#perfil-userdata','/Userdata/Perfil');
            $('#userdatafile').change(function(e){
                let filename = this.files[0].name;
                let filelabel = document.querySelector('#userdatafilelabel');
                filelabel.innerHTML = filename;
                console.log(filename);
            });
        </script>
    </div>
