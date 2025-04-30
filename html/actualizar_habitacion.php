<?php
require 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

// Verificar si se subió una nueva imagen
if (!empty($_FILES['imagen']['name'])) {
    $imagenNombre = basename($_FILES['imagen']['name']);
    $imagenRuta = 'imagenes/' . $imagenNombre;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenRuta);
} else {
    // Mantener la imagen anterior
    $sql = "SELECT imagen FROM habitaciones WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id]);
    $imagenRuta = $stmt->fetchColumn();
}

// Actualizar la habitación
$sql = "UPDATE habitaciones SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$nombre, $descripcion, $precio, $imagenRuta, $id]);

header("Location: habitaciones.php"); // Redirige después de actualizar
exit;
