<?php
session_start();

// Verificar si el usuario ha iniciado sesión
  if (isset($_SESSION['email'])) {
      require("includes/conexion.php");

      $usuario_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
      $ultima_venta = null;

      if ($usuario_id) {
          $query = "SELECT * FROM ventas WHERE usuario = $usuario_id ORDER BY id DESC LIMIT 1";
          $result = mysqli_query($conexion, $query);

          if ($result && mysqli_num_rows($result) > 0) {
              $ultima_venta = mysqli_fetch_assoc($result);

              $venta_id = $ultima_venta['id'];
              $query_detalle = "SELECT * FROM detalle_ventas WHERE venta = $venta_id";
              $result_detalle = mysqli_query($conexion, $query_detalle);
              $productos = [];
              while ($fila = mysqli_fetch_assoc($result_detalle)) {
                  $productos[] = $fila;
              }

              $ultima_venta['productos'] = $productos;
          }
    }
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include("includes/menu.php"); ?>

<div class="container mt-4">
  <h1 class="mb-4">Bienvenido 
    <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : "Usuario"; ?>
  </h1>

  <?php if ($ultima_venta): ?>
    <div class="card shadow">
      <div class="card-header bg-info text-white">
        Última compra - <?= $ultima_venta['fecha'] ?> a las <?= $ultima_venta['hora'] ?>
      </div>
      <div class="card-body">
        <h5 class="card-title">Total: $<?= number_format($ultima_venta['total'], 2) ?></h5>

        <h6 class="mt-3">Productos:</h6>
        <ul class="list-group list-group-flush">
          <?php foreach ($ultima_venta['productos'] as $prod): ?>
            <li class="list-group-item">
              <?= $prod['producto'] ?> - <?= $prod['cantidad'] ?> x $<?= number_format($prod['precio_unitario'], 2) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-info">Todavía no realizaste ninguna compra.</div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
    }else{
        // El usuario no ha iniciado sesión, redirigir a una página de inicio de sesión
        header("Location: login.php");
        exit();
    }
?>