<?php
session_start();
$isClient = isset($_SESSION['rol']) && $_SESSION['rol'] == 2;


include '../../Back-end/php/conexion_be.php';

$usuario_id = $_SESSION['id'];

// Obtener reservas del cliente
$query_reservas = "SELECT r.id, h.nombre AS habitacion, s.id AS sub_habitacion, r.cantidad_personas, r.fecha_inicio, r.fecha_fin, r.estado 
                   FROM reservas r 
                   JOIN habitaciones h ON r.habitacion_id = h.id 
                   JOIN sub_habitaciones s ON r.sub_habitacion_id = s.id 
                   WHERE r.usuario_id = ?";
$stmt = $conexion->prepare($query_reservas);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado_reservas = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel AquaMar Resort</title>
    <link rel="stylesheet" href="../css/mis_reservas.css">
    <script src="../js/reservas_cliente.js"></script>
    <script src="https://kit.fontawesome.com/9540a64b47.js" crossorigin="anonymous"></script>

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

    <section id="panel-reservas" class="container">
        <h2>Mis Reservas</h2>
        <div id="lista-reservas">
            <table>
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Sub-Habitación</th>
                        <th>Cantidad de Personas</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($reserva = $resultado_reservas->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $reserva['habitacion']; ?></td>
                            <td><?php echo $reserva['sub_habitacion']; ?></td>
                            <td><?php echo $reserva['cantidad_personas']; ?></td>
                            <td><?php echo $reserva['fecha_inicio']; ?></td>
                            <td><?php echo $reserva['fecha_fin']; ?></td>
                            <td><?php echo $reserva['estado']; ?></td>
                            <td>
                                <?php if ($reserva['estado'] == 'activa'): ?>
                                    <button class="btn btn-cancelar" data-id="<?php echo $reserva['id']; ?>">Cancelar</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 Hotel AquaMar Resort. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        document.querySelectorAll('.btn-cancelar').forEach(button => {
            button.addEventListener('click', function() {
                const reservaId = this.getAttribute('data-id');
                if (confirm('¿Estás seguro de que deseas cancelar esta reserva?')) {
                    fetch('../../Back-end/php/cancelar_reservas.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `reserva_id=${reservaId}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error al cancelar la reserva:', error);
                    });
                }
            });
        });
    </script>
</body>
</html>