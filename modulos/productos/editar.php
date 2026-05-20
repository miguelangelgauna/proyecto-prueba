
<?php

session_start ();
if (isset($_SESSION["admin"])){

    if(isset($_GET["id"])){
        $id= $_GET['id'];

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


    <?php 
    require ("../../includes/conexion.php");
     $query="SELECT * FROM  productos WHERE id= $id";
     $result = mysqli_query ($conexion, $query);
     if (mysqli_num_rows($result)==1){

     $row= mysqli_fetch_assoc($result);
    
    
    ?>


        <form action="actualizar.php" method="POST"  class="my-3">
            <h2>Actualizar Datos</h2>
            <input type="hidden" value="<?php echo $row['id']?> " name="id">
            <div  class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value = "<?php echo $row['nombre']?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" value = "<?php echo $row['descripcion']?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio" value = "<?php echo $row['precio']?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Stock</label>
                <input type="number" class="form-control" name="stock" value = "<?php echo $row['stock']?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoria</label>
                <input type="text" class="form-control" name="categoria" value = "<?php echo $row['categoria']?>">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
        <?php 
     }else{
        echo "<p> Producto no encontrado</p> ";
     }
        
       mysqli_close($conexion);
        ?>       

    </div>
</body>
</html>

<?php

}else{
    header ("Location: /tienda/panel-admin");
    exit();
}


}else{
    header ("Location: ../../login-admin.php");
    exit();
}
?>