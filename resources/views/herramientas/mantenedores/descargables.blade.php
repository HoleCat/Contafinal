<ul class="list-group">
    @foreach ($resultados as $resultados)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Descargable 
            <a href="{{ $resultados->ruta }}" target="_blank"  class="badge badge-primary badge-pill"><i class="fas fa-download"></i></a>
        </li>
    @endforeach
  </ul>