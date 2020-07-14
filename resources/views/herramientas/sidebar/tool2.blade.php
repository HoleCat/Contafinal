<div class="nav flex-column nav-pills options-bar-show position-fixed" id="options-bar" role="tablist" aria-orientation="vertical">

    <a id="opcion-new" class="hover-white no-link-shit mb-1 nav-link bg-success" data-toggle="pill" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-plus-square"></i></a>
    <a id="opcion-delete-uso" href="{{ url('/') }}" class="hover-white no-link-shit mb-1 nav-link bg-danger"><i class="fas fa-dumpster-fire"></i></a>
    <a id="opcion-delete" href="{{ url('/') }}" class="hover-white no-link-shit mb-1 nav-link bg-danger"><i class="fas fa-trash"></i></a>

</div>

<button onclick="optionsbar('#options-bar')" class="btn btn-primary position-fixed btn-options"><i class="fas fa-tools"></i></button>
<script>
    optionsbar('#options-bar');
</script>