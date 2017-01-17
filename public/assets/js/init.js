$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    getCiudades('#centro_Dist');
    getJefes('#Jefe_id');

    $('body > div > div > form > div > div:nth-child(13) > div').on('click', agregarJefe);
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
/* funcion para cargar la lista de los id de los Jefes */
function getJefes(elemento){
    $.ajax({
        // la URL para la petición
        url: 'getJefes',
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
            console.log(data);
            var str="";
            for (var i = 0; i < data.length; i++) {
                str += '<option value = '+data[i].id+' name="Jefe">'+data[i].id+'</option>';
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
        $('#jefe').css('display', 'block');
    }
    else if ($('#tipoEmp').val() != 2){
        $('#jefe').css('display', 'none');
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