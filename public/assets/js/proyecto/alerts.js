function show_alert_now(mensaje)
{
    $.confirm({
        title: 'AVISO :',
        content: mensaje,
        buttons: {
            ok: {
                text: 'ok',
                btnClass: 'btn-primary',
                keys: ['enter', 'shift'],
                action: function(){
                    console.log();
                }
            }
        }
    });
}