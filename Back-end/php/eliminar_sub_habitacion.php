<?php
include 'conexion_be.php';

if (!isset($_POST['id'])) {
    die("Error: Faltan datos en el formulario.");
}

$sub_habitacion_id = $_POST['id'];

// Eliminar la sub-habitación
$query = "DELETE FROM sub_habitaciones WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $sub_habitacion_id);

if ($stmt->execute()) {
    echo "Sub-habitación eliminada correctamente.";
} else {
    echo "Error al eliminar la sub-habitación: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>