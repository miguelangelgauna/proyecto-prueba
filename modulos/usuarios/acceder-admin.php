<?php 
require("../../includes/conexion.php");

session_start();

$correo=$_POST["correo"];
$pass=$_POST["pass"];

$query = "SELECT * FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $query);

if(mysqli_num_rows($resultado) == 1){
    $fila = mysqli_fetch_assoc($resultado);
    $hash = $fila ['pass'];
    $user = $fila ['rol'];
    $id_user = $fila['id'];

        if(password_verify($pass, $hash)){
            if($user == "admin"){
                 
                $_SESSION['admin'] = $correo;
                $_SESSION['rol'] = $user;
                $_SESSION['admin-id'] = $id_user;

                header ("Location:  ../../panel-admin.php");
                exit();
            }else{
                // No es admin
                $_SESSION['mensaje'] = "No tienes permisos de administrador.";
                header("Location: ../../login-admin.php");
                exit();

            }
           

        }else{
            // Contraseña incorrecta
            $_SESSION['mensaje'] = "Contraseña incorrecta. Intentelo de nuevo";
            header("Location: ../../login-admin.php");
            exit();

        }


    }else{

        // Usuario no encontrado
        $_SESSION['mensaje'] = "Usuario no encontrado";
        header("Location: ../../login-admin.php");
        exit();

    }


?>