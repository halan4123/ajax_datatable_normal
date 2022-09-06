<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootsrap Modal cud</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        .top {
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>

</head>

<body>

    <!-- MODAL AGREGAR NUEVO USUARIO -->
    <div id="modalAgregar" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nombreCompleto">Nombre:</label>
                        <input type="text" class="form-control" id="nombreCompleto" placeholder="Nombre">
                    </div>

                    <div class="form-group">
                        <label for="correoCompleto">Correo:</label>
                        <input type="email" class="form-control" id="correoCompleto" placeholder="Correo">
                    </div>

                    <div class="form-group">
                        <label for="telefonoCompleto">Telefono:</label>
                        <input type="text" class="form-control" id="telefonoCompleto" placeholder="Telefono">
                    </div>

                    <div class="form-group">
                        <label for="lugarCompleto">Lugar:</label>
                        <input type="text" class="form-control" id="lugarCompleto" placeholder="Lugar">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="agregarUser()">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>

        </div>
    </div>

    <!-- MODAL ACTUALIZAR -->
    <div id="modalActualizar" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Actualizar</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nombreCompleto">Nombre:</label>
                        <input type="text" class="form-control" id="actualizarNombre" placeholder="Nombre">
                    </div>

                    <div class="form-group">
                        <label for="correoCompleto">Correo:</label>
                        <input type="email" class="form-control" id="actualizarCorreo" placeholder="Correo">
                    </div>

                    <div class="form-group">
                        <label for="telefonoCompleto">Telefono:</label>
                        <input type="text" class="form-control" id="actualizartelefono" placeholder="Telefono">
                    </div>

                    <div class="form-group">
                        <label for="lugarCompleto">Lugar:</label>
                        <input type="text" class="form-control" id="actualizarLugar" placeholder="Lugar">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateUser()">Actualizar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddenData">
                </div>
            </div>

        </div>
    </div>

    <div class="container top">

        <h1 class="text-center">PHP CRUD operaciones usando Bootstrap Modal</h1>


        <button type="button" class="btn btn-primary top" data-toggle="modal" data-target="#modalAgregar">Agregar</button>


        <div id="displayDataTable">

        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
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
                success: function(data, status) {
                    $('#displayDataTable').html(data);
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
                success: function(data, status) {
                    //console.log(status)
                    $('#modalAgregar').modal('hide');
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
                success: function(data, status) {
                    displayData();
                }
            });
        }

        //FUNCION obtener info
        function getInfo(id) {

            $('#hiddenData').val(id);

            $.post("app/update.php", {
                idSend: id
            }, function(data, status) {

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
           
            $.post("app/update.php",{
                actualizarNombreSend:actualizarNombre,
                actualizarCorreoSend:actualizarCorreo,
                actualizartelefonoSend:actualizartelefono,
                actualizarLugarSend:actualizarLugar,
                hiddenDataSend:hiddenData
            },function(data,status){
                $('#modalActualizar').modal('hide');
                displayData();
            });

        }
    </script>


</body>

</html>