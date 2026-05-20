<?php
require("../../includes/conexion.php");

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $usuario = $_POST["usuario"];
    $pass = $_POST["pass"];
    $telefono = $_POST["telefono"];
    $rol = $_POST["rol"];

   $verificarEmail = "SELECT * FROM usuarios where correo = '$usuario'";
   $resulatdoVerificacion = mysqli_query($conexion, $verificarEmail) ;
   if(mysqli_num_rows($resulatdoVerificacion)> 0){
      //codigo 
         $_SESSION['mensaje'] = "El email ingresado ya está en uso";
         header("Location: ../../registro.php");

   }else{
     //codigo
    
     $passdesaparecida = password_hash($pass, PASSWORD_DEFAULT);

     $registrar = "INSERT INTO usuarios(nombre,apellido,correo,pass,telefono,rol) values ('$nombre','$apellido','$usuario','$passdesaparecida','$telefono','$rol')";
     
     if(mysqli_query($conexion, $registrar)){
     //codigo
            $_SESSION['mensaje'] = "Registrado exitosamente";
            header("Location: ../../login.php");
            exit();
     }else{
     //codigo
            $_SESSION['mensaje'] = "No se pudo registrar";
            header("Location: ../../registrar.php");
            exit();
     }


   }


?>
