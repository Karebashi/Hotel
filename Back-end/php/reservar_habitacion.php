<?php
session_start();
include 'conexion_be.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Usuario no autenticado.']);
    exit();
}

if (!isset($_POST['habitacion_id'], $_POST['sub_habitacion_id'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['cantidad_personas'])) {
    echo json_encode(['error' => 'Faltan datos en el formulario.']);
    exit();
}

$habitacion_id = $_POST['habitacion_id'];
$sub_habitacion_id = $_POST['sub_habitacion_id'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$cantidad_personas = $_POST['cantidad_personas'];
$usuario_id = $_SESSION['id'];

// Verificar la capacidad de la sub-habitación seleccionada
$capacityQuery = "SELECT capacidad FROM sub_habitaciones WHERE id = ?";
$stmt = $conexion->prepare($capacityQuery);
$stmt->bind_param("i", $sub_habitacion_id);
$stmt->execute();
$stmt->bind_result($capacidad);
$stmt->fetch();
$stmt->close();

if ($cantidad_personas > $capacidad) {
    // Obtener sub-habitaciones con capacidad suficiente
    $availableRoomsQuery = "SELECT id, capacidad FROM sub_habitaciones WHERE capacidad >= ? AND estado = 'disponible'";
    $stmt = $conexion->prepare($availableRoomsQuery);
    $stmt->bind_param("i", $cantidad_personas);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = [];
    while ($row = $result->fetch_assoc()) {
        $options[] = "ID: " . $row['id'] . " - Capacidad: " . $row['capacidad'];
    }
    $stmt->close();

    if ($options) {
        echo json_encode(['error' => 'La cantidad de personas excede la capacidad de la sub-habitación seleccionada, prueba con las siguientes opciones si deseas:', 'options' => $options]);
    } else {
        echo json_encode(['error' => 'No hay sub-habitaciones disponibles con suficiente capacidad, prueba con estas.']);
    }
    exit();
}

// Verificar si la sub-habitación ya está reservada
$checkQuery = "SELECT estado FROM sub_habitaciones WHERE id = ? AND estado = 'ocupada'";
$stmt = $conexion->prepare($checkQuery);
$stmt->bind_param("i", $sub_habitacion_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['error' => 'La sub-habitación ya está ocupada.']);
    exit();
}
$stmt->close();

// Insertar la reserva en la base de datos
$query = "INSERT INTO reservas (habitacion_id, sub_habitacion_id, usuario_id, fecha_inicio, fecha_fin, cantidad_personas) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param("iiissi", $habitacion_id, $sub_habitacion_id, $usuario_id, $fecha_inicio, $fecha_fin, $cantidad_personas);

if ($stmt->execute()) {
    // Actualizar el estado de la sub-habitación a 'ocupada'
    $updateQuery = "UPDATE sub_habitaciones SET estado = 'ocupada' WHERE id = ?";
    $updateStmt = $conexion->prepare($updateQuery);
    $updateStmt->bind_param("i", $sub_habitacion_id);
    $updateStmt->execute();
    $updateStmt->close();

    echo json_encode(['success' => 'Reserva realizada correctamente.']);
} else {
    echo json_encode(['error' => 'Error al realizar la reserva: ' . $stmt->error]);
}

$stmt->close();
$conexion->close();
?>