
var flagtable = true;

function centrocostotable() {
    if(flagtable == true)
    {
        $('#tabla-centrocosto').DataTable();
        flagtable = false;
    }
    else
    {
        flagtable = true;
        $('#tabla-centrocosto').DataTable().destroy();
    }
}