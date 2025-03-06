<?php
include 'conexion_be.php';

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$imagenes = $_FILES['imagenes'];

// Directorio donde se guardarán las imágenes
$target_dir = "../../images/";

// Array para almacenar los nombres de las imágenes
$imagenes_guardadas = [];

// Subir cada imagen
foreach ($imagenes['name'] as $key => $imagen) {
    $target_file = $target_dir . basename($imagen);
    if (move_uploaded_file($imagenes['tmp_name'][$key], $target_file)) {
        $imagenes_guardadas[] = $imagen;
    } else {
        echo "Error al subir la imagen: " . $imagen;
        exit();
    }
}

// Convertir el array de imágenes a una cadena separada por comas
$imagenes_guardadas_str = implode(',', $imagenes_guardadas);

// Insertar la información de la habitación en la base de datos
$query = "INSERT INTO habitaciones (nombre, descripcion, precio, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$imagenes_guardadas_str')";
if (mysqli_query($conexion, $query)) {
    echo "Habitación guardada correctamente.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);
?>