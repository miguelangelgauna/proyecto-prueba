<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión como admin
    if (!isset($_SESSION['email'])) {
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
      body{
        background-image:url("imagenes/fondo-login.avif");
        background-size: cover;
        background-position:center;

      }
    </style>
  </head>
  <body>
    <div class="container d-flex justify-content-center align-items-center vh-100" >
        <form action="modulos/usuarios/acceder.php" method="post" class = "bg-white p-4" style = "width: 18rem;" >
            <h2 class = "text-center" >
                Mi Cuenta
            </h2>
            <?php
            

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
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo</label>
    <input type="email" class="form-control" id="" aria-describedby="emailHelp" name="correo">
 
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="" name="pass">
  </div>
 
  <button type="submit" class="btn btn-primary">Acceder</button>
  <div class="mb-3">
    <a href="registro.php">¿Todavia no tenes una cuenta?</a>
  </div>
</form>

    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
    }else{
        // El usuario admin no ha iniciado sesión, redirigir a una página de inicio de sesión
        header("Location: panel.php");
        exit();
    }
?>