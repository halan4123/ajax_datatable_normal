<?php

include 'connectionController.php';

$conn = connect();


if (isset($_POST['idSend'])) {

    $id = $_POST['idSend'];

    $sql = "SELECT * FROM `crud` WHERE idDB = $id";
    $result = mysqli_query($conn, $sql);

    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $response = $row;
    }

    echo json_encode($response);
} else {
    $response['status'] = 200;

    $response['message'] = "Invalido o información No encontrada";
}


//UPDATE QUERY
if (isset($_POST['hiddenDataSend'])) {

    $hiddenData_id = $_POST['hiddenDataSend'];
    $name = $_POST['actualizarNombreSend'];
    $correo = $_POST['actualizarCorreoSend'];
    $telefono = $_POST['actualizartelefonoSend'];
    $place = $_POST['actualizarLugarSend'];

    $sql =
        "UPDATE `crud` SET nameDB = '$name', emailDB = '$correo', mobileDB = '$telefono', placeDB = '$place' 
    WHERE idDB = $hiddenData_id";
    $result = mysqli_query($conn, $sql);
}
