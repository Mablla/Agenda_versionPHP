<?php
$INSERT_INTO_usuarios = <<<'usuarios'
INSERT INTO `usuarios` (`nombre`, `psw`, `email`, `fecha_nacimiento`) VALUES ('Jose Pérez', '$2y$10$LpV37KUmSYikQyr/qeN3AebE0Uvz6WJ.cmoBvZJjqWEpBaQ8N/Q2S', 'jose.perez@mail.com', '1975-10-11'), ('Carlos Ramirez', '$2y$10$LpV37KUmSYikQyr/qeN3AebE0Uvz6WJ.cmoBvZJjqWEpBaQ8N/Q2S', 'carlos.ramirez@mail.com', '1974-06-20'), ('Gabriela Martinez', '$2y$10$LpV37KUmSYikQyr/qeN3AebE0Uvz6WJ.cmoBvZJjqWEpBaQ8N/Q2S', 'gabriela1988@mail.com', '1988-03-17');
usuarios;
$INSERT_INTO_agenda = <<<'agenda'
INSERT INTO `agenda` (`titulo`,`fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`,`dia_completo`,`fk_usuario`) VALUES ('Encuentro con Telma', '2020-08-20', '08:00:00', NULL, NULL, 0, 1), ('Encuentro con Corcho', '2020-08-20', '10:00:00', NULL, NULL, 0, 1);
agenda;
//$mysqli = new mysqli('localhost', 'mi_usuario', 'mi_contraseña', 'mi_bd');
$conexion = new mysqli("localhost","root","","agenda");
if ($conexion->connect_error) {
  echo $conexion->connect_error;
}else {
  $conexion->query($INSERT_INTO_usuarios);
  if ($conexion->error) {
    echo "usuarios: ".$conexion->error."  ";
  } else {
    echo "usuarios: OK  ";
  }
  $conexion->query($INSERT_INTO_agenda);
  if ($conexion->error) {
    echo "agenda: ".$conexion->error."  ";
  } else {
    echo "agenda: OK";
  }

}
$conexion->close();
 ?>
