<?php
include 'conexion_be.php';

if (!isset($_POST['habitacion_id'], $_POST['sub_habitacion_id'], $_POST['capacidad'])) {
    die("Error: Faltan datos en el formulario.");
}

$habitacion_id = $_POST['habitacion_id'];
$sub_habitacion_id = $_POST['sub_habitacion_id'];
$capacidad = $_POST['capacidad'];

// Insertar la nueva sub-habitación
$query = "INSERT INTO sub_habitaciones (id, habitacion_id, capacidad, estado) VALUES (?, ?, ?, 'disponible')";
$stmt = $conexion->prepare($query);
$stmt->bind_param("iii", $sub_habitacion_id, $habitacion_id, $capacidad);

if ($stmt->execute()) {
    echo "Sub-habitación guardada correctamente.";
} else {
    echo "Error al guardar la sub-habitación: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>