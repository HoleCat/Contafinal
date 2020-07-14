<!--<ul id="side-bar" class="side-bar-show list-group position-fixed">
    <li id="" class="list-group-item active">Dashboard</li>
    <li id="nav-muestreo" class="list-group-item">Muestreo</li>
    <li id="nav-caja" class="list-group-item">Caja</li>
    <li id="nav-activos" class="list-group-item">Activos</li>
    <li id="nav-balance" class="list-group-item">Balance</li>
</ul>

<button onclick="sidebar('#side-bar')" class="btn position-fixed btn-tools"><i class="fas fa-bars"></i></button>-->
<button data-toggle="modal" data-target="#modaltv" class="btn btn-info position-fixed btn-tv"><i class="fas fa-tv"></i></button>
<div class="modal fade" id="modaltv" tabindex="-1" role="dialog" aria-labelledby="modaltvtitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xxl" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <iframe class="w-100 h-100" src="http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsmulruc/jrmS00Alias"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        </div>
      </div>
    </div>
  </div>


<!--<div class="nav flex-column nav-pills options-bar-show position-fixed" id="options-bar" role="tablist" aria-orientation="vertical">
  @isadmin('muestreo')  
    <a id="opcion-muestras" class="mb-1 nav-link bg-primary" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="false"><i class="fas fa-flask"></i></a>
  @endisadmin
  @isadmin('caja')  
    <a id="opcion-caja" class="mb-1 nav-link bg-danger" data-toggle="pill" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-hand-holding-usd"></i></a>
  @endisadmin
  @isadmin('activos')  
    <a id="opcion-activos" class="mb-1 nav-link bg-warning" data-toggle="pill" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-boxes"></i></a>
  @endisadmin
  @isadmin('balance')  
    <a id="opcion-balance" class="mb-1 nav-link bg-success" data-toggle="pill" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-balance-scale"></i></a>
  @endisadmin
  @isadmin('xml')  
    <a id="opcion-xml" class="mb-1 nav-link bg-info" data-toggle="pill" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-file-code"></i></a>
  @endisadmin
  @isadmin('validador')  
    <a id="opcion-validador" class="mb-1 nav-link bg-danger" data-toggle="pill" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-file-code"></i></a>
  @endisadmin
  @isadmin('reporte')  
    <a id="opcion-reporte" class="mb-1 nav-link bg-success" data-toggle="pill" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-file-code"></i></a>
  @endisadmin
  </div>-->

  <!--<button onclick="optionsbar('#options-bar')" class="btn btn-primary position-fixed btn-options"><i class="fas fa-tools"></i></button>-->