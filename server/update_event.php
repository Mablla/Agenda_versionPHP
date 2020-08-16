<?php
require('./conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','root','');
  if ($con->initConexion('agenda')=="OK"){

//****
    //actualizarRegistro($tabla, $data, $condicion)
     if ($con->actualizarRegistro("agenda", $_POST ," id= ".$_POST['id'] ) ){
       $response['msg']="OK";
     } else {
       $response['msg']= 'No se pudo realizar la actualización de los datos: '.$con->getError();
     }

//*****
  $con->cerrarConexion();
  } else {
    $response["msg"]="No se pudo conectar a la base de datos";
  }
} else {
    $response["msg"]= "No se ha iniciado una sesión.";
}
echo json_encode($response);


?>
