$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    getCiudades('#ciudades');
});

/* funcion para cargar la lista de ciudades que estan cargadas en la BD en un <select> */
function getCiudades(elemento){
    $.ajax({
        // la URL para la petición
        url: 'getCiudades',
        // especifica si será una petición POST o GET
        type: 'POST',
        // la información a enviar
        data: {'_token': $('input[name=_token]').val() },
        // el tipo de información que se espera de respuesta
        dataType: 'json',   
        before: function() {
            //
        },     
        success: function(data) {
            var str="";
            for (var i = 0; i < data.length; i++) {
                str += '<option value = '+data[i].id+' name="ciudad">'+data[i].nombre+'</option>';
                $(elemento).html(str);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}