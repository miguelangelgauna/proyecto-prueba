<?php

session_start();

if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['categoria'])){


    require("../../includes/conexion.php");

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];


    $verificarProducto= "SELECT * FROM productos WHERE nombre='$nombre'";
    $resultadoProducto= mysqli_query($conexion, $verificarProducto);

    if(mysqli_num_rows($resultadoProducto) > 0){
        $_SESSION['mensaje'] = "Producto ya registrado";
        header("Location: registrar.php");
        exit();
    }else{
        $query="insert into productos (nombre, descripcion, precio, stock, categoria) VALUES ('$nombre', '$descripcion', $precio, $stock,'$categoria')";

            if(mysqli_query($conexion, $query)){
                $_SESSION ["mensaje"]="Registrado Exitosamente";
                header ("Location: index.php");
                exit();
            }else{
                $_SESSION ["mensaje"]="No se pudo registrar";
                header ("Location: registrar.php");
                exit();
                
            }

        mysqli_close($conexion);
    }
        

}else{
    header ("Location: /tienda/panel-admin.php");
    exit();
}



?>