<?php
session_start();
include 'conexion_be.php';

if (!isset($_SESSION['id'])) {
    die("Error: Usuario no autenticado.");
}

if (!isset($_POST['habitacion_id'], $_POST['sub_habitacion_id'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['cantidad_personas'])) {
    die("Error: Faltan datos en el formulario.");
}

$habitacion_id = $_POST['habitacion_id'];
$sub_habitacion_id = $_POST['sub_habitacion_id'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$cantidad_personas = $_POST['cantidad_personas'];
$usuario_id = $_SESSION['id'];

$query = "INSERT INTO reservas (habitacion_id, sub_habitacion_id, usuario_id, fecha_inicio, fecha_fin, cantidad_personas) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param("iiissi", $habitacion_id, $sub_habitacion_id, $usuario_id, $fecha_inicio, $fecha_fin, $cantidad_personas);

if ($stmt->execute()) {
    // Actualizar el estado de la sub-habitación a 'ocupada'
    $updateQuery = "UPDATE sub_habitaciones SET estado = 'ocupada' WHERE id = ?";
    $updateStmt = $conexion->prepare($updateQuery);
    $updateStmt->bind_param("i", $sub_habitacion_id);
    $updateStmt->execute();
    echo "Reserva realizada correctamente.";
} else {
    echo "Error al realizar la reserva: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>