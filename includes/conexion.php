<?php
//Vairiables de conexion 
$servername = "localhost";
$username = "root";
$password = "";
$database = "tienda";

//Establece la base de datos
$conexion= mysqli_connect($servername, $username, $password, $database);

//Validacion de conexion

if (!$conexion){
    die("Error al conectar la base de datos: " .
    mysqli_connect_error());
}




