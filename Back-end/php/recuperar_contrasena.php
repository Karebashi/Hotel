<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
include 'conexion_be.php';

$email = $_POST['email'];
$token = bin2hex(random_bytes(50)); // Generar un token único

// Guardar el token en la base de datos
$query = "UPDATE usuarios SET token = '$token' WHERE email = '$email'";
$result = mysqli_query($conexion, $query);

if ($result) {
    $resetLink = "http://localhost:5500/Vistas/html/restablecer_contrasena.html?token=$token";
    $subject = "Recuperar Contraseña";
    $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: <a href='$resetLink'>$resetLink</a>";

    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aquemaresort@gmail.com'; // Tu dirección de Gmail
        $mail->Password = 'bbzkipodyudotgzr'; // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8'; // Establecer el charset a UTF-8

        // Remitente y destinatario
        $mail->setFrom('no-reply@yourdomain.com', 'Hotel AquaMar Resort');
        $mail->addAddress($email);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo '<script>
                alert("Se ha enviado un enlace de recuperación a tu correo electrónico.");
                window.location = "../../Vistas/html/login.html";
              </script>';
    } catch (Exception $e) {
        echo '<script>
                alert("Error al enviar el correo electrónico: ' . $mail->ErrorInfo . '");
                window.location = "../../Vistas/html/password.html";
              </script>';
    }
} else {
    echo '<script>
            alert("Correo electrónico no encontrado.");
            window.location = "../../Vistas/html/password.html";
          </script>';
}

mysqli_close($conexion);
?>