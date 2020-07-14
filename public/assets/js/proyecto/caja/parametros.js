eventoscaja();

function eventoscaja(){
    
}

var cajachica = {
    total : 0
}

var datacajachica;

function actualizarparametros() {
    let formData = new FormData();
    formData.set('ruc', ruc);
    $.ajax({
		url: '/Caja/Parametros',
		type: 'POST',
		data: {
            ruc: ruc
        },
		processData: false,
        contentType: false,
        success: function(data){
            console.log(data)
        }
    }).done(function(){
		
	});
}

$(function(){
    
})