<?php


require('./conector.php');

// para pruebas sólo con php
// $_SESSION['username']='gabriela1988@mail.com';
// $_POST['titulo']="conulta Médico";
// $_POST['fecha_inicio']="2020-07-28";
// $_POST['hora_inicio']="08:00:00";
// $_POST['fecha_fin']="2020-07-28";
// $_POST['hora_fin']="09:00:00";
// $_POST['dia_completo']="0";
//echo json_encode($_POST);


session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','root','');
  if ($con->initConexion('agenda')=="OK"){
        $data['titulo']=$_POST['titulo'];
    $data['fecha_inicio']=$_POST['fecha_inicio'];
    $data['hora_inicio']=$_POST['hora_inicio'];
    $data['fecha_fin']=$_POST['fecha_fin'];
    $data['hora_fin']=$_POST['hora_fin'];
    $data['dia_completo']=$_POST['dia_completo'];
    $resultado= $con->consultar(['usuarios'],['id'], "WHERE email='".$_SESSION['username']."'");
    $fila= $resultado->fetch_assoc();
    $data['fk_usuario']= $fila['id'];
    // retorna el id del evento recién registrado
    if ($con->insertData('agenda',$data)){
      $resultado = $con->consultar(['agenda'],['id'], "ORDER BY id DESC LIMIT 1;");
      $fila = $resultado->fetch_assoc();
      $response['id']=$fila['id'];
      $response['msg']="OK";
      $con->cerrarConexion();
    } else {
      $response['msg']= 'No se pudo realizar la inserción de los datos.';
    }
  } else {
    $response["msg"]="No se pudo conectar a la base de datos";
  }
} else {
    $response["msg"]= "No se ha iniciado una sesión.";
}
echo json_encode($response);

?>
