
var flagtable = true;

function aprobadortable() {
    if(flagtable == true)
    {
        $('#tabla-aprobador').DataTable();
        flagtable = false;
    }
    else
    {
        flagtable = true;
        $('#tabla-aprobador').DataTable().destroy();
    }
}