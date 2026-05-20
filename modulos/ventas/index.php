<?php
session_start();
require("../../includes/conexion.php");

 // Verificar si el usuario ha iniciado sesión como admin
    if (isset($_SESSION['admin'])) {

        $ventas = [];

            $query = "SELECT * FROM ventas ORDER BY id DESC";
            $result = mysqli_query($conexion, $query);

            while ($venta = mysqli_fetch_assoc($result)) {
                $venta_id = $venta['id'];

                $query_detalle = "SELECT * FROM detalle_ventas WHERE venta = $venta_id";
                $result_detalle = mysqli_query($conexion, $query_detalle);

                $productos = [];
                while ($fila = mysqli_fetch_assoc($result_detalle)) {
                    $productos[] = $fila;
                }

                $venta['productos'] = $productos;
                $ventas[] = $venta;
            }
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Ventas</title>
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php include("../../includes/menu-admin.php"); ?>

<div class="container mt-4">

  <h1 class="mb-4">Mis Ventas</h1>


  <?php
            // En el formulario de inicio de sesión (index.php)

            // Verificar si hay un mensaje almacenado en la variable de sesión
            if (isset($_SESSION['mensaje'])) {
                $mensaje = $_SESSION['mensaje'];
                // Eliminar el mensaje de la variable de sesión para que no se muestre nuevamente
                unset($_SESSION['mensaje']);
            }
            ?>
            <?php if (isset($mensaje)) : ?>
                <div class="alert alert-dark" role="alert">
                    <?php echo $mensaje; ?>
                </div>
<?php endif; ?>

  <?php if (count($ventas) > 0): ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php foreach ($ventas as $venta): ?>
        <div class="col">
          <div class="card shadow h-100">
            <div class="card-header bg-dark text-white">
              Compra del <?= $venta['fecha'] ?> a las <?= $venta['hora'] ?>
            </div>
            <div class="card-body">
              <h5 class="card-title">Total: $<?= number_format($venta['total'], 2) ?></h5>
              <h6>Productos:</h6>
              <ul class="list-group list-group-flush">
                <?php foreach ($venta['productos'] as $prod): ?>
                  <li class="list-group-item">
                    <?= $prod['producto'] ?> - <?= $prod['cantidad'] ?> x $<?= number_format($prod['precio_unitario'], 2) ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-info">Todavía no existen ventas.</div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
    }else{
        // El usuario admin no ha iniciado sesión, redirigir a una página de inicio de sesión
        header("Location: ../../login-admin.php");
        exit();
    }
?>