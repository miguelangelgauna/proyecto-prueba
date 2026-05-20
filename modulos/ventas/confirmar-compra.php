<?php 
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['carrito'])) {
    echo json_encode(['ok' => false, 'error' => 'Datos incompletos']);
    exit;
}

require("../../includes/conexion.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$usuario_id = $_SESSION['id'];
$nombre = $data['nombre'];
$telefono = $data['telefono'];
$direccion = $data['direccion'];
$ciudad = $data['ciudad'];
$provincia = $data['provincia'];
$pais = $data['pais'];
$codigo_postal = $data['codigo_postal'];
$tipo_envio = $data['tipo_envio'];
$medio_pago = $data['medio_pago'];
$notas_envio = $data['notas_envio'];
$carrito = $data['carrito'];

$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Insertar venta principal
$query = "INSERT INTO ventas 
(usuario, fecha, hora, metodo_pago, total, nombre_receptor, telefono, direccion, ciudad, provincia, pais, codigo_postal, notas_envio, tipo_envio) 
VALUES (
    $usuario_id,
    '$fecha',
    '$hora',
    '$medio_pago',
    $total,
    '$nombre',
    '$telefono',
    '$direccion',
    '$ciudad',
    '$provincia',
    '$pais',
    '$codigo_postal',
    '$notas_envio',
    '$tipo_envio'
)";

$result = mysqli_query($conexion, $query);

// Validar si la inserción fue exitosa
if ($result) {
    $venta_id = mysqli_insert_id($conexion);
    $errores = [];

    foreach ($carrito as $item) {
        $id_producto = intval($item['id']);
        $nombre_producto = $item['nombre'];
        $precio = floatval($item['precio']);
        $cantidad = intval($item['cantidad']);
        $subtotal = $precio * $cantidad;

        $query_detalle = "INSERT INTO detalle_ventas (venta, producto,precio_unitario, cantidad, subtotal) 
         VALUES ($venta_id, '$nombre_producto', $precio, $cantidad, $subtotal)";
        $detalle_result = mysqli_query($conexion, $query_detalle);

        if (!$detalle_result) {
            $errores[] = mysqli_error($conexion);
        }
    }

    mysqli_close($conexion);

    if (count($errores) === 0) {
        echo json_encode(['ok' => true, 'mensaje' => 'Compra registrada con éxito']);
    } else {
        echo json_encode(['ok' => false, 'error' => 'Error al guardar detalles', 'detalles' => $errores]);
    }

} else {
    echo json_encode(['ok' => false, 'error' => 'No se pudo registrar la venta']);
}
