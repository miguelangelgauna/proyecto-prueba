<?php 
session_start();

if (isset($_GET['id'])){
require ("../../includes/conexion.php");
 $id= $_GET['id'];
 $query="DELETE FROM productos WHERE id=$id";

            if(mysqli_query($conexion, $query)){
                $_SESSION ["mensaje"]="Producto Eliminado";
                header ("Location: index.php");
                exit();
            }else{
                $_SESSION ["mensaje"]="No se pudo Eliminar";
                header ("Location: index.php");
                exit();
                
            }

        mysqli_close($conexion);




}else{
    header ("Location: /tienda/panel-admin.php");
    exit();
}








?>