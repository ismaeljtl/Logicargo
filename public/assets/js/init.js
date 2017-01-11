$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    getCiudades('#ciudades');

    $('body > div > div > form > div > div:nth-child(14)').on('click', agregarJefe);
});

/* funcion para cargar la lista de ciudades que estan cargadas en la BD en un <select> */
function getCiudades(elemento){
    $.ajax({
        // la URL para la petición
        url: 'getCiudades',
        // especifica si será una petición POST o GET
        type: 'get',
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

function agregarJefe(){
    /* si el tipo de empleado seleccionado es igual a Repartidor */
    if ($('#tipoEmp').val() == 2){
        var str = '<label class="col-lg-3 col-form-label">Id Jefe</label>'
                      +'<div class="col-lg-9">'
                          +'<input class="form-control" id="Jefe_id" name="Jefe_id">'
                          +'</select>'
                      +'</div>'
        $('#jefe').html(str);
    }
    else if ($('#tipoEmp').val() != 2){
        str = '<div class="form-group row">'
              +'</div>';
        $('#jefe').html(str);
    }
}

function eliminarCli() {
    if (confirm("¿Estás seguro de que deseas eliminar la cuenta?") == true){
      window.location.href = 'eliminarUsuario'; 
    }
}

function eliminarEmp() {
    if (confirm("¿Estás seguro de que deseas eliminar la cuenta?") == true){
      window.location.href = 'eliminarEmpleado'; 
    }
}