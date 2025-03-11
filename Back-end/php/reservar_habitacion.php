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

// Verificar la capacidad de la sub-habitación
$capacityQuery = "SELECT capacidad FROM sub_habitaciones WHERE id = ?";
$stmt = $conexion->prepare($capacityQuery);
$stmt->bind_param("i", $sub_habitacion_id);
$stmt->execute();
$stmt->bind_result($capacidad);
$stmt->fetch();
$stmt->close();

if ($cantidad_personas > $capacidad) {
    // Obtener sub-habitaciones disponibles
    $availableQuery = "SELECT id, capacidad FROM sub_habitaciones WHERE habitacion_id = ? AND estado = 'disponible'";
    $stmt = $conexion->prepare($availableQuery);
    $stmt->bind_param("i", $habitacion_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $sub_habitaciones_disponibles = [];
    while ($row = $result->fetch_assoc()) {
        $sub_habitaciones_disponibles[] = "Sub-Habitación ID: " . $row['id'] . " (Capacidad: " . $row['capacidad'] . " personas)";
    }
    $stmt->close();
    die("Error: La sub-habitación no tiene suficiente capacidad. Sub-habitaciones disponibles: " . implode(", ", $sub_habitaciones_disponibles));
}

// Verificar si la sub-habitación ya está reservada
$checkQuery = "SELECT estado FROM sub_habitaciones WHERE id = ? AND estado = 'ocupada'";
$stmt = $conexion->prepare($checkQuery);
$stmt->bind_param("i", $sub_habitacion_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Error: La sub-habitación ya está ocupada.");
}
$stmt->close();

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