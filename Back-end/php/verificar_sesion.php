<?php
session_start();

$response = [
    "sesionIniciada" => isset($_SESSION['id_usuario']),
    "esAdmin" => isset($_SESSION['rol']) && $_SESSION['rol'] == 1 // Cambié el 0 por 1
];

echo json_encode($response);
?>

