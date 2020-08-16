<?php
require('./conector.php');




session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','root','');
  if ($con->initConexion('agenda')=="OK"){
    if ($con->eliminarRegistro("agenda", " id= ".$_POST['id'] ) ){
      $response['msg']="OK";
      $con->cerrarConexion();
    } else {
      $response['msg']= 'No se pudo realizar el borrado de los datos: '.$con->getError();
    }
  } else {
    $response["msg"]="No se pudo conectar a la base de datos";
  }
} else {
    $response["msg"]= "No se ha iniciado una sesión.";
}
echo json_encode($response);


?>
