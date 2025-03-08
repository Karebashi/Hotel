<?php
include 'conexion_be.php';

$id = $_POST['id'];

$query = "DELETE FROM habitaciones WHERE id='$id'";
if (mysqli_query($conexion, $query)) {
    echo "Habitación eliminada correctamente.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);
?>