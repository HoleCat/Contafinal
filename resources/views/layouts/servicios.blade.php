
<div class=" col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex flex-wrap">
    
    <div class="px-0 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12 d-flex" style="align-items: center">
        
        <ul class="list-group">
            <li class="list-group-item aqua-gradient my-1 font-heavy-subtitulo" data-toggle="modal" data-target="#reporteModalCenter">REPORTE</li>
            <li class="list-group-item aqua-gradient my-1 font-heavy-subtitulo" data-toggle="modal" data-target="#validadorModalCenter">VALIDADOR</li>
            <li class="list-group-item aqua-gradient my-1 font-heavy-subtitulo" data-toggle="modal" data-target="#balanceModalCenter">BALANCE</li>
            <li class="list-group-item aqua-gradient my-1 font-heavy-subtitulo" data-toggle="modal" data-target="#cajaModalCenter">CAJA Y RENDIR PAGOS</li>
            <li class="list-group-item aqua-gradient my-1 font-heavy-subtitulo" data-toggle="modal" data-target="#activosModalCenter">ACTIVOS</li>
            <li class="list-group-item aqua-gradient my-1 font-heavy-subtitulo" data-toggle="modal" data-target="#muestrasModalCenter">MUESTREO</li>
            <li class="list-group-item aqua-gradient my-1 font-heavy-subtitulo" data-toggle="modal" data-target="#xmlModalCenter">IMPORTACION DE DOCUMENTOS XML</li>
        </ul>
    </div>
    <!--<div class="vh-100 px-0 col-xl-7 col-md-7 col-sm-7 col-xs-2 col-2 d-flex position-absolute" style="z-index:-2;top:0px;bottom:0px;">
        <div class="purple-gradient col-xl-4 col-md-4 col-sm-5 col-xs-1 col-1" style="min-height: 80%;max-height:80%"></div>
        <div class="purple-gradient col-xl-1 col-md-3 col-sm-2 col-xs-4 col-3" style="min-height: 30%;max-height:80%"></div>
        <div class="purple-gradient col-xl-7 col-md-5 col-sm-5 col-xs-7 col-6" style="min-height: 80%;max-height:100%"></div>
        <div class="bg-general px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="bottom:20%;min-height: 20%;max-height:20%" >
        </div>
        <div class="bg-general px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="top:10%;min-height: 10%;max-height:10%" >
        </div>
    </div>-->
    <img class="coso px-0 col-xl-4 col-md-4 col-sm-5 col-xs-5 col-12" src="{{$foto2}}" alt="">
</div>

<div class="modal fade" id="reporteModalCenter" tabindex="-1" role="dialog" aria-labelledby="reporteModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-style" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reporteModalLongTitle">Descripcion :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$reporte}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="validadorModalCenter" tabindex="-1" role="dialog" aria-labelledby="validadorModalCenterTitle" aria-hidden="true">
    <div class="modal-style modal-dialog modal-dialog-centered modal-style" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validadorModalLongTitle">Descripcion :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$validacion}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="balanceModalCenter" tabindex="-1" role="dialog" aria-labelledby="balanceModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-style" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balanceModalLongTitle">Descripcion :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$balance}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="cajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-style" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cajaModalLongTitle">Descripcion :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$caja}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="activosModalCenter" tabindex="-1" role="dialog" aria-labelledby="activosModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-style" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activosModalLongTitle">Descripcion :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$activos}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="muestrasModalCenter" tabindex="-1" role="dialog" aria-labelledby="muestrasModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-style" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="muestrasModalLongTitle">Descripcion :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$muestras}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="xmlModalCenter" tabindex="-1" role="dialog" aria-labelledby="xmlModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-style" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="xmlModalLongTitle">Descripcion :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$xml}}
            </div>
        </div>
    </div>
</div>