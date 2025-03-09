<?php
session_start();
$isClient = isset($_SESSION['rol']) && $_SESSION['rol'] == 2;
$clientName = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel AquaMar Resort</title>
    <link rel="stylesheet" href="../../Vistas/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9540a64b47.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
                        <li><a href="../../Back-end/php/logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="login.html">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class="habitaciones">
        <div class="container">
            <h2>Nuestras Habitaciones</h2>
            <?php if ($isClient): ?>
                <h4>Hola, <?php echo htmlspecialchars($clientName); ?>. </h4>
                <p>Puedes reservar habitaciones a continuación.</p>
            <?php else: ?>
                <p>Para poder reservar habitaciones necesitas tener una cuenta creada.</p>
            <?php endif; ?>
            <div id="habitaciones-lista" class="row">
                <?php
                include '../../Back-end/php/conexion_be.php';

                $query = "SELECT id, nombre, descripcion, precio, imagen FROM habitaciones";
                $resultado = mysqli_query($conexion, $query);

                while ($habitacion = mysqli_fetch_assoc($resultado)): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($habitacion['imagen']); ?>" class="card-img-top" alt="<?php echo $habitacion['nombre']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $habitacion['nombre']; ?></h5>
                                <p class="card-text"><?php echo $habitacion['descripcion']; ?></p>
                                <p class="card-text">Precio: $<?php echo $habitacion['precio']; ?></p>
                                <?php if ($isClient): ?>
                                    <a href="#" class="btn btn-primary">Reservar</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
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