<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
</head>
<body>
    <!-- Menu -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ecommerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav gap-2" >
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <?php 
                if (isset($_SESSION['email'])){
                ?>
                
                <li class="nav-item">
                <a class="btn btn-primary" href="panel.php">Mi cuenta</a>
                </li>
                <?php 
                }else{

                ?> 
                <li class="nav-item">
                <a class="btn btn-primary" href="registro.php">Registrar</a>
                </li>
                <li class="nav-item">
                <a class="btn btn-success" href="login.php">Ingresar</a>
                </li>
                <?php 
                }
                
                ?>
                <li class="nav-item">
                <a class="btn " href="#" data-bs-toggle="modal" data-bs-target="#carrito"><img src="imagenes/cart-fill.svg" alt="" style="filter: brightness(0) invert(1); "></a>
                </li>
            </ul>
            </div>
        </div>
</nav>
<!-- Fin Menu -->
 <!-- Carrusel -->
  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="imagenes/carousel-1.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="imagenes/carousel-2.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="imagenes/carousel-3.webp" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
  <!-- Fin Carusel -->

<!-- Carrito -->

        <div class="modal fade" id="carrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Mi Carrito</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenido-carrito">
                
 



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button  type="button" class="btn btn-primary" id="procesar-compra">Comprar</button>
            </div>
            </div>
        </div>
        </div>
<!-- Fin Carrito -->

  <!-- Catalogo -->

    <div class="container">
        <h2 class="text-center py-3">Productos</h2>
        <div class="row mb-4">
            <div class="productos d-flex justify-content-center gap-3 flex-wrap">





            <?php 
            require("includes/conexion.php");
            $query = "SELECT * FROM productos";
            $result= mysqli_query($conexion, $query);
            if (mysqli_num_rows($result) > 0 ){

            ?>

            <?php 
            while ($row = mysqli_fetch_assoc($result)):
            
            
            ?>
                <div class="card" style="width: 18rem;">
                    <img src="imagenes/producto.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre']?></h5>
                        <p class="card-text"><?php echo $row['descripcion']?></p>
                        <p class="card-text"><?php echo $row['precio']?></p>
                        <a href="#" class="btn btn-primary agregar" data-id="<?php echo $row['id']?>" data-nombre="<?php echo $row['nombre']?>" data-descripcion="<?php echo $row['descripcion']?>" data-precio="<?php echo $row['precio']?>" >Añadir</a>
                    </div>
                </div>

                <?php endwhile; ?>

                <?php
                
            }else{
                
                
                echo "<p class='text-center fs-4'>  No hay productos</p>";
            }
                mysqli_close($conexion);
                ?>
            </div>
        </div>
    </div>
    <!-- Fin Catalogo -->



     <!-- Footer -->
      <footer class="bg-dark text-white ">
            <div class="container py-3">
                <div class="copy">
                    <p class="m-0 text-center">Desarrollado por &copy; Miguel</p>
                </div>

            </div>


      </footer>
      <!-- fin footer -->
      

  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/carrito.js"></script>

</body>
</html>