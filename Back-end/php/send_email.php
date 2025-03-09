<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
require 'conexion_be.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Insert the data into the database
    $stmt = $conexion->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    $stmt->execute();
    $stmt->close();

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aquemaresort@gmail.com'; // Your Gmail address
        $mail->Password = 'bbzkipodyudotgzr'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8'; // Set the charset to UTF-8

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Hotel AquaMar Resort');
        $mail->addAddress('info@hotelparadise.com'); // Hotel's email address
        $mail->addReplyTo($email, $name);
        $mail->addCC('your-email@gmail.com'); // Add your email as CC

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject; 
        $mail->Body    = "<p><strong>Nombre:</strong> $name</p>
                          <p><strong>Correo Electrónico:</strong> $email</p>
                          <p><strong>Mensaje:</strong><br>$message</p>";

        $mail->send();

        // Send confirmation email to user
        $mail->clearAddresses();
        $mail->addAddress($email);
        $mail->Subject = 'Confirmación de recepción de mensaje';
        $mail->Body    = "<div style='font-family: Times New Roman, serif; color: #333; font-size: 18px;'>
                            <div style='background-color: #007bff; color: white; padding: 10px; text-align: center;'>
                                <h1 style='font-size: 24px;'>Hotel AquaMar Resort</h1>
                            </div>
                            <div style='padding: 20px;'>
                                <h2 style='color: #007bff; font-size: 22px;'>Hola $name,</h2>
                                <p>Hemos recibido tu mensaje y te contactaremos pronto.</p>
                                <p>Gracias por ponerte en contacto con nosotros.</p>
                                <p>Saludos,</p>
                                <p><strong>Hotel AquaMar Resort</strong></p>
                            </div>
                            <div style='background-color: #f8f9fa; padding: 10px; text-align: center;'>
                                <p style='font-size: 16px; color: #777;'>Este es un correo automático, por favor no respondas a este mensaje.</p>
                            </div>
                          </div>";

        $mail->send();

        header('Location: ../../Vistas/html/contact.html?status=success');
        exit();
    } catch (Exception $e) {
        header('Location: ../../Vistas/html/contact.html?status=error');
        exit();
    }
} else {
    header('Location: ../../Vistas/html/contact.html?status=invalid');
    exit();
}
?>