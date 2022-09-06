$(document).ready(function () {

    displayData();

});

//INFORMACION EN TABLA
function displayData() {
    let displayData = "true";
    $.ajax({
        url: "app/display.php",
        type: "POST",
        data: {
            displaySend: displayData
        },
        success: function (data, status) {
            $('#displayDataTable').html(data);
            $('#ejemplo').DataTable();
        }
    });
}

//FUNCION AGREGAR
function agregarUser() {

    let nombreAgregar = $('#nombreCompleto').val(); //Obtenemos con jquery lo que esta en el input y lo guardamos en una variable
    let correoAgregar = $('#correoCompleto').val();
    let telefonoAgregar = $('#telefonoCompleto').val();
    let lugarAgregar = $('#lugarCompleto').val();

    $.ajax({

        url: "app/insert.php",
        type: "POST",
        data: {
            nameSend: nombreAgregar,
            emailSend: correoAgregar,
            mobileSend: telefonoAgregar,
            placeSend: lugarAgregar
        },
        success: function (data, status) {
            //console.log(status)
            $('#modalAgregar').modal('hide');
            swal({
                title: "Agregado Correctamente",
                icon: "success",
                button: "Cerrar",
            });
            displayData();
        }

    });

}

//FUNCION ELIMINAR
function eliminarUser(id) {

    $.ajax({
        url: "app/delete.php",
        type: "POST",
        data: {
            deleteSend: id
        },
        success: function (data, status) {
            swal({
                title: "Estas seguro?",
                text: "Una vez eliminado, no podras recuperar este registro!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Registro eliminado!", {
                            icon: "success",

                        });
                        displayData();
                    } else {
                        swal("El registro esta a salvo!");
                    }
                });

        }
    });
}

//FUNCION OBTENER INFORMACION PARA FORMULARIO ACTUALIZAR
function getInfo(id) {

    $('#hiddenData').val(id);

    $.post("app/update.php", {
        idSend: id
    }, function (data, status) {

        let usuario = JSON.parse(data);

        $('#actualizarNombre').val(usuario.nameDB);
        $('#actualizarCorreo').val(usuario.emailDB);
        $('#actualizartelefono').val(usuario.mobileDB);
        $('#actualizarLugar').val(usuario.placeDB);

    });

    $('#modalActualizar').modal("show");
}

//FUNCION ACTUALIZAR
function updateUser() {

    let actualizarNombre = $('#actualizarNombre').val();
    let actualizarCorreo = $('#actualizarCorreo').val();
    let actualizartelefono = $('#actualizartelefono').val();
    let actualizarLugar = $('#actualizarLugar').val();
    let hiddenData = $('#hiddenData').val();

    //console.log(actualizarNombre,actualizarCorreo,actualizartelefono,actualizarLugar,hiddenData)

    $.post("app/update.php", {
        actualizarNombreSend: actualizarNombre,
        actualizarCorreoSend: actualizarCorreo,
        actualizartelefonoSend: actualizartelefono,
        actualizarLugarSend: actualizarLugar,
        hiddenDataSend: hiddenData
    }, function (data, status) {
        $('#modalActualizar').modal('hide');

        swal({
            title: "Actualizado Correctamente",
            icon: "success",
            button: "Cerrar",
        });
        displayData();
    });

}

//ALERTA DE AGREGADO
function alertaAgregar() {
    swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        button: "Aww yiss!",
    });
}
