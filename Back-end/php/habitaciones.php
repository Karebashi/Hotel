<?php
include 'conexion_be.php';

$query = "SELECT id, nombre, descripcion, precio, imagen FROM habitaciones";
$resultado = mysqli_query($conexion, $query);

$habitaciones = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $habitaciones[] = $fila;
}

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($habitaciones);
?>