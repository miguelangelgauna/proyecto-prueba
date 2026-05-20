<?php 
require("../../includes/conexion.php");

session_start();

$correo=$_POST["correo"];
$pass=$_POST["pass"];

$query = "SELECT * FROM usuarios WHERE correo = '$correo' AND rol != 'admin'";
$resultado = mysqli_query($conexion, $query);

if(mysqli_num_rows($resultado) == 1){
    $fila = mysqli_fetch_assoc($resultado);
    $hash = $fila ['pass'];
    $user = $fila ['id'];

        if(password_verify($pass, $hash)){
            $_SESSION['email'] = $correo;
            $_SESSION['id'] = $user;

            header ("Location:  ../../panel.php");

        }else{
            //Contraseña incorrecta
            $_SESSION['mensaje'] = "Contraseña incorrecta. Intentelo de nuevo";
            header("Location: ../../login.php");
            exit();

        }


    }else{

        //Usuario no encontrado
        $_SESSION['mensaje'] = "Usuario no encontrado";
        header("Location: ../../login.php");
        exit();

    }


?>