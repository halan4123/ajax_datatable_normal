<?php

include 'connectionController.php';

$conn = connect();

if (isset($_POST['displaySend'])) {
  $number = 1;
  $table = '<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Numero</th>
        <th>Lugar</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>';

  $sql = "SELECT * FROM `crud`";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {

    $id = $row['idDB'];
    $name = $row['nameDB'];
    $email = $row['emailDB'];
    $mobile = $row['mobileDB'];
    $place = $row['placeDB'];

    $table .= '<tr>
                <td>' . $number . '</td>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $mobile . '</td>
                <td>' . $place . '</td>
                <td>
                  <button class="btn btn-info" onclick="getInfo(' . $id . ')">
                  <span class="glyphicon glyphicon-pencil"></span>
                  </button>
                    <button class="btn btn-danger" onclick="eliminarUser(' . $id . ')">
                    <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </td>
            </tr>';
    $number++;
  }

  $table .= '</body></table>';
  echo $table;
}
