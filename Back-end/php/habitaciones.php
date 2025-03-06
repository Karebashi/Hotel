<?php
header('Content-Type: application/json');
include 'conexion_be.php';

$query = "SELECT * FROM habitaciones";
$result = mysqli_query($conexion, $query);

$habitaciones = [];

while ($row = mysqli_fetch_assoc($result)) {
    $habitaciones[] = [
        'nombre' => $row['nombre'],
        'descripcion' => $row['descripcion'],
        'precio' => $row['precio'],
        'imagen' => explode(',', $row['imagen'])[0] // Muestra solo la primera imagen
    ];
}

echo json_encode($habitaciones);
mysqli_close($conexion);
?>
