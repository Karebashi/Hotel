<?php
include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $resuelto = filter_var($_POST['resuelto'], FILTER_VALIDATE_BOOLEAN);

    $stmt = $conexion->prepare("UPDATE contact_messages SET resolved = ? WHERE id = ?");
    $stmt->bind_param("ii", $resuelto, $id);
    if ($stmt->execute()) {
        echo "El estado del mensaje ha sido actualizado.";
    } else {
        echo "Error al actualizar el estado del mensaje.";
    }
    $stmt->close();
} else {
    echo "Método de solicitud no válido.";
}

mysqli_close($conexion);
?>