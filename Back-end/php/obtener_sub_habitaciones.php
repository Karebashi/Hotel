<?php
include 'conexion_be.php';

if (!isset($_GET['habitacion_id'])) {
    die("Error: Faltan datos en el formulario.");
}

$habitacion_id = $_GET['habitacion_id'];

$query = "SELECT id, estado FROM sub_habitaciones WHERE habitacion_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $habitacion_id);
$stmt->execute();
$result = $stmt->get_result();

$sub_habitaciones = [];
while ($row = $result->fetch_assoc()) {
    $sub_habitaciones[] = $row;
}

$stmt->close();
$conexion->close();

header('Content-Type: application/json');
echo json_encode($sub_habitaciones);
?>