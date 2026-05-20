
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
        <form action="guardar.php" method="POST"  class="my-3">
            <h2>Registro</h2>
            <div  class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Stock</label>
                <input type="number" class="form-control" name="stock">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoria</label>
                <input type="text" class="form-control" name="categoria">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        

    </div>
</body>
</html>

<?php


}else{
    header ("Location: ../../login-admin.php");
    exit();
}
?>