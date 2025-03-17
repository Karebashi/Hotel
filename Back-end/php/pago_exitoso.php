<?php
require 'paypal_config.php';
include 'conexion_be.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

if (!isset($_GET['paymentId'], $_GET['PayerID'], $_GET['reserva_id'])) {
    die("Error: Faltan datos en la URL.");
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];
$reserva_id = $_GET['reserva_id'];

$payment = Payment::get($paymentId, $apiContext);
$execution = new PaymentExecution();
$execution->setPayerId($payerId);

try {
    $result = $payment->execute($execution, $apiContext);
    try {
        $payment = Payment::get($paymentId, $apiContext);
    } catch (Exception $ex) {
        die($ex);
    }
} catch (Exception $ex) {
    die($ex);
}

// Actualizar el estado de pago de la reserva
$query = "UPDATE reservas SET estado_pago = 'pagado' WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $reserva_id);
$stmt->execute();

header("Location: ../../Vistas/html/mis_reservas.php");
?>