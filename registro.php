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
        <form class = "bg-white p-4" style = "width: 18rem;" action="modulos/usuarios/registrarse.php" method="post" >
            <h2 class = "text-center" >
                Registrarse
            </h2>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nombre">
            
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="apellido">
                
                </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Telofono</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="telefono">
                
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usuario">
                
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
                </div>
                <div class="mb-3">
                    
                    <input type="hidden" value="cliente" class="form-control" id="exampleInputEmail1" name="rol">
                
                </div>
                
                    <button type="submit" class="btn btn-primary">Registrarme</button>

                    <div class="mb-3">
                      <a href="login.php">¿Ya tenes una cuenta?</a>
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