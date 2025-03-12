<?php
include 'conexion_be.php';

$imagenes = [
    1 => 'habitaciones/ejecutiva.jpg',
    2 => 'habitaciones/doble_adicional.jpg',
    3 => 'habitaciones/familiar_deluxe.jpg',
    4 => 'habitaciones/doble_confort.jpg'
];

foreach ($imagenes as $id => $ruta_imagen) {
    $ruta_completa = "images/$ruta_imagen"; // Ajusta la ruta según sea necesario
    $query = "UPDATE habitaciones SET imagen = '$ruta_completa' WHERE id = $id";
    if (mysqli_query($conexion, $query)) {
        echo "Imagen de la habitación con ID $id guardada correctamente.<br>";
    } else {
        echo "Error al guardar la imagen de la habitación con ID $id: " . mysqli_error($conexion) . "<br>";
    }
}

mysqli_close($conexion);
?>