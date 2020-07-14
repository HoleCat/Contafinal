
var flagtable = true;

function titulotable() {
    if(flagtable == true)
    {
        $('#tabla-titulos').DataTable();
        flagtable = false;
    }
    else
    {
        flagtable = true;
        $('#tabla-titulos').DataTable().destroy();
    }
}