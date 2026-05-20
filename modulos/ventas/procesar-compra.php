<?php
session_start();

// Verificar si el usuario ha iniciado sesión
    if (isset($_SESSION['email'])) {
      
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

    <?php include("../../includes/menu.php"); ?>

    <div class="container">


    <h2 class="my-3">Resumen de compra</h2>

        <!-- Resumen carrito -->
        <div id="resumen-carrito" class="mb-4">
            <h4>Productos en tu carrito</h4>
            <div id="productos-carrito">  
            </div>
            <hr>
            <h5>Total: <span id="total-compra"></span></h5>
        </div>
        <!-- Fin Resumen Carrito -->

    </div>

    <!-- Datos de envio -->
     <h2>Datos de envio</h2>
        <form id="form-compra" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" required>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="provincia">Provincia</label>
                    <input type="text" class="form-control" id="provincia" name="provincia" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pais">País</label>
                    <input type="text" class="form-control" id="pais" name="pais" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                </div>

            </div>

            <div class="form-group">
                    <label for="notas_envio">Notas de Envío (opcional)</label>
                    <textarea class="form-control" id="notas_envio" name="notas_envio" rows="3"></textarea>
                </div>

            <div class="form-group">
                <label for="tipo_envio">Tipo de Envío</label>
                <select class="form-control" id="tipo_envio" name="tipo_envio" required>
                    <option value="retiro_local">Retiro en Local</option>
                    <option value="envio_domicilio">Envío a Domicilio</option>
                    <option value="correo">Correo Postal</option>
                    <option value="moto">Envío en Moto</option>
                </select>
            </div>

            <div class="form-group">
                <label for="medio_pago">Medio de Pago</label>
                <select class="form-control" id="medio_pago" name="medio_pago" required>
                    <option value="">Selecciona un medio</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                    <option value="mercado_pago">Mercado Pago</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary btn-lg btn-block">Confirmar Compra</button>
        </form>
     <!-- Fin Datos de envio -->



     <script>
        const carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        let total = 0;
        const contenedor = document.getElementById('productos-carrito');
        carrito.forEach(producto => {
            const subtotal = producto.precio * producto.cantidad;
            total += subtotal;
            contenedor.innerHTML += `<div>${producto.nombre} x${producto.cantidad} = $${subtotal.toFixed(2)}</div>`;
        });

        document.getElementById('total-compra').textContent = `$${total.toFixed(2)}`;


        //Captura los datos del formulario
        document.getElementById('form-compra').addEventListener('submit', function (e) {

            e.preventDefault();

            // Obtiene los datos del formulario
            const datosFormulario = new FormData(this);
            const datos = Object.fromEntries(datosFormulario.entries());

            // Adjuntar carrito al envío
            datos.carrito = carrito;

            // Enviar al servidor
            fetch('confirmar-compra.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            })
            .then(res => res.json())
            .then(respuesta => {
                if(respuesta.ok){
                    alert('✅ Compra confirmada correctamente.');
                    localStorage.removeItem('carrito');
                    // location.reload();
                    window.location.href = '../../index.php';
                }else{
                    alert('❌ Error: ' + respuesta.error);
                }
            })
            .catch(error =>{
                alert('❌ Error de red: ' + error.message);
            })
        });
    </script>
</body>
</html>
<?php 
    }else{
        // El usuario no ha iniciado sesión, redirigir a una página de inicio de sesión
        header("Location: ../../login.php");
        exit();
    }
?>