<?php
require('./conector.php');

$con = new ConectorBD('localhost','','');

$response['conexion'] = $con->initConexion('agenda');

if ($response['conexion']=='OK') {
  $resultado_consulta = $con->consultar(['usuarios'],
  ['email', 'psw'], 'WHERE email="'.$_POST['username'].'"');

  if ($resultado_consulta->num_rows != 0) {
    $fila = $resultado_consulta->fetch_assoc();
    if (password_verify($_POST['passw'], $fila['psw'])) {
      $response['acceso'] = 'concedido';
      session_start();
      $_SESSION['username']=$fila['email'];
    }else {
      $response['motivo'] = 'Acceso incorrecto...';
      $response['acceso'] = 'rechazado';
    }
  }else{
    $response['motivo'] = 'Acceso incorrecto...';
    $response['acceso'] = 'rechazado';
  }
  $con->cerrarConexion();
}

echo json_encode($response);






 ?>
