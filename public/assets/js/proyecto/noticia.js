
var flagtable = true;

function noticiatable() {
    if(flagtable == true)
    {
        $('#tabla-noticia').DataTable();
        flagtable = false;
    }
    else
    {
        flagtable = true;
        $('#tabla-noticia').DataTable().destroy();
    }
}