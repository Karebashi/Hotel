<?php
include 'conexion_be.php';

if (!isset($_POST['habitacion_id'], $_POST['sub_habitacion_id'])) {
    die("Error: Faltan datos en el formulario.");
}

$habitacion_id = $_POST['habitacion_id'];
$sub_habitacion_id = $_POST['sub_habitacion_id'];

// Verificar si la sub-habitación ya existe
$checkQuery = "SELECT id FROM sub_habitaciones WHERE id = ?";
$stmt = $conexion->prepare($checkQuery);
$stmt->bind_param("i", $sub_habitacion_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Error: La sub-habitación ya existe.");
}

// Insertar la nueva sub-habitación
$query = "INSERT INTO sub_habitaciones (id, habitacion_id, estado) VALUES (?, ?, 'disponible')";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $sub_habitacion_id, $habitacion_id);

if ($stmt->execute()) {
    echo "Sub-habitación agregada correctamente.";
} else {
    echo "Error al agregar la sub-habitación: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>