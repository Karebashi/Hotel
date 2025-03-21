<?php
include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = intval($_POST['reserva_id']);

    // Actualizar el estado de la reserva a 'cancelada'
    $stmt = $conexion->prepare("UPDATE reservas SET estado = 'cancelada', estado_pago = 'cancelada' WHERE id = ?");
    $stmt->bind_param("i", $reserva_id);
    if ($stmt->execute()) {
        echo "Reserva cancelada correctamente.";
    } else {
        echo "Error al cancelar la reserva.";
    }
    $stmt->close();
} else {
    echo "Método de solicitud no válido.";
}

mysqli_close($conexion);
?>