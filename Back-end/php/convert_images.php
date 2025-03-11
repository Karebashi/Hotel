<?php
include 'conexion_be.php';

$imagenes = [
    'doble_adicional.jpg',
    'doble_confort.jpg',
    'ejecutiva.jpg',
    'familiar_deluxe.jpg',
    
];

foreach ($imagenes as $imagen) {
    $nombre = pathinfo($imagen, PATHINFO_FILENAME);
    $descripcion = "Descripción de la habitación $nombre";
    $precio = rand(100, 300); // Precio aleatorio para el ejemplo
    $ruta_imagen = "../../images/habitaciones/$imagen";
    $imagen_base64 = base64_encode(file_get_contents($ruta_imagen));

    $query = "UPDATE habitaciones SET imagen = '$imagen_base64' WHERE nombre = '$nombre'";
    if (mysqli_query($conexion, $query)) {
        echo "Imagen de la habitación $nombre guardada correctamente.<br>";
    } else {
        echo "Error al guardar la imagen de la habitación $nombre: " . mysqli_error($conexion) . "<br>";
    }
}

mysqli_close($conexion);
?>