@include('herramientas.sidebar.tool')
<div class="pt-3 col-xl-10 col-md-10 col-sm-10 col-xs-11 mx-auto">
  <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" id="nav-cajachica-tab" data-toggle="tab" role="tab" aria-controls="nav-cajachica" aria-selected="true">CAJA CHICA</a>
        <a class="nav-item nav-link" id="nav-rendirpago-tab" data-toggle="tab" role="tab" aria-controls="nav-rendirpago" aria-selected="false">RENDICION DE PAGOS</a>
        <a class="nav-item nav-link" id="nav-parametro-tab" data-toggle="tab" role="tab" aria-controls="nav-parametro" aria-selected="false">PARAMETROS</a>
        <a class="nav-item nav-link" id="nav-cajaresumen-tab" data-toggle="tab" role="tab" aria-controls="nav-cajaresumen" aria-selected="false">RESUMEN</a>
      </div>
  </nav>
<input type="hidden" value="{{ $uso->id }}" id="liquidacion_id" name="liquidacion_id">
  <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-cajachica" role="tabpanel" aria-labelledby="nav-cajachica-tab">
          
      </div>
      <div class="tab-pane fade" id="nav-rendirpago" role="tabpanel" aria-labelledby="nav-rendirpago-tab">
          
      </div>
      <div class="tab-pane fade" id="nav-parametro" role="tabpanel" aria-labelledby="nav-parametro-tab">
          
      </div>
      <div class="tab-pane fade" id="nav-cajaresumen" role="tabpanel" aria-labelledby="nav-cajaresumen-tab">
          
      </div>
      <script type="text/javascript" src="{{ asset('assets/js/proyecto/caja/liquidacion.js')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/proyecto/caja/caja.js')}}"></script>
  </div>
</div>