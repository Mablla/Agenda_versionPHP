<?php
//$_SESSION['username']= "jose.perez@mail.com";
require('conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','root','');
  if ($con->initConexion('agenda')=="OK"){
    $resultado = $con->getAgenda($_SESSION['username']);
    $i=0;
    while ($fila = $resultado->fetch_assoc()){
      $response["eventos"][$i]["id"] = $fila['id'];
      $response["eventos"][$i]["title"] = $fila['titulo'];
      if ($fila['dia_completo']==0){
        $response["eventos"][$i]["allday"] =false;
        $response["eventos"][$i]["start"]= $fila['fecha_inicio']."T".$fila['hora_inicio'];
        $response["eventos"][$i]["end"]=$fila['fecha_fin']."T".$fila['hora_fin'];
      } else {
        $response["eventos"][$i]["allday"] =true;
        $response["eventos"][$i]["start"]= $fila['fecha_inicio'];
      }
      $i++;
    }
    $con->cerrarConexion();
    $response["msg"]="OK";
  } else{
    $response['msg']= 'No se pudo conectar a la base de datos.';
  }

} else {
    $response["msg"]= "No se ha iniciado una sesión.";
}

echo json_encode($response);

 ?>
