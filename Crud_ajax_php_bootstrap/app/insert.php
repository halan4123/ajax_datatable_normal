<?php

include 'connectionController.php';

$conn = connect();

extract($_POST);

if (
    isset($_POST['nameSend']) &&
    isset($_POST['emailSend']) &&
    isset($_POST['mobileSend']) &&
    isset($_POST['placeSend'])
) {

    $sql =
        "INSERT INTO `crud` (nameDB,emailDB,mobileDB,placeDB) VALUES 
        ('$nameSend','$emailSend' ,'$mobileSend' ,'$placeSend')";

    $result = mysqli_query($conn, $sql);
}
