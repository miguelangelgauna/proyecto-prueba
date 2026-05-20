<?php

session_start();

if (isset($_POST['id'])  && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['categoria'])){


    require("../../includes/conexion.php");

    $id = $_POST['id'];


    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];


     $query="UPDATE productos SET nombre='$nombre', descripcion= '$descripcion', precio= $precio, stock= $stock, categoria ='$categoria' WHERE id=$id";

            if(mysqli_query($conexion, $query)){
                $_SESSION ["mensaje"]="Actualizado Exitosamente";
                header ("Location: index.php");
                exit();
            }else{
                $_SESSION ["mensaje"]="No se pudo Actualizar";
                header ("Location: editar.php");
                exit();
                
            }

        mysqli_close($conexion);
        

}else{
    header ("Location: /tienda/panel-admin.php");
    exit();
}



?>