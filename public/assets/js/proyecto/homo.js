
var flagtable = true;

function homotable() {
    if(flagtable == true)
    {
        $('#tabla-homologacion').DataTable();
        flagtable = false;
    }
    else
    {
        flagtable = true;
        $('#tabla-homologacion').DataTable().destroy();
    }
}