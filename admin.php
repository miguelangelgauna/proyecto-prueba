<?php
  $nombre = "Ale";
    $apellido = "Azz";
    $usuario = "ale@gmail.com";
    $pass = "admin1";
    $telefono = "123321";
    $rol = "admin";

  $passdesaparecida = password_hash($pass, PASSWORD_DEFAULT);


require("includes/conexion.php");
 $registrar = "INSERT INTO usuarios(nombre,apellido,correo,pass,telefono,rol) values ('$nombre','$apellido','$usuario','$passdesaparecida','$telefono','$rol')";
mysqli_query($conexion, $registrar);


?>