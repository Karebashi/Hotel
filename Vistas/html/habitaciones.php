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
    <link rel="stylesheet" href="../../Vistas/css/habitaciones.css">
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
                        <li><a href="mis_reservas.php">Mis Reservas</a></li>
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
                            <img src="../../<?php echo htmlspecialchars($habitacion['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($habitacion['nombre']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($habitacion['nombre']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($habitacion['descripcion']); ?></p>
                                <p class="card-text">Precio: $<?php echo htmlspecialchars($habitacion['precio']); ?></p>
                                <?php if ($isClient): ?>
                                    <button class="btn btn-primary" onclick="mostrarFormularioReserva(<?php echo $habitacion['id']; ?>, '<?php echo htmlspecialchars($habitacion['nombre']); ?>', '<?php echo htmlspecialchars($habitacion['descripcion']); ?>', '<?php echo htmlspecialchars($habitacion['imagen']); ?>', <?php echo $habitacion['precio']; ?>)">Reservar</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php mysqli_close($conexion); ?>
            </div>
        </div>
    </section>

    <div id="formulario-reserva" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarFormularioReserva()">&times;</span>
            <h2>Reservar Habitación</h2>
            <div id="vista-previa-habitacion" class="card mb-4">
                <img id="vista-previa-imagen" class="card-img-top" alt="Vista previa de la habitación">
                <div class="card-body">
                    <h5 id="vista-previa-nombre" class="card-title"></h5>
                    <p id="vista-previa-descripcion" class="card-text"></p>
                    <p id="vista-previa-precio" class="card-text"></p>
                </div>
            </div>
            <div id="sub-habitaciones" class="sub-habitaciones">
                <!-- Aquí se cargarán las sub-habitaciones dinámicamente -->
            </div>
            <form id="form-reserva" action="../../Back-end/php/reservar_habitacion.php" method="POST">
                <input type="hidden" id="habitacion-id" name="habitacion_id">
                <input type="hidden" id="sub-habitacion-id" name="sub_habitacion_id">
                
                <div id="error-container" style="display: none; background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px; margin-top: 10px;">
                </div>
                
                <div class="form-group">
                    <label for="fecha-inicio">Fecha de Inicio:</label>
                    <input type="date" id="fecha-inicio" name="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="fecha-fin">Fecha de Fin:</label>
                    <input type="date" id="fecha-fin" name="fecha_fin" required>
                </div>
                <div class="form-group">
                    <label for="cantidad-personas">Cantidad de Personas:</label>
                    <input type="number" id="cantidad-personas" name="cantidad_personas" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Reservar</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Hotel AquaMar Resort. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="../../Vistas/js/habitaciones.js"></script>
</body>
</html>