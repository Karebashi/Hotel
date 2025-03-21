<?php
session_start();
$isClient = isset($_SESSION['rol']) && $_SESSION['rol'] == 2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Hotel AquaMar Resort</title>
    <link rel="stylesheet" href="../css/styles_4.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9540a64b47.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <div class="container">
            <h1><i class="fa-solid fa-water"></i> Hotel AquaMar Resort </h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="about.php">Nosotros</a></li>
                    <li><a href="services.php">Servicios</a></li>
                    <li><a href="habitaciones.php">Habitaciones</a></li>
                    <li><a href="contact.php">Contacto</a></li>
                    <?php if ($isClient): ?>
                        <li><a href="mis_reservas.php">Mis Reservas</a></li>
                        <li><a href="../../Back-end/php/logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="login.html">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <section class="services">
        <div class="container">
            <h2>Nuestros Servicios</h2>
            <div class="service-item">
                <img src="../../images/hotel/piscina.jpg" alt="Piscina">
                <div class="service-content">
                    <h3><i class="fas fa-swimming-pool"></i> Piscina</h3>
                    <p>Disfruta de nuestra piscina al aire libre con vistas al mar. Abierta todos los días de 8:00 AM a 8:00 PM.</p>
                </div>
            </div>
            <div class="service-item">
                <img src="../../images/hotel/spa.jpg" alt="Spa">
                <div class="service-content">
                    <h3><i class="fas fa-spa"></i> Spa</h3>
                    <p>Relájate y rejuvenece en nuestro spa de lujo. Abierto todos los días de 9:00 AM a 7:00 PM.</p>
                </div>
            </div>
            <div class="service-item">
                <img src="../../images/hotel/restaurante.jpg" alt="Restaurante">
                <div class="service-content">
                    <h3><i class="fas fa-utensils"></i> Restaurante</h3>
                    <p>Disfruta de una experiencia culinaria única en nuestro restaurante gourmet. Abierto todos los días de 7:00 AM a 10:00 PM.</p>
                </div>
            </div>
            <div class="service-item">
                <img src="../../images/hotel/gimnasio.jpg" alt="Gimnasio">
                <div class="service-content">
                    <h3><i class="fas fa-dumbbell"></i> Gimnasio</h3>
                    <p>Mantente en forma en nuestro gimnasio completamente equipado. Abierto todos los días de 6:00 AM a 10:00 PM.</p>
                </div>
            </div>
            <div class="service-item">
                <img src="../../images/hotel/casino.jpg" alt="Casino">
                <div class="service-content">
                    <h3><i class="fas fa-dice"></i> Casino</h3>
                    <p>Prueba tu suerte en nuestro casino. Abierto todos los días de 6:00 PM a 2:00 AM.</p>
                </div>
            </div>
            <div class="service-item">
                <img src="../../images/hotel/wifi.jpg" alt="Wi-Fi Gratis">
                <div class="service-content">
                    <h3><i class="fas fa-wifi"></i> Wi-Fi Gratis</h3>
                    <p>Conéctate con nuestro Wi-Fi de alta velocidad disponible en todas las áreas del hotel.</p>
                </div>
            </div>
            <div class="service-item">
                <img src="../../images/hotel/tv.jpg" alt="TV Satelital">
                <div class="service-content">
                    <h3><i class="fas fa-tv"></i> TV Satelital</h3>
                    <p>Disfruta de una amplia variedad de canales en nuestras habitaciones equipadas con TV satelital.</p>
                </div>
            </div>
            <div class="service-item no-image">
                <div class="service-content">
                    <h3><i class="fas fa-ellipsis-h"></i> Otros Servicios</h3>
                    <p>Ofrecemos una variedad de otros servicios para hacer tu estancia más cómoda y placentera.</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>&copy; 2025 Hotel AquaMar Resort. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>