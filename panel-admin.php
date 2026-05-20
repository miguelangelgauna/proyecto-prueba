<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión como admin
    if (isset($_SESSION['admin'])) {
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>

<?php include("includes/menu-admin.php"); ?>

<div class="container">
    <h1 class="my-3">Panel Administrador <?php echo $_SESSION['admin']; ?></h1>

    <div id="informacion">  
        <div class="row"> 
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Productos en Stock</h5>
                        <?php 
                            require('includes/conexion.php');

                            //Se realiza la consulta para contar el numero de usuarios
                            $query = "SELECT COUNT(*) AS totalProductos FROM productos WHERE stock > 0";
                            $result = mysqli_query($conexion, $query);

                            //Obtener el resultado de la consulta
                            $row = mysqli_fetch_assoc($result);
                            $totalProductos = $row['totalProductos'];
                        ?>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $totalProductos ?></h6>
                        <p class="card-text">Cantidad total en inventario.</p>
                    </div>
                </div>

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Ventas Hoy</h5>
                        <?php 
                            require('includes/conexion.php');

                            date_default_timezone_set('America/Argentina/Buenos_Aires');
                            $fecha = date("Y-m-d");

                            //Se realiza la consulta para contar el numero de usuarios
                            $query = "SELECT COUNT(*) AS totalVentas FROM ventas WHERE fecha = '$fecha'";
                            $result = mysqli_query($conexion, $query);

                            //Obtener el resultado de la consulta
                            $row = mysqli_fetch_assoc($result);
                            $totalVentas = $row['totalVentas'];
                        ?>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $totalVentas; ?></h6>
                        <p class="card-text">Ventas generados en el día.</p>
                    </div>
                </div>


                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Ganancia Estimada</h5>
                        <?php
                            require("includes/conexion.php");

                            $sql = "SELECT SUM(total) AS ganancia_mensual
                                    FROM ventas
                                    WHERE MONTH(fecha) = MONTH(CURRENT_DATE())
                                    AND YEAR(fecha) = YEAR(CURRENT_DATE())";

                            $resultado = mysqli_query($conexion, $sql);
                            $fila = mysqli_fetch_assoc($resultado);
                            $ganancia = $fila['ganancia_mensual'] ?? 0;
                        ?>
                        <h6 class="card-subtitle mb-2 text-body-secondary">$<?php echo number_format($ganancia, 2, ',', '.') ?></h6>
                        <p class="card-text">Ganancias aproximadas del mes.</p>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
    }else{
        // El usuario admin no ha iniciado sesión, redirigir a una página de inicio de sesión
        header("Location: login-admin.php");
        exit();
    }
?>
