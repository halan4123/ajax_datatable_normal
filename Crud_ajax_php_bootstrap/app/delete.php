<?php

include 'connectionController.php';

$conn = connect();


if (isset($_POST['deleteSend'])) {

    $id = $_POST['deleteSend'];

    $sql = "DELETE FROM `crud` WHERE idDB = $id";
    $result = mysqli_query($conn, $sql);
}
