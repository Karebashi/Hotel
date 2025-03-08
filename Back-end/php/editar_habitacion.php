<?php
include 'conexion_be.php';

$id = $_POST['id'];
$nombre = $_POST['tipo'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$imagenes = isset($_FILES['imagenes']) ? implode(',', $_FILES['imagenes']['name']) : '';

$query = "UPDATE habitaciones SET nombre='$nombre', descripcion='$descripcion', precio='$precio'";
if ($imagenes) {
    $query .= ", imagen='$imagenes'";
}
$query .= " WHERE id='$id'";

if (mysqli_query($conexion, $query)) {
    echo "Habitación actualizada correctamente.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);
?>