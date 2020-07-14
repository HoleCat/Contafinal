<div class="accordion col-12 mx-auto" id="acordeonadmin">
    <div class="card">
        <div class="card-header" id="heading">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEmpresa" aria-expanded="true" aria-controls="collapseEmpresa">
                    EMPRESAS
                </button>
            </h2>
        </div>
        <div id="collapseEmpresa" class="collapse show" aria-labelledby="headingEmpresa" data-parent="#acordeonadmin">
            <div class="card-body" id="admin-empresa">
                @include('herramientas.mantenedores.empresa')
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingSistemacontable">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSistemacontable" aria-expanded="true" aria-controls="collapseSistemacontable">
                    SISTEMA CONTABLE
                </button>
            </h2>
        </div>
        <div id="collapseSistemacontable" class="collapse show" aria-labelledby="headingSistemacontable" data-parent="#acordeonadmin">
            <div class="card-body" id="admin-sistemacontable">
                @include('herramientas.mantenedores.sistemacontable')
            </div>
        </div>
    </div>
</div>
