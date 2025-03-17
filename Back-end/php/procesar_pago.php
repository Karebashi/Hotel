<?php
require 'paypal_config.php';
include 'conexion_be.php';

if (!isset($_POST['reserva_id'])) {
    die("Error: Faltan datos en el formulario.");
}

$reserva_id = $_POST['reserva_id'];

// Obtener detalles de la reserva
$query = "SELECT r.id, r.cantidad_personas, h.precio FROM reservas r JOIN habitaciones h ON r.habitacion_id = h.id WHERE r.id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $reserva_id);
$stmt->execute();
$result = $stmt->get_result();
$reserva = $result->fetch_assoc();

if (!$reserva) {
    die("Error: Reserva no encontrada.");
}

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$item = new Item();
$item->setName('Reserva de Habitación')
    ->setCurrency('EUR')
    ->setQuantity(1)
    ->setPrice($reserva['precio']);

$itemList = new ItemList();
$itemList->setItems(array($item));

$amount = new Amount();
$amount->setCurrency("EUR")
    ->setTotal($reserva['precio']);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Pago de reserva de habitación")
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://localhost/Hotel/Back-end/php/pago_exitoso.php?reserva_id=$reserva_id")
    ->setCancelUrl("http://localhost/Hotel/Back-end/php/pago_cancelado.php");

$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    die($ex);
}

$approvalUrl = $payment->getApprovalLink();
header("Location: $approvalUrl");
?>