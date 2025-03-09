<?php
include 'conexion_be.php';

<<<<<<< HEAD
$nombre = $_POST['nombre']; 
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$imagenes = $_FILES['imagenes'];
=======
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = htmlspecialchars($_POST['tipo']);
    $precio = htmlspecialchars($_POST['precio']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
>>>>>>> be38eba66e1ba706be1f07b1555c8320f2a33173

    // Manejar la subida de la imagen
    $imagen = $_FILES['imagen']['tmp_name'];
    $imagenContenido = addslashes(file_get_contents($imagen));

    // Guardar los datos en la base de datos
    $stmt = $conexion->prepare("INSERT INTO habitaciones (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $tipo, $descripcion, $precio, $imagenContenido);
    if ($stmt->execute()) {
        header("Location: admin.php?status=success");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

mysqli_close($conexion);
?>
