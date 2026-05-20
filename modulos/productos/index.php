
<?php

session_start ();
if (isset($_SESSION["admin"])){
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php include("../../includes/menu-admin.php"); ?>


    <div class="container">
        <h1>Productos</h1>
        <a href="registrar.php "class="btn btn-primary" >Registrar</a>

        <?php
        require ("../../includes/conexion.php");
        $query ="SELECT * FROM productos ";
        $result=(mysqli_query($conexion, $query));
        if (mysqli_num_rows($result) > 0 ){
        ?>

        <div class="row">


        <?php if (isset($_SESSION['mensaje'])){
            $mensaje= $_SESSION['mensaje'];
            unset ($_SESSION['mensaje']);
        }
        ?>
        <?php if (isset($mensaje)) :  ?> 
            <div class="alert alert-dark" role="alert">
                <?php  echo $mensaje; ?>
            </div>       
        <?php endif;?>      

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>



                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row=mysqli_fetch_assoc($result)):



                ?>
                    <tr>
                        <td><?php echo $row['nombre']; ?></th>
                        <td><?php echo $row['descripcion']; ?></th>
                        <td><?php echo $row['precio']; ?></th>
                        <td><?php echo $row['stock']; ?></th>
                        <td><?php echo $row['categoria']; ?></th>
                        <td><?php echo $row['imagen']; ?></th>



                   
                        <td>
                            <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>

                        </td>
                    </tr>
                    
                </tbody>
                <?php endwhile; ?>
            </table>
            <?php 
            
        }else {
            echo "<p> No hay Registros</p>";
        }
        mysqli_close ($conexion);
            
            
            ?>
        </div>

    </div>
</body>
</html>

<?php


}else{
    header ("Location: ../../login-admin.php");
    exit();
}
?>